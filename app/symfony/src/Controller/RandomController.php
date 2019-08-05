<?php
/**
 * @package App\Controller
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z.o.o.
 * @license See LICENSE.txt for license details
 */

namespace App\Controller;

use App\Application\MillipedeService;
use App\Entity\Developer;
use App\Entity\Millipede;
use App\Form\MillipedeType;
use App\Repository\DeveloperRepository;
use App\Repository\MillipedeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RandomController
 *
 * @package App\Controller
 */
class RandomController extends AbstractController
{
    /**
     * @var MillipedeType $developers
     */
    private $developers;

    /**
     * @var Millipede $millipede
     */
    private $millipede;

    /**
     * @var MillipedeService $millipedeService
     */
    private $millipedeService;

    /**
     * @var MillipedeRepository $millipedeRepository
     */
    private $millipedeRepository;

    /**
     * @var DeveloperRepository $developerRepository
     */
    private $developerRepository;

    /**
     * RandomController constructor.
     *
     * @param MillipedeService $millipedeService
     * @param MillipedeRepository $millipedeRepository
     * @param DeveloperRepository $developerRepository
     */
    public function __construct(
        MillipedeService $millipedeService,
        MillipedeRepository $millipedeRepository,
        DeveloperRepository $developerRepository
    ) {
        $this->millipedeService = $millipedeService;
        $this->millipedeRepository = $millipedeRepository;
        $this->developerRepository = $developerRepository;
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return mixed
     */
    public function random(Request $request, EntityManagerInterface $entityManager)
    {
        $session = $this->get('session');
        $amountOfDevelopers = $session->get('amount_of_developers');
        $currentDevelopers = $this->developerRepository->getAllDevelopers();
        $checkedDevelopers = $this->getCheckedDevelopers($request);

        $this->millipede = new Millipede();
        $this->millipede->setAmount($amountOfDevelopers);

        if (count($checkedDevelopers) === (int) $amountOfDevelopers) {
            foreach ($checkedDevelopers as $key => $checkedDeveloper) {
                $this->millipede->getDevelopers()->set($key + 1, $checkedDeveloper);
            }

            return $this->createMillipede($session);
        }

        for ($i = 1; $i <= $amountOfDevelopers; $i++) {
            $developer = new Developer();

            $this->millipede->getDevelopers()->set($i, $developer);
        }

        $form = $this->createForm(MillipedeType::class, $this->millipede);

        if (count($checkedDevelopers) > (int) $amountOfDevelopers) {
            $this->addFlash('warning', 'Amount of checked developers are larger than expected');

            return $this->render(
                'random.html.twig',
                [
                    'form' => $form->createView(),
                    'developers' => $currentDevelopers,
                ]
            );
        }

        $form->add('amount', HiddenType::class, ['data' => $amountOfDevelopers]);
        $form->add('save', SubmitType::class, ['label' => 'Confirm']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $developers = $this->millipede->getDevelopers();

            foreach ($developers as $tempKey => $developer) {
                $developerRepository = $this->getDoctrine()->getRepository(Developer::class);
                $existedDeveloper = $developerRepository->findOneBy([Developer::EMAIL => $developer->getEmail()]);

                if (!$existedDeveloper) {
                    $dev = new Developer();
                    $dev->setFirstname($developer->getFirstname());
                    $dev->setLastname($developer->getLastname());
                    $dev->setProject($developer->getProject());
                    $dev->setFunction($developer->getFunction());
                    $dev->setEmail($developer->getEmail());
                    $entityManager->persist($dev);
                    $this->millipede->getDevelopers()->set($tempKey, $dev);
                    $entityManager->flush();
                }
            }

            return $this->createMillipede($session);
        }

        return $this->render(
            'random.html.twig',
            [
                'form' => $form->createView(),
                'developers' => $currentDevelopers,
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    protected function getCheckedDevelopers(Request $request): array
    {
        $developers = $this->developerRepository->getAllDevelopers();
        $checkedDevelopers = [];

        foreach ($developers as $developer) {
            if (null !== $request->get('developer_' . $developer->getId())) {
                $checkedDevelopers[] = $developer;
            }
        }

        return $checkedDevelopers;
    }

    /**
     * @param $session
     *
     * @return RedirectResponse
     */
    protected function createMillipede($session): RedirectResponse
    {
        $millipede = $this->millipedeService->createMillipede($this->millipede);
        $ids = [];

        foreach ($millipede->toArray() as $developer) {
            $ids[] = $developer->getId();
        }

        $ids = implode(' => ', $ids);

        $this->millipede->setMillipede($ids);
        $this->millipedeRepository->save($this->millipede);
        $session->set('millipede_id', $this->millipede->getId());

        return $this->redirectToRoute('index');
    }
}

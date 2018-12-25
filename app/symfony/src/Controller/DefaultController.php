<?php
/**
 * @package App\Controller
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z.o.o.
 * @license See LICENSE.txt for license details
 */

namespace App\Controller;

use App\Application\MillipedeService;
use App\Entity\Millipede;
use App\Repository\MillipedeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{
    private $millipedeRepository;

    /**
     * @var MillipedeService $millipedeService
     */
    private $millipedeService;

    /**
     * DefaultController constructor.
     *
     * @param MillipedeRepository $millipedeRepository
     * @param MillipedeService $millipedeService
     */
    public function __construct(MillipedeRepository $millipedeRepository, MillipedeService $millipedeService)
    {
        $this->millipedeRepository = $millipedeRepository;
        $this->millipedeService = $millipedeService;
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $developers = [];
        $nextGenerationTime = null;
        /** @var Millipede $currentMillipede */
        $currentMillipede = $this->millipedeRepository->getCurrentMillipede();

        if (!empty($currentMillipede)) {
            $currentDateTime = strtotime('-7 days');
            $millipedeDateTime = $currentMillipede->getCreatedAt()->getTimestamp();
            $developers = $this->millipedeService->millipedeToArrayCollection($currentMillipede);
            $nextGenerationTime = date('d-m-Y', time() + (3600 * 24 * 7));
        }

        $form = $this->createFormBuilder()
            ->add('amount_of_developers', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Confirm'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData('amount_of_developers');
            $amount = $data['amount_of_developers'] ?? null;
            $millipede = new Millipede();
            $millipede->setAmount((int) $amount);
            $session = $this->get('session');

            $session->set('amount_of_developers', $amount);

            return $this->redirectToRoute('random');
        }

        $params = [
            'millipede' => $developers = true !== empty($developers) ? $developers : null,
            'next' => $nextGenerationTime = true !== empty($developers) ? $nextGenerationTime : null,
            'form' => $form->createView()
        ];

        return $this->render('index.html.twig', $params);
    }
}
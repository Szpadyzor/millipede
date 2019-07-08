<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 25.12.18
 * Time: 23:10
 */

namespace App\Controller;

use App\Application\MillipedeService;
use App\Entity\Millipede;
use App\Repository\DeveloperRepository;
use App\Repository\MillipedeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MillipedeController
 */
class MillipedeController extends AbstractController
{
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
     * MillipedeController constructor.
     *
     * @param MillipedeService $millipedeService
     * @param MillipedeRepository $millipedeRepository
     * @param DeveloperRepository $developerRepository
     */
    public function __construct(MillipedeService $millipedeService, MillipedeRepository $millipedeRepository, DeveloperRepository $developerRepository)
    {
        $this->millipedeService = $millipedeService;
        $this->millipedeRepository = $millipedeRepository;
        $this->developerRepository = $developerRepository;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function millipede(Request $request): Response
    {
        $session = $this->get('session');
        $millipedeId = $session->get('millipede_id');
        /** @var Millipede $millipede */
        $millipede = $this->millipedeRepository->find($millipedeId);
        $mil = $millipede->getMillipede();
        $milli = explode(' => ', $mil);

        $developers = [];
        foreach ($milli as $dev) {
            $developers[] = $this->developerRepository->find($dev);
        }

        $message = $this->millipedeService->prepareMessage($developers);

        return $this->render('millipede.html.twig', ['message' => $message]);
    }
}

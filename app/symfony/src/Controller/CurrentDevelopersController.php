<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 17.03.19
 * Time: 21:49
 */

namespace App\Controller;

use App\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CurrentDevelopersController
 */
class CurrentDevelopersController extends AbstractController
{
    /**
     * @var DeveloperRepository $developerRepository
     */
    private $developerRepository;

    /**
     * CurrentDevelopersController constructor.
     *
     * @param DeveloperRepository $developerRepository
     */
    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developerRepository = $developerRepository;
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @Route("/current-developers", name="current-dev")
     *
     * @return Response
     */
    public function getDevelopers(Request $request, EntityManagerInterface $entityManager): Response
    {
        $developers = $this->developerRepository->getAllDevelopers();
        $form = $this->createFormBuilder();

        return $this->render('current_developers.html.twig', [
            'developers' => $developers
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 25.12.18
 * Time: 23:17
 */

namespace App\Application;

use App\Api\Model\MillipedeInterface;
use App\Entity\Developer;
use App\Entity\Millipede;
use App\Repository\DeveloperRepository;
use App\Repository\MillipedeRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class MillipedeService
 *
 * @package App\Application
 */
class MillipedeService
{
    /**
     * @var DeveloperRepository $developerRepository
     */
    private $developerRepository;

    /**
     * @var MillipedeRepository $millipedeRepository
     */
    private $millipedeRepository;

    /**
     * MillipedeService constructor.
     *
     * @param DeveloperRepository $developerRepository
     * @param MillipedeRepository $millipedeRepository
     */
    public function __construct(DeveloperRepository $developerRepository, MillipedeRepository $millipedeRepository)
    {
        $this->developerRepository = $developerRepository;
        $this->millipedeRepository = $millipedeRepository;
    }

    /**
     * @param Millipede $millipede
     *
     * @return ArrayCollection
     */
    public function createMillipede(Millipede $millipede)
    {
        $millipedeDevelopers = $millipede->getDevelopers();
        $allDevelopers = count($millipedeDevelopers) > 0 ? $millipedeDevelopers : $this->developerRepository->getAllDevelopers();
        $millipede = [];
        $amount = count($allDevelopers);

        for ($i = 0; $i < $amount; $i++) {
            if (empty($millipede)) {
                $numberPicked = array_rand($allDevelopers->toArray(), 1);
                $millipede[] = $allDevelopers->get($numberPicked);
                $allDevelopers->remove($numberPicked);

                continue;
            }

            $numberPicked = array_rand($allDevelopers->toArray(), 1);

            /** @var Developer $chosen */
            $chosen = $allDevelopers->get($numberPicked);
            $previousPicked = $i - 1;

            /** @var Developer $previousDeveloper */
            $previousDeveloper = $millipede[$previousPicked];

            if ($chosen->getProject() === $previousDeveloper->getProject()) {
                if ($previousDeveloper->getFunction() === Developer::FUNCTION_LEADER ||
                    $chosen->getFunction() === Developer::FUNCTION_LEADER) {
                    $i--;

                    continue;
                }
            }

            $millipede[] = $chosen;

            $allDevelopers->remove($numberPicked);
        }

        return new ArrayCollection($millipede);
    }

    public function prepareMessage(ArrayCollection $millipede): string
    {
        $message = '';
        $message .= "<table align ='center'>";
        $lastEmail = count($millipede) - 1;

        /**
         * @var int $key
         * @var Developer $developer
         */
        foreach ($millipede as $key => $developer) {
            $message .= '<tr>';
            $message .= '<td>';
            $message .= '>>>>> ' . $developer->getEmail() . ' >>>>>' . ($key !== $lastEmail ? PHP_EOL : '');
            $message .= '</td>';
            $message .= '</tr>';
        }

        $message .= '</table>';

        return $message;
    }

    /**
     * @param Millipede $millipede
     *
     * @return ArrayCollection
     * @throws \Exception
     */
    public function millipedeToArrayCollection(Millipede $millipede): ArrayCollection
    {
        $ids = explode('=>', $millipede->getMillipede());

        if (empty($ids)) {
            throw new \Exception('Empty millipede');
        }

        $developers = [];

        foreach ($ids as $id) {
            $developers[] = $this->developerRepository->findOneBy(['id' => $id]);
        }

        return new ArrayCollection($developers);
    }

    /**
     * @param ArrayCollection $developers
     *
     * @return int
     */
    protected function countDevelopers(ArrayCollection $developers): int
    {
        $amount = 0;

        /** @var Developer $developer */
        foreach ($developers as $developer) {
            null !== $developer->getEmail() ? $amount++ : null;
        }

        return $amount;
    }
}
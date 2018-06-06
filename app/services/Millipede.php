<?php
/**
 * @package Millipede\Models
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Services;

use Millipede\Api\MillipedeInterface;

/**
 * Class Millipede
 */
class Millipede implements MillipedeInterface
{
    public function __construct()
    {
    }

    public function getMillipede(array $data): string
    {
        $availableDevelopers = [
            1 => [
                'name'     => 'MPakuła',
                'project'  => 'OLS',
                'function' => 'D'
            ],
            2 => [
                'name'     => 'BHerba',
                'project'  => 'CTI',
                'function' => 'L'
            ],
            3 => [
                'name'     => 'BPicho',
                'project'  => 'OLS',
                'function' => 'L'
            ],
            4 => [
                'name'     => 'ABadowski',
                'project'  => 'IS',
                'function' => 'L'
            ],
            5 => [
                'name'     => 'MBukowski',
                'project'  => 'IS',
                'function' => 'D'
            ],
            6 => [
                'name'     => 'MMularczyk',
                'project'  => 'LUX',
                'function' => 'D'
            ],
            7 => [
                'name'     => 'WKaczorowski',
                'project'  => 'LUX',
                'function' => 'L'
            ],
            8 => [
                'name'     => 'PMalerowicz',
                'project'  => 'OLS',
                'function' => 'D'
            ],
            9 => [
                'name'     => 'MTrybuła',
                'project'  => 'OLS',
                'function' => 'D'
            ],
            10 => [
                'name' => 'OWolanin',
                'project' => 'IS',
                'function' => 'D'
            ],

        ];

        $stonoga = [];
        $amount = count($availableDevelopers);

        for ($i = 0; $i < $amount; $i++) {
            if (empty($stonoga)) {
                $numberPicked  = array_rand($availableDevelopers, 1);
                $stonoga[] = $availableDevelopers[$numberPicked];
                unset($availableDevelopers[$numberPicked]);

                continue;
            }

            $numberPicked = array_rand($availableDevelopers, 1);
            $chosen = $availableDevelopers[$numberPicked];
            $previousPicked = $i - 1;
            $previousDeveloper = $stonoga[$previousPicked];

            if ($chosen['project'] === $previousDeveloper['project']) {
                if ($previousDeveloper['function'] === 'L' || $chosen['function'] === 'L') {
                    $i--;

                    continue;
                }
            }

            $stonoga[] = $chosen;

            unset($availableDevelopers[$numberPicked]);
        }

        $implodedStonoga = implode(' <= ', $stonoga);
    }
}
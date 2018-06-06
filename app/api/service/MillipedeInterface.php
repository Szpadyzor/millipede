<?php
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Api;

/**
 * Interface MillipedeInterface
 */
interface MillipedeInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function getMillipede(array $data): string;
}

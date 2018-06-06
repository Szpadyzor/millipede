<?php
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Api\Services;

use Millipede\Api\Model\MillipedeInterface as MillipedeModelInterface;

/**
 * Interface MillipedeInterface
 */
interface MillipedeInterface
{
    const MILLIPEDE_EMAIL_PATTERN = MillipedeModelInterface::EMAIL . '_';
    const MILLIPEDE_PROJECT_PATTERN = MillipedeModelInterface::PROJECT . '_';
    const MILLIPEDE_FUNCTION_PATTERN = MillipedeModelInterface::FUNCTION . '_';
    const RETURN_TYPE_JSON= 'json';
    const RETURN_TYPE_STRINGIFIED_EMAILS = 'emails';

    /**
     * $data should contain multidimensional array, example:
     * $data = [
     *  1 => [
     *   'email' => 'example1@example.com',
     *   'project' => 'project name 1',
     *   'function' => 'D'
     *  ],
     *  2 => [
     *   'email' => 'example2@example.com',
     *   'project' => 'project name 2',
     *   'function' => 'L'
     *  ]
     * ]
     *
     * @param array $data
     *
     * @return string
     */
    public function getMillipede(array $data): string;

    /**
     * @param array $data
     *
     * @return array
     */
    public function resolveDevelopers(array $data): array;
}

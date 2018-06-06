<?php
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Api\Model;

/**
 * Interface MillipedeInterface
 */
interface MillipedeInterface
{
    const POSITION = 'position';
    const EMAIL = 'email';
    const DEVELOPER = 'developer';
    const PROJECT = 'project';
    const FUNCTION = 'function';
    const FUNCTION_DEVELOPER = 'D';
    const FUNCTION_LEADER = 'L';

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     *
     * @return MillipedeInterface
     */
    public function setPosition(int $position): MillipedeInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     *
     * @return MillipedeInterface
     */
    public function setEmail(string $email): MillipedeInterface;

    /**
     * @return string
     */
    public function getDeveloper(): string;

    /**
     * @param string $developer
     *
     * @return MillipedeInterface
     */
    public function setDeveloper(string $developer): MillipedeInterface;

    /**
     * @return string
     */
    public function getProject(): string;

    /**
     * @param string $project
     *
     * @return MillipedeInterface
     */
    public function setProject(string $project): MillipedeInterface;

    /**
     * @return string
     */
    public function getFunction(): string;

    /**
     * @param string $function
     *
     * @return MillipedeInterface
     */
    public function setFunction(string $function): MillipedeInterface;
}

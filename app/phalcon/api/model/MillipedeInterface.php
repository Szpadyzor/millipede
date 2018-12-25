<?php declare(strict_types=1);
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <maciej.trybula@gmail.com>
 * @copyright 2018 Trysoft
 */

namespace Millipede\Api\Model;

/**
 * Interface MillipedeInterface
 */
interface MillipedeInterface
{
    const AMOUNT = 'amount';
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
    public function getAmount(): int;

    /**
     * @param int $amount
     *
     * @return void
     */
    public function setAmount(int $amount): void;

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

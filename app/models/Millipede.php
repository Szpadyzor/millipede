<?php
/**
 * @package Millipede\Models
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Models;

use Millipede\Api\Model\MillipedeInterface;
use Phalcon\Mvc\Model;

/**
 * Class Millipede
 */
class Millipede extends Model implements MillipedeInterface
{
    /**
     * @var int $position
     */
    protected $position;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $developer
     */
    protected $developer;

    /**
     * @var string $project
     */
    protected $project;

    /**
     * @var string $function
     */
    protected $function;

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return MillipedeInterface
     */
    public function setPosition(int $position): MillipedeInterface
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return MillipedeInterface
     */
    public function setEmail(string $email): MillipedeInterface
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDeveloper(): string
    {
        return $this->developer;
    }

    /**
     * @param string $developer
     *
     * @return MillipedeInterface
     */
    public function setDeveloper(string $developer): MillipedeInterface
    {
        $this->developer = $developer;
    }

    /**
     * @return string
     */
    public function getProject(): string
    {
        return $this->project;
    }

    /**
     * @param string $project
     *
     * @return MillipedeInterface
     */
    public function setProject(string $project): MillipedeInterface
    {
        $this->project = $project;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @param string $function
     *
     * @return MillipedeInterface
     */
    public function setFunction(string $function): MillipedeInterface
    {
        $this->function = $function;
    }
}

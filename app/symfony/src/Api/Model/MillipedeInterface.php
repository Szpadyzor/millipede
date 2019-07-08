<?php
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <maciej.trybula@gmail.com>
 * @copyright 2018 Trysoft
 */

namespace App\Api\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface MillipedeInterface
 */
interface MillipedeInterface
{
    const ID = 'id';
    const AMOUNT = 'amount';
    const CREATED_AT = 'created_at';
    const MILLIPEDE = 'millipede';
    const DEVELOPERS = 'developers';

    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @param $id
     *
     * @return void
     */
    public function setId($id): void;

    /**
     * @return int
     */
    public function getAmount(): ?int;

    /**
     * @param int $amount
     *
     * @return void
     */
    public function setAmount(int $amount): void;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * @return ArrayCollection
     */
    public function getDevelopers(): ArrayCollection;

    /**
     * @param ArrayCollection $developers
     *
     * @return void
     */
    public function setDevelopers(ArrayCollection $developers): void;

}

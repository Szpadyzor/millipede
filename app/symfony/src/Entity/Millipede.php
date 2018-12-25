<?php
/**
 * @package App\Entity
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace App\Entity;

use App\Api\Model\MillipedeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Millipede
 * @ORM\Entity(repositoryClass="App\Repository\MillipedeRepository")
 * @ORM\Table(name="millipede")
 */
class Millipede implements MillipedeInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int $amount
     *
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var string $millipede
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $millipede;

    /**
     * @var ArrayCollection $developers
     */
    private $developers;

    /**
     * Millipede constructor.
     */
    public function __construct()
    {
        $this->developers = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return void
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getMillipede(): ?string
    {
        return $this->millipede;
    }

    /**
     * @param string $millipede
     */
    public function setMillipede(string $millipede): void
    {
        $this->millipede = $millipede;
    }

    /**
     * @return ArrayCollection
     */
    public function getDevelopers(): ArrayCollection
    {
        return $this->developers;
    }

    /**
     * @param ArrayCollection $developers
     *
     * @return void
     */
    public function setDevelopers(ArrayCollection $developers): void
    {
        $this->developers = $developers;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 25.12.18
 * Time: 12:18
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Developer
 *
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperRepository")
 * @ORM\Table(name="developer")
 */
class Developer
{
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const FUNCTION = 'function';
    const PROJECT = 'project';
    const EMAIL = 'email';

    const FUNCTION_DEVELOPER = 'D';
    const FUNCTION_LEADER = 'L';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $firstname
     *
     * @ORM\Column(type="string")
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(type="string")
     */
    private $lastname;

    /**
     * @var string $function
     *
     * @ORM\Column(type="string")
     */
    private $function;

    /**
     * @var string $project
     *
     * @ORM\Column(type="string")
     */
    private $project;

    /**
     * @var string $email
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }


    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param mixed $function
     */
    public function setFunction($function): void
    {
        $this->function = $function;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project): void
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 09.01.19
 * Time: 13:10
 */

namespace App\Repository;

use App\Entity\Developer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class DeveloperRepository
 *
 * @package App\Repository
 */
class DeveloperRepository extends EntityRepository
{
    /**
     * @return ArrayCollection
     */
    public function getAllDevelopers()
    {
       $developers = $this->findAll();

       return new ArrayCollection($developers);
    }
}
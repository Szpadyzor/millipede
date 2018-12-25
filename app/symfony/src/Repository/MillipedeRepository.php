<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 09.01.19
 * Time: 14:35
 */

namespace App\Repository;

use App\Api\Model\MillipedeInterface;
use App\Entity\Millipede;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class MillipedeRepository
 *
 * @package App\Repository
 */
class MillipedeRepository extends EntityRepository
{
    public function getCurrentMillipede()
    {
        $millipede = $this->findBy([], ['id' => 'DESC'], 1);

        return current($millipede);
    }

    public function save(MillipedeInterface $millipede)
    {
//        if ($millipede && $millipede->getId()) {
//            $entity = $this->find($millipede->getId());
//        } else {
//            $entity = new Millipede();
//        }

        $this->getEntityManager()->persist($millipede);
        $this->getEntityManager()->flush();
    }
}
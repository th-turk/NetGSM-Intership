<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 29.8.2017
 * Time: 21:55
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Employee;
use Doctrine\ORM\EntityRepository;

class EmplooyeeRepository extends EntityRepository
{
    /**
     * @return Employee[]
     */
    public function findAllNotDeleted($offset =null,$limit = null)
    {
        return $this->createQueryBuilder("e")
            ->andWhere("e.delCase = :deleted")
            ->setParameter("deleted",false)
            ->orderBy("e.id","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }
}
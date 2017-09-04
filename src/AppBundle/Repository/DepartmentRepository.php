<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 29.8.2017
 * Time: 21:55
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Department;
use Doctrine\ORM\EntityRepository;

class DepartmentRepository extends EntityRepository
{
    /**
     * @return Department[]
     */
    public function findAllNotDeleted()
    {
        return $this->createQueryBuilder("d")
            ->andWhere("d.delCase = :deleted")
            ->setParameter("deleted",false)
            ->orderBy("d.name","ASC")
            ->getQuery()
            ->execute()
            ;
    }
}
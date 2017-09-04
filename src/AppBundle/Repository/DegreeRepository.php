<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 31.8.2017
 * Time: 20:37
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Degree;
use Doctrine\ORM\EntityRepository;

class DegreeRepository extends DepartmentRepository
{
    /**
     * @return Degree[]
     */
    public function findAllNotDeleted()
    {
        return $this->createQueryBuilder("d")
            ->andWhere("d.delCase = :deleted")
            ->setParameter("deleted","0")
            ->orderBy("d.name","ASC")
            ->getQuery()
            ->execute()
            ;
    }

}
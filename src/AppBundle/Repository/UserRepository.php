<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 3.9.2017
 * Time: 14:34
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Users;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class UserRepository extends EntityRepository
{
    public function findAll($offset=null,$limit=null)
    {
        return $this->createQueryBuilder("admins")
            ->orderBy("admins.usernamee","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }
    /**
     * @return Users[]
     */
    public function findAllAdmins($offset=null,$limit=null)
    {
        return $this->createQueryBuilder("admins")
            ->andWhere("admins.roles = :role")
            ->setParameter("role",'["ROLE_ADMIN"]')
            ->orderBy("admins.usernamee","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @return Users[]
     */
    public function findAllNotAdmins($offset=null,$limit=null)
    {
        return $this->createQueryBuilder("users")
            ->andWhere("users.roles = :role")
            ->setParameter("role",'["ROLE_USER"]')
            ->orderBy("users.usernamee","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @return Users[]
     */
    public function findAllEmployeeUser($offset=null,$limit=null)
    {
        return $this->createQueryBuilder("employed")
            ->where("employed.employee IS NOT NULL")
            ->orderBy("employed.usernamee","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }
    /**
     * @return Users[]
     */
    public function findAllNotEmployeeUser($offset=null,$limit=null)
    {
        return $this->createQueryBuilder("employed")
            ->where("employed.employee IS NULL")
            ->orderBy("employed.usernamee","ASC")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->execute()
            ;
    }
}
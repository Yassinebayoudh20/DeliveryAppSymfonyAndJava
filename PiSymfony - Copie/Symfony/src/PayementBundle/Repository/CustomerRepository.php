<?php
/**
 * Created by PhpStorm.
 * User: Yassine
 * Date: 4/13/2020
 * Time: 5:05 PM
 */

namespace PayementBundle\Repository;
use Doctrine\ORM\EntityRepository;



class CustomerRepository extends EntityRepository
{
    public function findOneById($userID)
    {
          $qeury =
              $this->createQueryBuilder('c')
          ->select('c')
          ->where('c.iduser = :iduser')
          ->setParameter('iduser', $userID)
          ->getQuery();
          return $qeury->execute();
    }
}
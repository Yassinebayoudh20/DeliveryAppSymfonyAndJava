<?php


namespace GroupBundle\Repository;


use Doctrine\ORM\EntityRepository;

class GroupColiRepository extends EntityRepository {

    public function getColi($GID){

        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.idGroup = :GID')
            ->setParameter('GID', $GID)
            ->getQuery();
        return $query->execute();
    }

}
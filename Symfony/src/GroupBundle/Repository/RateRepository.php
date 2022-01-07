<?php


namespace GroupBundle\Repository;


use Doctrine\ORM\EntityRepository;

class RateRepository extends EntityRepository
{
    public function getGrpRate($id){
        #$query = "SELECT AVG(rate_value) FROM rate where group_id = ".$groupLiv->getIdGroup();
        #$em = $this->getEntityManager();
        #$query = $em->createQuery(
        #    'SELECT AVG(r.rateValue) FROM GroupBundle:Rate r where r.group = :IdGroup'
        #)->setParameter('IdGroup', $id);

        #return $query->getResult();

        $query = $this->createQueryBuilder('r')
            ->select("r")
            ->where('r.group = :IdGroup')
            ->setParameter('IdGroup', $id)
            ->getQuery();

        return $query->getResult();

    }



}
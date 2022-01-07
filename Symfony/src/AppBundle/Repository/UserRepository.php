<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;


class UserRepository extends EntityRepository
{

    public function findByid($id){
        $query = $this->createQueryBuilder('u')
            ->select('u.username', 'u.email', 'u.lastLogin')
            ->innerJoin('GroupBundle:GroupPerson', 'gp', Join::WITH, 'gp.idUtilisateur = u.id')
            ->andWhere('gp.idGroup = :GID')
            ->setParameter('GID', $id);
        return $query->getQuery()->getResult();
    }

    #public function findUserByGroupId()

}

<?php


namespace GroupBundle\Repository;


use Doctrine\ORM\EntityRepository;

class GroupPersonRepository extends EntityRepository
{
    public function findGroupByUserId($userId){
        $query = $this->createQueryBuilder('g')
                      ->select('g')
                      ->where('g.idUtilisateur = :userId')
                      ->setParameter('userId', $userId)
                      ->getQuery();
        return $query->getResult();
    }

    public function removeFromGroup($usr, $groupPerson){
//        $query = $this->createQueryBuilder('g')
//                        ->delete()
    }

    public function isMember($personId, $groupId){
        $query = $this->createQueryBuilder('g')
            ->select('g')
            ->where('g.idUtilisateur = :user')
            ->setParameter('user', $personId)
            ->andWhere('g.idGroup = :group')
            ->setParameter('group', $groupId)
            ->getQuery();
        return $query->getResult();
    }

    public function deleteMember($pid, $gid){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->delete('GroupBundle:GroupPerson', 'g')
            ->where('g.idUtilisateur = :pid')
            ->setParameter("pid", $pid)
            ->andWhere('g.idGroup = :gid')
            ->setParameter('gid',$gid)
            ->getQuery();
        return $query->execute();
    }

}
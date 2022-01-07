<?php


namespace GroupBundle\Repository;

use AppBundle\Entity\Personne;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\Group;
use GroupBundle\Entity\GroupLiv;

class GroupLivRepository extends EntityRepository{

    public function showGrpLiv(){
        # $user = $this->container->get('security.context')->getToken()->getUser();
        # $author_id = $user->getId();

        $query=$this->createQueryBuilder('g')
                    #->from('GroupLiv')
                    ->getQuery();
        return $query->getResult();


    }

    public function getGrpMembers($id){
       # $this->getEntityManager()->getRepository(Personne::class)->
    }



}
<?php

namespace GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupLiv
 *
 * @ORM\Table(name="group_liv", indexes={@ORM\Index(name="id_admin", columns={"id_admin"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="GroupBundle\Repository\GroupLivRepository")
 */
class GroupLiv
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_group", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=15, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=15, nullable=false)
     */
    private $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating = 'NULL';

    /**
     * @var AppBundle/User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_admin", referencedColumnName="id")
     * })
     */
    private $idAdmin;

    /**
     * @return int
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
     * @param int $idGroup
     */
    public function setIdGroup($idGroup)
    {
        $this->idGroup = $idGroup;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return AppBundle
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * @param AppBundle $idAdmin
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }


}


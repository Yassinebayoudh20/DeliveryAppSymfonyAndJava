<?php

namespace GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupColi
 *
 * @ORM\Table(name="group_coli", indexes={@ORM\Index(name="id_group", columns={"id_group"}), @ORM\Index(name="id_coli", columns={"id_coli"}), @ORM\Index(name="id_util", columns={"id_util"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="GroupBundle\Repository\GroupColiRepository")
 */
class GroupColi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_coli", type="integer", nullable=false)
     *
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColi = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=false)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=true)
     */
    private $depart = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=true)
     */
    private $destination = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="date_limit", type="string", length=255, nullable=true)
     */
    private $dateLimit = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="reward", type="float", precision=10, scale=0, nullable=true)
     */
    private $reward ;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_util", referencedColumnName="id")
     * })
     */
    private $idUtil;

    /**
     * @var \GroupLiv
     *
     * @ORM\ManyToOne(targetEntity="GroupLiv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_group", referencedColumnName="id_group")
     * })
     */
    private $idGroup;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdColi()
    {
        return $this->idColi;
    }

    /**
     * @param int $idColi
     */
    public function setIdColi($idColi)
    {
        $this->idColi = $idColi;
    }

    /**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param string $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
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
     * @return string
     */
    public function getDateLimit()
    {
        return $this->dateLimit;
    }

    /**
     * @param string $dateLimit
     */
    public function setDateLimit($dateLimit)
    {
        $this->dateLimit = $dateLimit;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return float
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @param float $reward
     */
    public function setReward($reward)
    {
        $this->reward = $reward;
    }

    /**
     * @return integer
     */
    public function getIdUtil()
    {
        return $this->idUtil;
    }

    /**
     * @param integer $idUtil
     */
    public function setIdUtil($idUtil)
    {
        $this->idUtil = $idUtil;
    }

    /**
     * @return \GroupLiv
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
     * @param \GroupLiv $idGroup
     */
    public function setIdGroup($idGroup)
    {
        $this->idGroup = $idGroup;
    }


}


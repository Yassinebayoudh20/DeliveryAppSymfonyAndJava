<?php

namespace GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="group_id", columns={"group_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="GroupBundle\Repository\RateRepository")
 */

class Rate
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
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_value", type="integer", nullable=false)
     */
    private $rateValue;

    /**
     * @var \GroupLiv
     *
     * @ORM\ManyToOne(targetEntity="GroupLiv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id_group")
     * })
     */
    private $group;

    /**
     * @var AppBundle\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

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
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getRateValue()
    {
        return $this->rateValue;
    }

    /**
     * @param int $rateValue
     */
    public function setRateValue($rateValue)
    {
        $this->rateValue = $rateValue;
    }

    /**
     * @return \GroupLiv
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param \GroupLiv $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \FosUser $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}


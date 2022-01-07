<?php

namespace NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SBC\NotificationsBundle\Model\BaseNotification;

/**
 * Notifications
 *
 * @ORM\Table(name="notifications", indexes={@ORM\Index(name="fk_foreign_key_idlivrasion", columns={"idLivraison"}), @ORM\Index(name="fkColis", columns={"idColis"}), @ORM\Index(name="fk_foreign_key_idLivreur", columns={"idLivreur"}), @ORM\Index(name="fk_foreign_key_idpropColis", columns={"idPropC"})})
 * @ORM\Entity
 */
class Notifications
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
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var \Colis
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Colis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idColis", referencedColumnName="id")
     * })
     */
    private $idcolis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLivreur", referencedColumnName="id")
     * })
     */
    private $idlivreur;

    /**
     * @var \Livraison
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Livraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLivraison", referencedColumnName="id")
     * })
     */
    private $idlivraison;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPropC", referencedColumnName="id")
     * })
     */
    private $idpropc;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \Colis
     */
    public function getIdcolis()
    {
        return $this->idcolis;
    }

    /**
     * @param \Colis $idcolis
     */
    public function setIdcolis($idcolis)
    {
        $this->idcolis = $idcolis;
    }

    /**
     * @return \User
     */
    public function getIdlivreur()
    {
        return $this->idlivreur;
    }

    /**
     * @param \User $idlivreur
     */
    public function setIdlivreur($idlivreur)
    {
        $this->idlivreur = $idlivreur;
    }

    /**
     * @return \Livraison
     */
    public function getIdlivraison()
    {
        return $this->idlivraison;
    }

    /**
     * @param \Livraison $idlivraison
     */
    public function setIdlivraison($idlivraison)
    {
        $this->idlivraison = $idlivraison;
    }

    /**
     * @return \User
     */
    public function getIdpropc()
    {
        return $this->idpropc;
    }

    /**
     * @param \User $idpropc
     */
    public function setIdpropc($idpropc)
    {
        $this->idpropc = $idpropc;
    }




}


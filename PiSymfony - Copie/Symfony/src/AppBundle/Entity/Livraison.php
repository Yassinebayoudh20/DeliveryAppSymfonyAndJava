<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="Constraint_idLivreur", columns={"idLivreur"})})
 * @ORM\Entity
 */
class Livraison
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
     * @ORM\Column(name="depart", type="string", length=255, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=false)
     */
    private $destination;

    /**
     * @var float
     *
     * @ORM\Column(name="poid_disponible", type="float", precision=10, scale=0, nullable=false)
     */
    private $poidDisponible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temp_estime", type="date", nullable=false)
     */
    private $tempEstime;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_livraison", type="integer", nullable=true)
     */
    private $noteLivraison;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLivreur", referencedColumnName="id")
     * })
     */
    private $idlivreur;


}


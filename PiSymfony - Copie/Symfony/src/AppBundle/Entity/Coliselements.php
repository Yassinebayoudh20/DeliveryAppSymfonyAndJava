<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coliselements
 *
 * @ORM\Table(name="coliselements", indexes={@ORM\Index(name="etr_id_element", columns={"idElement"})})
 * @ORM\Entity
 */
class Coliselements
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idColis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcolis;

    /**
     * @var \Element
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Element")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idElement", referencedColumnName="id")
     * })
     */
    private $idelement;


}


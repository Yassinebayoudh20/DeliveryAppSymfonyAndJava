<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriecolis
 *
 * @ORM\Table(name="categoriecolis", indexes={@ORM\Index(name="add_forignkey_idCat", columns={"idCat"})})
 * @ORM\Entity
 */
class Categoriecolis
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
     * @var \Categories
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCat", referencedColumnName="id")
     * })
     */
    private $idcat;


}


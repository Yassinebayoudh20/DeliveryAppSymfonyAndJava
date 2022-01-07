<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity
 */
class Element
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="poid", type="float", precision=10, scale=0, nullable=false)
     */
    private $poid;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=true)
     */
    private $image;


}


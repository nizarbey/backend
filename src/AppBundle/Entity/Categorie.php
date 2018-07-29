<?php

/**
 * Description of Categorie
 *
 * @author LENOVO
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Categorie {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;
    
        
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * @ORM\OneToMany(targetEntity="Produit", mappedBy="categorie", cascade={"persist"})
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }
    
    public function getProduits()
    {
        return $this->produits;
    }
    
}

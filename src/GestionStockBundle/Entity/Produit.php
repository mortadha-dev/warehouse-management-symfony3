<?php

namespace GestionStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="GestionStockBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */

    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="quantitemin", type="integer")
     */
    private $quantitemin;


    /**
     * @var boolean
     *
     * @ORM\Column(name="supprimer", type="boolean")
     */
    private $supprimer;




    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesupp", type="date",nullable=true)
     */
    private $dateSupp;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set quantitemin
     *
     * @param integer $quantitemin
     *
     * @return Produit
     */
    public function setQuantitemin($quantitemin)
    {
        $this->quantitemin = $quantitemin;

        return $this;
    }

    /**
     * Get quantitemin
     *
     * @return int
     */
    public function getQuantitemin()
    {
        return $this->quantitemin;
    }

    /**
     * @return bool
     */
    public function isSupprimer()
    {
        return $this->supprimer;
    }

    /**
     * @param bool $supprimer
     */
    public function setSupprimer($supprimer)
    {
        $this->supprimer = $supprimer;
    }

    /**
     * @return \DateTime
     */
    public function getDateSupp()
    {
        return $this->dateSupp;
    }

    /**
     * @param \DateTime $dateSupp
     */
    public function setDateSupp($dateSupp)
    {
        $this->dateSupp = $dateSupp;
    }


}


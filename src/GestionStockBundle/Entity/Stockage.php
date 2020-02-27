<?php

namespace GestionStockBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Stockage
 *
 * @ORM\Table(name="stockage")
 * @ORM\Entity(repositoryClass="GestionStockBundle\Repository\StockageRepository")
 */
class Stockage
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     * @Assert\NotNull(message="La quantite doît être différent de 0")
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedestockage", type="date")
     *  @Assert\Date
     * @Assert\GreaterThanOrEqual("today")
     */
    private $datedestockage;
    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="id_produit", referencedColumnName="id", nullable=false)
     *
     */
    private $produit;
    /**
     * @ORM\ManyToOne(targetEntity="Entrepot")
     * @ORM\JoinColumn(name="id_entrepot", referencedColumnName="id", nullable=false)
     *
     */
    private $entrepot;
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
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * Set datedestockage
     *
     * @param \DateTime $datedestockage
     *
     * @return Stockage
     */
    public function setDatedestockage($datedestockage)
    {
        $this->datedestockage = $datedestockage;

        return $this;
    }

    /**
     * Get datedestockage
     *
     * @return \DateTime
     */
    public function getDatedestockage()
    {
        return $this->datedestockage;
    }

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * @return mixed
     */
    public function getEntrepot()
    {
        return $this->entrepot;
    }

    /**
     * @param mixed $entrepot
     */
    public function setEntrepot($entrepot)
    {
        $this->entrepot = $entrepot;
    }



}


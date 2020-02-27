<?php

namespace GestionAchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="GestionAchatBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="libellecommande", type="string", length=255)
     *
     * @Assert\Length(
     * min = 3,
     *max = 50,
     *minMessage = "la libelle de la commande doit comporter au moins 3 caractères",
     *maxMessage = "la libelle de la commande ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="La libelle de la commande ne doit pas etre null ")
     *
     */
    private $libellecommande;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptioncommande", type="string", length=255)
     *
     * @Assert\Length(
     * min = 5,
     *max = 40,
     *minMessage = "la description de la commande doit comporter au moins 5 caractères",
     *maxMessage = "la description de la commande ne doit pas dépasser les {{limit}} 40 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="La description de la commande ne doit pas etre null ")
     *
     */
    private $descriptioncommande;

    /**
     * @var int
     *
     * @ORM\Column(name="quantitecommande", type="integer")
     */
    private $quantitecommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\GreaterThan("today")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="nomfournisseur", type="string", length=255)
     */

    private $nomfournisseur;


    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255 , nullable=true)
     *
     */

    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="prixUnitaire", type="integer")
     */

    private $prixUnitaire;

    /**
     * @var int
     *
     * @ORM\Column(name="prixTotal", type="integer")
     */

    private $prixTotal;



    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */

    private $commentaire;


    /**
     * @ORM\ManyToOne(targetEntity="Fournisseur")
     * @ORM\JoinColumn(name="fournisseur_id", referencedColumnName="id")
     *
     */
    private $fournisseur;
    /**
     * @ORM\ManyToOne(targetEntity="GestionStockBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     *
     */
    private $produit;


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
     * Set libellecommande
     *
     * @param string $libellecommande
     *
     * @return Commande
     */
    public function setLibellecommande($libellecommande)
    {
        $this->libellecommande = $libellecommande;

        return $this;
    }

    /**
     * Get libellecommande
     *
     * @return string
     */
    public function getLibellecommande()
    {
        return $this->libellecommande;
    }

    /**
     * Set descriptioncommande
     *
     * @param string $descriptioncommande
     *
     * @return Commande
     */
    public function setDescriptioncommande($descriptioncommande)
    {
        $this->descriptioncommande = $descriptioncommande;

        return $this;
    }

    /**
     * Get descriptioncommande
     *
     * @return string
     */
    public function getDescriptioncommande()
    {
        return $this->descriptioncommande;
    }

    /**
     * Set quantitecommande
     *
     * @param integer $quantitecommande
     *
     * @return Commande
     */
    public function setQuantitecommande($quantitecommande)
    {
        $this->quantitecommande = $quantitecommande;

        return $this;
    }

    /**
     * Get quantitecommande
     *
     * @return int
     */
    public function getQuantitecommande()
    {
        return $this->quantitecommande;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * @param mixed $fournisseur
     */
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;
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
     * @return string
     */
    public function getNomfournisseur()
    {
        return $this->nomfournisseur;
    }

    /**
     * @param string $nomfournisseur
     */
    public function setNomfournisseur($nomfournisseur)
    {
        $this->nomfournisseur = $nomfournisseur;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return int
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * @param int $prixUnitaire
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    }

    /**
     * @return int
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * @param int $prixTotal
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }




}


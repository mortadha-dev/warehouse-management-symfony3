<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="LivraisonBundle\Repository\LivraisonRepository")
 */
class Livraison
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
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @return mixed
     */
    public function getLivreur()
    {
        return $this->livreur;
    }

    /**
     * @param mixed $livreur
     */
    public function setLivreur($livreur)
    {
        $this->livreur = $livreur;
    }
    /**
     *
     * @ORM\ManyToOne(targetEntity="Livreure")
     * @ORM\JoinColumn(name="livreure_id",referencedColumnName="id" , onDelete="CASCADE")
     */
    private $livreur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateliv", type="date")
     * @Assert\GreaterThan("today",message="invalid time")
     */
    private $dateliv;

    /**
     * @var string
     *
     * @ORM\Column(name="heurliv", type="string", length=255)
     */
    private $heurliv;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="livreure", type="string", length=255)
     */
    private $livreure;

    /**
     * @var string
     *
     * @ORM\Column(name="commande", type="string", length=255)
     */
    private $commande;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255)
     */
    private $client;


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
     * Set ville
     *
     * @param string $ville
     *
     * @return Livraison
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Livraison
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Livraison
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set dateliv
     *
     * @param \DateTime $dateliv
     *
     * @return Livraison
     */
    public function setDateliv($dateliv)
    {
        $this->dateliv = $dateliv;

        return $this;
    }

    /**
     * Get dateliv
     *
     * @return \DateTime
     */
    public function getDateliv()
    {
        return $this->dateliv;
    }

    /**
     * Set heurliv
     *
     * @param string $heurliv
     *
     * @return Livraison
     */
    public function setHeurliv($heurliv)
    {
        $this->heurliv = $heurliv;

        return $this;
    }

    /**
     * Get heurliv
     *
     * @return string
     */
    public function getHeurliv()
    {
        return $this->heurliv;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Livraison
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set livreure
     *
     * @param string $livreure
     *
     * @return Livraison
     */
    public function setLivreure($livreure)
    {
        $this->livreure = $livreure;

        return $this;
    }

    /**
     * Get livreure
     *
     * @return string
     */
    public function getLivreure()
    {
        return $this->livreure;
    }

    /**
     * Set commande
     *
     * @param string $commande
     *
     * @return Livraison
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return string
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set client
     *
     * @param string $client
     *
     * @return Livraison
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }
}


<?php

namespace GestionAchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $libellecommande;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptioncommande", type="string", length=255)
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
     */
    private $date;


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
}


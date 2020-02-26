<?php

namespace GestionVenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeVente
 *
 * @ORM\Table(name="commande_vente")
 * @ORM\Entity(repositoryClass="GestionVenteBundle\Repository\CommandeVenteRepository")
 */
class CommandeVente
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
     * @ORM\Column(name="idClient", type="string", unique=false)
     */
    private $idClient;

    /**
     * @var boolean
     * @ORM\Column(name="livree", type="boolean")
     */
    private $livree = false;


    /**
     * @var int
     *
     * @ORM\Column(name="idLivraison", type="integer", nullable=true)
     */
    private $idLivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoie", type="datetime", nullable=true)
     */
    private $dateEnvoie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReception", type="datetime", nullable=true)
     */
    private $dateReception;

    /**
     * @var array
     *
     * @ORM\Column(name="selections", type="json_array")
     */
    private $selections;


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
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return CommandeVente
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return int
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idLivraison
     *
     * @param integer $idLivraison
     *
     * @return CommandeVente
     */
    public function setIdLivraison($idLivraison)
    {
        $this->idLivraison = $idLivraison;

        return $this;
    }

    /**
     * Get idLivraison
     *
     * @return int
     */
    public function getIdLivraison()
    {
        return $this->idLivraison;
    }

    /**
     * Set dateEnvoie
     *
     * @param \DateTime $dateEnvoie
     *
     * @return CommandeVente
     */
    public function setDateEnvoie($dateEnvoie)
    {
        $this->dateEnvoie = $dateEnvoie;

        return $this;
    }

    /**
     * Get dateEnvoie
     *
     * @return \DateTime
     */
    public function getDateEnvoie()
    {
        return $this->dateEnvoie;
    }

    /**
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return CommandeVente
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set selections
     *
     * @param array $selections
     *
     * @return CommandeVente
     */
    public function setSelections($selections)
    {
        $this->selections = $selections;

        return $this;
    }

    /**
     * Get selections
     *
     * @return array
     */
    public function getSelections()
    {
        return $this->selections;
    }

    /**
     * @return boolean
     */
    public function getLivree()
    {
        return $this->livree;
    }

    /**
     * @param boolean
     */
    public function setLivree($livree)
    {
        $this->livree = $livree;
    }

}


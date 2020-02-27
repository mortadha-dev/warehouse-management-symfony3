<?php

namespace GestionAchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="GestionAchatBundle\Repository\FournisseurRepository")
 */
class Fournisseur
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
     * @ORM\Column(name="code", type="string", length=255)
     */

    private $code;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\Length(
     * min = 3,
     *max = 50,
     *minMessage = "le nom du fournisseur doit comporter au moins 3 caractères",
     *maxMessage = "le nom du fournisseur ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="le nom du fournisseur ne doit pas etre null ")
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     *
     * @Assert\Length(
     * min = 3,
     *max = 50,
     *minMessage = "le prenom du fournisseur doit comporter au moins 3 caractères",
     *maxMessage = "le prenom du fournisseur ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="le prenom du fournisseur ne doit pas etre null ")
     *
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     *
     * @Assert\Length(
     * min = 3,
     *max = 50,
     *minMessage = "la ville du fournisseur doit comporter au moins 3 caractères",
     *maxMessage = "la ville du fournisseur ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="la ville du fournisseur ne doit pas etre null ")
     *
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     *
     * @Assert\Length(
     * min = 3,
     *max = 50,
     *minMessage = "le pays du fournisseur doit comporter au moins 3 caractères",
     *maxMessage = "le pays du fournisseur ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     *
     ** @Assert\NotNull(message="le pays du fournisseur ne doit pas etre null ")
     *
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_email", type="string", length=255)
     */
    private $adresseEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="rapidite", type="string", length=255)
     */
    private $rapidite;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
     private $user;

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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return fournisseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return fournisseur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return fournisseur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return fournisseur
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
     * @return fournisseur
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
     * Set adresseEmail
     *
     * @param string $adresseEmail
     *
     * @return fournisseur
     */
    public function setAdresseEmail($adresseEmail)
    {
        $this->adresseEmail = $adresseEmail;

        return $this;
    }

    /**
     * Get adresseEmail
     *
     * @return string
     */
    public function getAdresseEmail()
    {
        return $this->adresseEmail;
    }

    /**
     * @return string
     */
    public function getRapidite()
    {
        return $this->rapidite;
    }

    /**
     * @param string $rapidite
     */
    public function setRapidite($rapidite)
    {
        $this->rapidite = $rapidite;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



}


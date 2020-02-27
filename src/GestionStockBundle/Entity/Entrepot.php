<?php

namespace GestionStockBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entrepot
 *
 * @ORM\Table(name="entrepot")
 * @ORM\Entity(repositoryClass="GestionStockBundle\Repository\EntrepotRepository")
 */
class Entrepot
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
     * @ORM\Column(name="nomcourtlieu", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "le nom court du lieu de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "le nom court du lieu de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="Le nom court du lieu de l'entrepot doit etre non null ")
     *
     */
    private $nomcourtlieu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "la description de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "la description de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="La description de l'entrepot doit etre non null ")
     *
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "l'adresse de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "l'adresse de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="L'adresse de l'entrepot doit etre non null ")
     *
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostale", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "le code postale de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "le code postale de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="Le code postale de l'entrepot doit etre non null ")
     *
     */
    private $codepostale;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "la ville de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "la ville de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="La ville de l'entrepot doit etre non null ")
     *
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "la pays de l'entrepot doit comporter au moins 3 caractères",
     *      maxMessage = "la pays de l'entrepot ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="La pays de l'entrepot doit etre non null ")
     *
     */
    private $pays;

    /**
     * @var int
     *
     * @ORM\Column(name="stockphysique", type="integer")
     * @Assert\NotNull(message="Le stock physique doît être différent de 0")
     */
    private $stockphysique;


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
     * Set nomcourtlieu
     *
     * @param string $nomcourtlieu
     *
     * @return Entrepot
     */
    public function setNomcourtlieu($nomcourtlieu)
    {
        $this->nomcourtlieu = $nomcourtlieu;

        return $this;
    }

    /**
     * Get nomcourtlieu
     *
     * @return string
     */
    public function getNomcourtlieu()
    {
        return $this->nomcourtlieu;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Entrepot
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
     * Set adress
     *
     * @param string $adress
     *
     * @return Entrepot
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set codepostale
     *
     * @param string $codepostale
     *
     * @return Entrepot
     */
    public function setCodepostale($codepostale)
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    /**
     * Get codepostale
     *
     * @return string
     */
    public function getCodepostale()
    {
        return $this->codepostale;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Entrepot
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
     * @return Entrepot
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
     * @return int
     */
    public function getStockphysique()
    {
        return $this->stockphysique;
    }

    /**
     * @param int $stockphysique
     */
    public function setStockphysique($stockphysique)
    {
        $this->stockphysique = $stockphysique;
    }


}


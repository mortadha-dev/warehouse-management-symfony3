<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Livreure
 *
 * @ORM\Table(name="livreure")
 * @ORM\Entity(repositoryClass="LivraisonBundle\Repository\LivreureRepository")
 */
class Livreure
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
     * @return string
     */

    /**
     * @var int
     *
     * @ORM\Column(name="numtel", type="integer")
     */
    private $numtel;

    /**
     * @return int
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param int $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="nomliv", type="string", length=255)
     *
     * @Assert\Length(
     * min=5,
     * max = 20,
     * minMessage = "le nom de l'événement doit comporter au moins 3 caractères",
     * maxMessage = "le nom de l'événement ne doit pas dépasser les {{limit}} 50 caractères")
     */

    private $nomliv;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseliv", type="string", length=255)
     *  @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     */
    private $adresseliv;



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
     * Set nomliv
     *
     * @param string $nomliv
     *
     * @return Livreure
     */
    public function setNomliv($nomliv)
    {
        $this->nomliv = $nomliv;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdresseliv()
    {
        return $this->adresseliv;
    }

    /**
     * @param string $adresseliv
     */
    public function setAdresseliv($adresseliv)
    {
        $this->adresseliv = $adresseliv;
    }

    /**
     * Get nomliv
     *
     * @return string
     */
    public function getNomliv()
    {
        return $this->nomliv;
    }
    public function __toString()
    {
        return $this->nomliv;
    }




}


<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Cassandra\Date;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $saison;

    /**
     * @return mixed
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * @param mixed $saison
     */
    public function setSaison($saison): void
    {
        $this->saison = $saison;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Liste",inversedBy="season")
     */
    private $liste;
    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    /**
     * @Assert\NotBlank(message="remplissez")
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @return mixed
     */
    public function getListe()
    {
        return $this->liste;
    }

    /**
     * @param mixed $liste
     */
    public function setListe($liste): void
    {
        $this->liste = $liste;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}

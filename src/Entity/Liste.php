<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
class Liste
{
    use Translatable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Season",mappedBy="liste")
     */
    private $season;
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season): void
    {
        $this->season = $season;
    }

    public function getLabel()
    {
        return $this->proxyCurrentLocaleTranslation('getLabel');
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($laDate): self
        {
            $this->date = $laDate;
            return $this;
        }
    public function setLabel($label): self
    {
         return $this->proxyCurrentLocaleTranslation('setLabel',['label' => $label]);
    }
}

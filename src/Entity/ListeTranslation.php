<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
class ListeTranslation
{
    use Translation;
    /**
     * @Assert\NotBlank(message="remplissez")
     * @ORM\Column(type="string", length=255)
     */
    private $label;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Season",mappedBy="liste")
     */

    public function getLabel()
    {
        return $this->label;
    }
    public function setLabel($label): self
    {
        $this->label = $label;

        return $this;
    }
}

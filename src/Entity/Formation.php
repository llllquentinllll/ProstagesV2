<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $nomLong;

    /**
     * @ORM\ManyToMany(targetEntity=Stage::class, mappedBy="formations")
     */
    private $stagesFormation;

    public function __construct()
    {
        $this->stagesFormation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNomLong(): ?string
    {
        return $this->nomLong;
    }

    public function setNomLong(string $nomLong): self
    {
        $this->nomLong = $nomLong;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStagesFormation(): Collection
    {
        return $this->stagesFormation;
    }

    public function addStagesFormation(Stage $stagesFormation): self
    {
        if (!$this->stagesFormation->contains($stagesFormation)) {
            $this->stagesFormation[] = $stagesFormation;
            $stagesFormation->addFormation($this);
        }

        return $this;
    }

    public function removeStagesFormation(Stage $stagesFormation): self
    {
        if ($this->stagesFormation->removeElement($stagesFormation)) {
            $stagesFormation->removeFormation($this);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraint\NotBlank;
use Symfony\Component\Validator\Constraint\Url;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\NotBlank(message="Ce champs ne peut être vide!")
     * @Assert\Length(min=4, minMessage="Le nom doit faire plus de 4 caractères!")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=300)
     * *@Assert\Regex(pattern="# (rue|boulevard|avenue|impasse|allée|place|voie) #i",message="Erreur au niveau du nom de votre voie");
     * *@Assert\Regex(pattern="#^[1-9][0-9]{0-2}( ?bis)? #", message="Erreur au niveau de votre numéro de rue");
     * *@Assert\Regex(pattern="# [0-9]{5} #",message="Erreur au niveau code postal");
     */
    
     //@Assert\Regex(pattern='# [0-9]{5} #')
    
     private $adresse;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\NotBlank(message="Ce champs ne peut être vide!")
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\Url(message="Ce champs doit être une url")
     */
    private $siteWeb;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="entreprise")
     */
    private $stageEntreprise;

    public function __construct()
    {
        $this->stageEntreprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStageEntreprise(): Collection
    {
        return $this->stageEntreprise;
    }

    public function addStageEntreprise(Stage $stageEntreprise): self
    {
        if (!$this->stageEntreprise->contains($stageEntreprise)) {
            $this->stageEntreprise[] = $stageEntreprise;
            $stageEntreprise->setEntreprise($this);
        }

        return $this;
    }

    public function removeStageEntreprise(Stage $stageEntreprise): self
    {
        if ($this->stageEntreprise->removeElement($stageEntreprise)) {
            // set the owning side to null (unless already changed)
            if ($stageEntreprise->getEntreprise() === $this) {
                $stageEntreprise->setEntreprise(null);
            }
        }

        return $this;
    }
}

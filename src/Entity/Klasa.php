<?php

namespace App\Entity;

use App\Repository\KlasaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlasaRepository::class)
 */
class Klasa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $stanowisko;

    /**
     * @ORM\OneToMany(targetEntity=Osoba::class, mappedBy="klasa")
     */
    private $osoba;

    public function __construct()
    {
        $this->osoba = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(?string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getStanowisko(): ?string
    {
        return $this->stanowisko;
    }

    public function setStanowisko(?string $stanowisko): self
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * @return Collection|Osoba[]
     */
    public function getOsoba(): Collection
    {
        return $this->osoba;
    }

    public function addOsoba(Osoba $osoba): self
    {
        if (!$this->osoba->contains($osoba)) {
            $this->osoba[] = $osoba;
            $osoba->setKlasa($this);
        }

        return $this;
    }

    public function removeOsoba(Osoba $osoba): self
    {
        if ($this->osoba->contains($osoba)) {
            $this->osoba->removeElement($osoba);
            // set the owning side to null (unless already changed)
            if ($osoba->getKlasa() === $this) {
                $osoba->setKlasa(null);
            }
        }

        return $this;
    }
    public function __toString() 
    {
        return $this->nazwa;
    }
}

<?php

namespace App\Entity;

use App\Repository\OsobaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OsobaRepository::class)
 */
class Osoba
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
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wiek;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Klasa::class, inversedBy="osoba")
     */
    private $klasa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWiek(): ?int
    {
        return $this->wiek;
    }

    public function setWiek(?int $wiek): self
    {
        $this->wiek = $wiek;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getKlasa(): ?Klasa
    {
        return $this->klasa;
    }

    public function setKlasa(?Klasa $klasa): self
    {
        $this->klasa = $klasa;

        return $this;
    }
   public function __toString()
   {
       return $this->name;
   }
}

<?php

namespace App\Entity;

use App\Repository\ImgmascotaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgmascotaRepository::class)]
class Imgmascota
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $src = null;

    #[ORM\ManyToOne(inversedBy: 'imgmascotas')]
    private ?mascota $mascota = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function getMascota(): ?mascota
    {
        return $this->mascota;
    }

    public function setMascota(?mascota $mascota): self
    {
        $this->mascota = $mascota;

        return $this;
    }
}

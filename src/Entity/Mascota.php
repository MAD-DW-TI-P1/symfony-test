<?php

namespace App\Entity;

use App\Repository\MascotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MascotaRepository::class)]
class Mascota
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $edad = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $created = null;

    #[ORM\OneToMany(mappedBy: 'mascota', targetEntity: Imgmascota::class)]
    private Collection $imgmascotas;

    public function __construct()
    {
        $this->imgmascotas = new ArrayCollection();
    }

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


    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getCreated(): ?\DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Collection<int, Imgmascota>
     */
    public function getImgmascotas(): Collection
    {
        return $this->imgmascotas;
    }

    public function addImgmascota(Imgmascota $imgmascota): self
    {
        if (!$this->imgmascotas->contains($imgmascota)) {
            $this->imgmascotas->add($imgmascota);
            $imgmascota->setMascota($this);
        }

        return $this;
    }

    public function removeImgmascota(Imgmascota $imgmascota): self
    {
        if ($this->imgmascotas->removeElement($imgmascota)) {
            // set the owning side to null (unless already changed)
            if ($imgmascota->getMascota() === $this) {
                $imgmascota->setMascota(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}

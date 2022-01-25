<?php

namespace App\Entity;

use App\Repository\PeliculaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeliculaRepository::class)
 */
class Pelicula
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sinopsis;

    /**
     * @ORM\Column(type="float")
     */
    private $Precio;

    /**
     * @ORM\Column(type="integer")
     */
    private $Tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Genero;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha_estreno;

    /**
     * @ORM\OneToMany(targetEntity=Alquiler::class, mappedBy="pelicula")
     */
    private $alquiler;

    public function __construct()
    {
        $this->alquiler = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->Sinopsis;
    }

    public function setSinopsis(string $Sinopsis): self
    {
        $this->Sinopsis = $Sinopsis;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->Precio;
    }

    public function setPrecio(float $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->Tipo;
    }

    public function setTipo(int $Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->Genero;
    }

    public function setGenero(string $Genero): self
    {
        $this->Genero = $Genero;

        return $this;
    }

    public function getFechaEstreno(): ?\DateTimeInterface
    {
        return $this->Fecha_estreno;
    }

    public function setFechaEstreno(\DateTimeInterface $Fecha_estreno): self
    {
        $this->Fecha_estreno = $Fecha_estreno;

        return $this;
    }

    /**
     * @return Collection|Alquiler[]
     */
    public function getAlquiler(): Collection
    {
        return $this->alquiler;
    }

    public function addAlquiler(Alquiler $alquiler): self
    {
        if (!$this->alquiler->contains($alquiler)) {
            $this->alquiler[] = $alquiler;
            $alquiler->setPelicula($this);
        }

        return $this;
    }

    public function removeAlquiler(Alquiler $alquiler): self
    {
        if ($this->alquiler->removeElement($alquiler)) {
            // set the owning side to null (unless already changed)
            if ($alquiler->getPelicula() === $this) {
                $alquiler->setPelicula(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this -> Nombre;
    }
}

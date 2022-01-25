<?php

namespace App\Entity;

use App\Repository\AlquilerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlquilerRepository::class)
 */
class Alquiler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Precio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha_inicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_fin;

    /**
     * @ORM\ManyToOne(targetEntity=Pelicula::class, inversedBy="alquiler")
     */
    private $pelicula;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->nombre;
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->Fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $Fecha_inicio): self
    {
        $this->Fecha_inicio = $Fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getPelicula(): ?Pelicula
    {
        return $this->pelicula;
    }

    public function setPelicula(?Pelicula $pelicula): self
    {
        $this->pelicula = $pelicula;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AlquileresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlquileresRepository::class)
 */
class Alquileres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    *@ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="alquileres") 
    */
    private $user;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pelicula", mappedBy="alquiler")
     */
    private $peliculas;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Cliente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Peliculas;

    /**
     * @ORM\Column(type="integer")
     */
    private $Valor_total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha_inicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha_fin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?string
    {
        return $this->Cliente;
    }

    public function setCliente(string $Cliente): self
    {
        $this->Cliente = $Cliente;

        return $this;
    }

    public function getPeliculas(): ?string
    {
        return $this->Peliculas;
    }

    public function setPeliculas(string $Peliculas): self
    {
        $this->Peliculas = $Peliculas;

        return $this;
    }

    public function getValorTotal(): ?int
    {
        return $this->Valor_total;
    }

    public function setValorTotal(int $Valor_total): self
    {
        $this->Valor_total = $Valor_total;

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
        return $this->Fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $Fecha_fin): self
    {
        $this->Fecha_fin = $Fecha_fin;

        return $this;
    }
}

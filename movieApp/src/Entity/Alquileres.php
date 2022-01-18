<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alquileres
 *
 * @ORM\Table(name="alquileres")
 * @ORM\Entity
 */
class Alquileres
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Cliente", type="string", length=60, nullable=false)
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="Películas", type="string", length=60, nullable=false)
     */
    private $pel�culas;

    /**
     * @var float
     *
     * @ORM\Column(name="Valor Total", type="float", precision=10, scale=0, nullable=false)
     */
    private $valorTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha Inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha Fin", type="date", nullable=false)
     */
    private $fechaFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCliente(): ?string
    {
        return $this->cliente;
    }

    public function setCliente(string $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getPel�culas(): ?string
    {
        return $this->pel�culas;
    }

    public function setPel�culas(string $pel�culas): self
    {
        $this->pel�culas = $pel�culas;

        return $this;
    }

    public function getValorTotal(): ?float
    {
        return $this->valorTotal;
    }

    public function setValorTotal(float $valorTotal): self
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }


}

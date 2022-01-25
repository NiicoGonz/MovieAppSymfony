<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Alquiler
 *
 * @ORM\Table(name="alquiler", indexes={@ORM\Index(name="fk_alquiler_cliente", columns={"cliente_id"})})
 * @ORM\Entity
 */
class Alquiler
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
     * @var float
     *
     * @ORM\Column(name="valor_total", type="float", precision=200, scale=2, nullable=false)
     */
    private $valorTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=Pelicula::class, inversedBy="alquileres")
     */
    private $peliculas;

    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|Pelicula[]
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Pelicula $pelicula): self
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas[] = $pelicula;
        }

        return $this;
    }

    public function removePelicula(Pelicula $pelicula): self
    {
        $this->peliculas->removeElement($pelicula);

        return $this;
    }


}

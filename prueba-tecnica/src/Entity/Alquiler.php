<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alquileres
 *
 * @ORM\Table(name="alquileres", indexes={@ORM\Index(name="alquiler_cliente_fk", columns={"cliente_id"})})
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
     * @ORM\Column(name="valorTotal", type="float", precision=100, scale=2, nullable=false)
     */
    private $valortotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=false)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date", nullable=false)
     */
    private $fechafin;


    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=Pelicula::class, inversedBy="alquilers")
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

    public function getValortotal(): ?float
    {
        return $this->valortotal;
    }

    public function setValortotal(float $valortotal): self
    {
        $this->valortotal = $valortotal;

        return $this;
    }

    public function getFechainicio(): ?\DateTimeInterface
    {
        return $this->fechainicio;
    }

    public function setFechainicio(\DateTimeInterface $fechainicio): self
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    public function getFechafin(): ?\DateTimeInterface
    {
        return $this->fechafin;
    }

    public function setFechafin(\DateTimeInterface $fechafin): self
    {
        $this->fechafin = $fechafin;

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

    public function getCosteTotal($peliculas, $diasAlquiler): ?float
    {
        $valorTotal = 0;

        foreach ($peliculas as $pelicula) {
            if ($pelicula->getTipo() == 'nuevo') {
                $valorTotal += $diasAlquiler * $pelicula->getPreciounitario();
            } elseif ($pelicula->getTipo() == 'normal') {
                if ($diasAlquiler > 3) {
                    $valorTotal += ($diasAlquiler - 3 * $pelicula->getPreciounitario() * 0.15) + $pelicula->getPreciounitario();
                } else {
                    $valorTotal += $pelicula->getPreciounitario();
                }
            } elseif ($pelicula->getTipo() == 'viejo') {
                if ($diasAlquiler > 5) {
                    $valorTotal += ($diasAlquiler - 5 * $pelicula->getPreciounitario() * 0.10) + $pelicula->getPreciounitario();
                }else{
                    $valorTotal += $pelicula->getPreciounitario();
                }
            }
        }
        return $valorTotal;
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

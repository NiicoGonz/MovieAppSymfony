<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Pelicula
 *
 * @ORM\Table(name="pelicula")
 * @ORM\Entity
 */
class Pelicula
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="sinopsis", type="string", length=255, nullable=false)
     */
    private $sinopsis;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_unitario", type="float", precision=200, scale=2, nullable=false)
     */
    private $precioUnitario;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=255, nullable=false)
     */
    private $genero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estreno", type="date", nullable=false)
     */
    private $fechaEstreno;

    /**
     * @ORM\ManyToMany(targetEntity=Alquiler::class, mappedBy="peliculas")
     */
    private $alquileres;

    public function __construct()
    {
        $this->alquileres = new ArrayCollection();
    }

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

    public function getSinopsis(): ?string
    {
        return $this->sinopsis;
    }

    public function setSinopsis(string $sinopsis): self
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    public function getPrecioUnitario(): ?float
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario(float $precioUnitario): self
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getFechaEstreno(): ?\DateTimeInterface
    {
        return $this->fechaEstreno;
    }

    public function setFechaEstreno(\DateTimeInterface $fechaEstreno): self
    {
        $this->fechaEstreno = $fechaEstreno;

        return $this;
    }

    /**
     * @return Collection|Alquiler[]
     */
    public function getAlquileres(): Collection
    {
        return $this->alquileres;
    }

    public function addAlquilere(Alquiler $alquilere): self
    {
        if (!$this->alquileres->contains($alquilere)) {
            $this->alquileres[] = $alquilere;
            $alquilere->addPelicula($this);
        }

        return $this;
    }

    public function removeAlquilere(Alquiler $alquilere): self
    {
        if ($this->alquileres->removeElement($alquilere)) {
            $alquilere->removePelicula($this);
        }

        return $this;
    }

    public function todasLasPeliculas(){
        $pelicula_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $pelicula_repo->findAll();

        return $peliculas;
    }

}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints\Collection;
use Doctrine\Common\Collections\Collection;

/**
 * Peliculas
 *
 * @ORM\Table(name="peliculas")
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sipnosis", type="text", length=65535, nullable=true)
     */
    private $sipnosis;

    /**
     * @var float|null
     *
     * @ORM\Column(name="precioUnitario", type="float", precision=100, scale=2, nullable=true)
     */
    private $preciounitario;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=100, nullable=false)
     */
    private $genero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEstreno", type="date", nullable=false)
     */
    private $fechaestreno;

    /**
     * @ORM\ManyToMany(targetEntity=Alquiler::class, mappedBy="peliculas")
     */
    private $alquilers;

    public function __construct()
    {
        $this->alquilers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self{
        $this->id = $id;
        return  $this;
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

    public function getSipnosis(): ?string
    {
        return $this->sipnosis;
    }

    public function setSipnosis(?string $sipnosis): self
    {
        $this->sipnosis = $sipnosis;

        return $this;
    }

    public function getPreciounitario(): ?float
    {
        return $this->preciounitario;
    }

    public function setPreciounitario(?float $preciounitario): self
    {
        $this->preciounitario = $preciounitario;

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

    public function getFechaestreno(): ?\DateTimeInterface
    {
        return $this->fechaestreno;
    }

    public function setFechaestreno(\DateTimeInterface $fechaestreno): self
    {
        $this->fechaestreno = $fechaestreno;

        return $this;
    }

    /**
     * @return Collection|Alquiler[]
     */
    public function getAlquilers(): Collection
    {
        return $this->alquilers;
    }

    public function addAlquiler(Alquiler $alquiler): self
    {
        if (!$this->alquilers->contains($alquiler)) {
            $this->alquilers[] = $alquiler;
            $alquiler->addPelicula($this);
        }

        return $this;
    }

    public function removeAlquiler(Alquiler $alquiler): self
    {
        if ($this->alquilers->removeElement($alquiler)) {
            $alquiler->removePelicula($this);
        }

        return $this;
    }


}

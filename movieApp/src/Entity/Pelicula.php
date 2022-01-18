<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="nombre", type="string", length=60, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="sinopsis", type="text", length=0, nullable=false)
     */
    private $sinopsis;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=false)
     */
    private $precio;

    /**
     * @var int
     *
     * @ORM\Column(name="tipoId", type="integer", nullable=false)
     */
    private $tipoid;

    /**
     * @var int
     *
     * @ORM\Column(name="generoId", type="integer", nullable=false)
     */
    private $generoid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEstreno", type="date", nullable=false)
     */
    private $fechaestreno;

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

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTipoid(): ?int
    {
        return $this->tipoid;
    }

    public function setTipoid(int $tipoid): self
    {
        $this->tipoid = $tipoid;

        return $this;
    }

    public function getGeneroid(): ?int
    {
        return $this->generoid;
    }

    public function setGeneroid(int $generoid): self
    {
        $this->generoid = $generoid;

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


}

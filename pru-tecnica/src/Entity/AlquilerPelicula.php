<?php

namespace App\Entity;

use App\Repository\AlquilerPeliculaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * AlquilerPelicula
 *
 * @ORM\Table(name="alquiler_pelicula", indexes={@ORM\Index(name="fk_alquiler_pelicula_alquiler", columns={"id_alquiler"}), @ORM\Index(name="fk_alquiler_pelicula_pelicula", columns={"id_pelicula"})})
 * @ORM\Entity
 */
class AlquilerPelicula
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
     * @var \Alquiler
     *
     * @ORM\ManyToOne(targetEntity="Alquiler")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alquiler", referencedColumnName="id")
     * })
     */
    private  $idAlquiler;

    /**
     * @var \Pelicula
     * @ORM\ManyToOne(targetEntity="Pelicula", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pelicula", referencedColumnName="id")
     * })
     */
    private $idPelicula;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAlquiler(): ?Alquiler
    {
        return $this->idAlquiler;
    }

    public function setIdAlquiler(?Alquiler $idAlquiler): self
    {
        $this->idAlquiler = $idAlquiler;

        return $this;
    }

    public function getIdPelicula(): ?Pelicula
    {
        return $this->idPelicula;
    }

    public function setIdPelicula(?Pelicula $idPelicula): self
    {
        $this->idPelicula = $idPelicula;

        return $this;
    }


}

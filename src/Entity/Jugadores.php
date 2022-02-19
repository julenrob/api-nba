<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugadores
 *
 * @ORM\Table(name="jugadores", indexes={@ORM\Index(name="Nombre_equipo", columns={"nombre_equipo"})})
 * @ORM\Entity(repositoryClass="App\Repository\JugadoresRepository")
 */
class Jugadores
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="procedencia", type="string", length=20, nullable=true)
     */
    private $procedencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="altura", type="string", length=4, nullable=true)
     */
    private $altura;

    /**
     * @var int|null
     *
     * @ORM\Column(name="peso", type="integer", nullable=true)
     */
    private $peso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="posicion", type="string", length=5, nullable=true)
     */
    private $posicion;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nombre_equipo", referencedColumnName="nombre")
     * })
     */
    private $nombreEquipo;

    /**
     * @return int
     */
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * @return string|null
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string|null
     */
    public function getProcedencia(): ?string
    {
        return $this->procedencia;
    }

    /**
     * @param string|null $procedencia
     */
    public function setProcedencia(?string $procedencia): void
    {
        $this->procedencia = $procedencia;
    }

    /**
     * @return string|null
     */
    public function getAltura(): ?string
    {
        return $this->altura;
    }

    /**
     * @param string|null $altura
     */
    public function setAltura(?string $altura): void
    {
        $this->altura = $altura;
    }

    /**
     * @return int|null
     */
    public function getPeso(): ?int
    {
        return $this->peso;
    }

    /**
     * @param int|null $peso
     */
    public function setPeso(?int $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return string|null
     */
    public function getPosicion(): ?string
    {
        return $this->posicion;
    }

    /**
     * @param string|null $posicion
     */
    public function setPosicion(?string $posicion): void
    {
        $this->posicion = $posicion;
    }

    /**
     * @return Equipos
     */
    public function getNombreEquipo(): Equipos
    {
        return $this->nombreEquipo;
    }

    /**
     * @param Equipos $nombreEquipo
     */
    public function setNombreEquipo(Equipos $nombreEquipo): void
    {
        $this->nombreEquipo = $nombreEquipo;
    }



}

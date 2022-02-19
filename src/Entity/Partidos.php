<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partidos
 *
 * @ORM\Table(name="partidos", indexes={@ORM\Index(name="equipo_local", columns={"equipo_local"}), @ORM\Index(name="equipo_visitante", columns={"equipo_visitante"})})
 * @ORM\Entity(repositoryClass="App\Repository\PartidosRepository")
 */
class Partidos
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
     * @var int|null
     *
     * @ORM\Column(name="puntos_local", type="integer", nullable=true)
     */
    private $puntosLocal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="puntos_visitante", type="integer", nullable=true)
     */
    private $puntosVisitante;

    /**
     * @var string|null
     *
     * @ORM\Column(name="temporada", type="string", length=5, nullable=true)
     */
    private $temporada;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_visitante", referencedColumnName="nombre")
     * })
     */
    private $equipoVisitante;

    /**
     * @var Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_local", referencedColumnName="nombre")
     * })
     */
    private $equipoLocal;

    /**
     * @return int
     */
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * @return int|null
     */
    public function getPuntosLocal(): ?int
    {
        return $this->puntosLocal;
    }

    /**
     * @param int|null $puntosLocal
     */
    public function setPuntosLocal(?int $puntosLocal): void
    {
        $this->puntosLocal = $puntosLocal;
    }

    /**
     * @return int|null
     */
    public function getPuntosVisitante(): ?int
    {
        return $this->puntosVisitante;
    }

    /**
     * @param int|null $puntosVisitante
     */
    public function setPuntosVisitante(?int $puntosVisitante): void
    {
        $this->puntosVisitante = $puntosVisitante;
    }

    /**
     * @return string|null
     */
    public function getTemporada(): ?string
    {
        return $this->temporada;
    }

    /**
     * @param string|null $temporada
     */
    public function setTemporada(?string $temporada): void
    {
        $this->temporada = $temporada;
    }

    /**
     * @return Equipos
     */
    public function getEquipoVisitante(): Equipos
    {
        return $this->equipoVisitante;
    }

    /**
     * @param Equipos $equipoVisitante
     */
    public function setEquipoVisitante(Equipos $equipoVisitante): void
    {
        $this->equipoVisitante = $equipoVisitante;
    }

    /**
     * @return Equipos
     */
    public function getEquipoLocal(): Equipos
    {
        return $this->equipoLocal;
    }

    /**
     * @param Equipos $equipoLocal
     */
    public function setEquipoLocal(Equipos $equipoLocal): void
    {
        $this->equipoLocal = $equipoLocal;
    }



}

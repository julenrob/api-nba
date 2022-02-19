<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadisticas
 *
 * @ORM\Table(name="estadisticas", indexes={@ORM\Index(name="jugador", columns={"jugador"})})
 * @ORM\Entity(repositoryClass="App\Repository\EstadisticasRepository")
 */
class Estadisticas
{
    /**
     * @var string
     *
     * @ORM\Column(name="temporada", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $temporada;

    /**
     * @var float|null
     *
     * @ORM\Column(name="puntos_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $puntosPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="asistencias_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $asistenciasPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="tapones_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $taponesPorPartido;

    /**
     * @var float|null
     *
     * @ORM\Column(name="rebotes_por_partido", type="float", precision=10, scale=0, nullable=true)
     */
    private $rebotesPorPartido;

    /**
     * @var Jugadores
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jugadores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jugador", referencedColumnName="codigo")
     * })
     */
    private $jugador;

    /**
     * @return string
     */
    public function getTemporada(): string
    {
        return $this->temporada;
    }

    /**
     * @return float|null
     */
    public function getPuntosPorPartido(): ?float
    {
        return $this->puntosPorPartido;
    }

    /**
     * @param float|null $puntosPorPartido
     */
    public function setPuntosPorPartido(?float $puntosPorPartido): void
    {
        $this->puntosPorPartido = $puntosPorPartido;
    }

    /**
     * @return float|null
     */
    public function getAsistenciasPorPartido(): ?float
    {
        return $this->asistenciasPorPartido;
    }

    /**
     * @param float|null $asistenciasPorPartido
     */
    public function setAsistenciasPorPartido(?float $asistenciasPorPartido): void
    {
        $this->asistenciasPorPartido = $asistenciasPorPartido;
    }

    /**
     * @return float|null
     */
    public function getTaponesPorPartido(): ?float
    {
        return $this->taponesPorPartido;
    }

    /**
     * @param float|null $taponesPorPartido
     */
    public function setTaponesPorPartido(?float $taponesPorPartido): void
    {
        $this->taponesPorPartido = $taponesPorPartido;
    }

    /**
     * @return float|null
     */
    public function getRebotesPorPartido(): ?float
    {
        return $this->rebotesPorPartido;
    }

    /**
     * @param float|null $rebotesPorPartido
     */
    public function setRebotesPorPartido(?float $rebotesPorPartido): void
    {
        $this->rebotesPorPartido = $rebotesPorPartido;
    }

    /**
     * @return Jugadores
     */
    public function getJugador(): Jugadores
    {
        return $this->jugador;
    }

    /**
     * @param Jugadores $jugador
     */
    public function setJugador(Jugadores $jugador): void
    {
        $this->jugador = $jugador;
    }




}

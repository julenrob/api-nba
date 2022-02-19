<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipos
 *
 * @ORM\Table(name="equipos")
 * @ORM\Entity(repositoryClass="App\Repository\EquiposRepository")
 */
class Equipos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nombre = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ciudad", type="string", length=20, nullable=true)
     */
    private $ciudad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conferencia", type="string", length=4, nullable=true)
     */
    private $conferencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="division", type="string", length=9, nullable=true)
     */
    private $division;

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return string|null
     */
    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    /**
     * @param string|null $ciudad
     */
    public function setCiudad(?string $ciudad): void
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return string|null
     */
    public function getConferencia(): ?string
    {
        return $this->conferencia;
    }

    /**
     * @param string|null $conferencia
     */
    public function setConferencia(?string $conferencia): void
    {
        $this->conferencia = $conferencia;
    }

    /**
     * @return string|null
     */
    public function getDivision(): ?string
    {
        return $this->division;
    }

    /**
     * @param string|null $division
     */
    public function setDivision(?string $division): void
    {
        $this->division = $division;
    }



}

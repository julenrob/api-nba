<?php

namespace App\Repository;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityRepository;

class EstadisticasRepository extends EntityRepository
{
    # H) WORKING
    public function showPlayerStatisticsByName(Jugadores $jugador){
        $dql = "SELECT e.puntosPorPartido, e.asistenciasPorPartido, e.taponesPorPartido, e.rebotesPorPartido
                FROM App:Estadisticas e
                WHERE e.jugador = :codJugador";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('codJugador', $jugador->getCodigo());

        return $query->getArrayResult();
    }

    # I) WORKING
    public function showAverageStatistics(Jugadores $jugador){
        $dql = "SELECT ROUND(avg(e.puntosPorPartido), 2) as Media_Puntos_por_partido,
                       ROUND(avg(e.asistenciasPorPartido), 2) as Media_Asistencias_por_partido,
                       ROUND(avg(e.taponesPorPartido), 2) as Media_Tapones_por_partido,
                       ROUND(avg(e.rebotesPorPartido), 2) as Media_Rebotes_por_partido
                FROM App:Estadisticas e
                WHERE e.jugador = :codJugador";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('codJugador', $jugador->getCodigo());

        return $query->getArrayResult();
    }

}
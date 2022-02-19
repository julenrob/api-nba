<?php

namespace App\Repository;
use App\Entity\Equipos;
use Doctrine\ORM\EntityRepository;


class PartidosRepository extends EntityRepository
{

    # L) WORKING
    public function showAvgPointsAsLocalByTeamName(Equipos $equipo){
        $dql = "SELECT ROUND(avg(p.puntosVisitante), 2) as Media_Puntos_Encajados_Como_Local
                FROM App:Partidos p
                WHERE p.equipoLocal = :nombreEquipo";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('nombreEquipo', $equipo->getNombre());

        return $query->getArrayResult();
    }

    # M) WORKING
    public function showAvgPointsAsVisitorByTeamName(Equipos $equipo){
        $dql = "SELECT ROUND(avg(p.puntosLocal), 2) as Media_Puntos_Encajados_Como_Visitante
                FROM App:Partidos p
                WHERE p.equipoVisitante = :nombreEquipo";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('nombreEquipo', $equipo->getNombre());

        return $query->getArrayResult();
    }

}
<?php

namespace App\Repository;
use App\Entity\Equipos;
use Doctrine\ORM\EntityRepository;

class EquiposRepository extends EntityRepository
{
    # A) WORKING
    public function showTeamsInfo(){
        $dql = "SELECT e FROM App:Equipos e";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    # B) WORKING
    public function showTeamsByName($nombre){
        $dql = "SELECT e FROM App:Equipos e WHERE e.nombre = :nombre";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('nombre', $nombre);

        return $query->getArrayResult();
    }

    # D) WORKING
    public function showPlayersByTeam(Equipos $equipo){
        $dql = "SELECT j FROM App:Jugadores j WHERE j.nombreEquipo = :equipo";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('equipo', $equipo);

        return $query->getArrayResult();
    }

}
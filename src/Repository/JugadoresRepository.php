<?php

namespace App\Repository;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityRepository;

class JugadoresRepository extends EntityRepository
{
    # E) WORKING
    public function showPlayersInfo(){
        $dql = "SELECT j FROM App:Jugadores j";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getArrayResult();
    }

    # F) WORKING
    public function showPlayersByName(Jugadores $jugador){
        $dql = "SELECT j.codigo, j.nombre, j.procedencia, j.altura, j.peso, j.posicion FROM App:Jugadores j WHERE j.nombre = :jugador";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('jugador', $jugador->getNombre());

        return $query->getArrayResult();
    }

}
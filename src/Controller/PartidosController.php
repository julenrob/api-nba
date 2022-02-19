<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Partidos;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartidosController extends AbstractController
{
    # J) WORKING
    public function localResultsByTeamName(Request $request){
        $teamName = $request->get('nombre');

        $teamsObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(['nombre'=>$teamName]);

        $teamMatchesObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findBy(['equipoLocal' => $teamName]);

        $teamWinsLocal = [];
        foreach ($teamMatchesObj as $match) {

            #if ($match->getPuntosLocal() > $match->getPuntosVisitante()){
            $teamWinsLocal[$teamsObj->getNombre()][]=$match->getEquipoLocal()->getNombre() .
                " " . $match->getPuntosLocal() .
                " " . $match->getEquipoVisitante()->getNombre() .
                " " . $match->getPuntosVisitante() .
                " " . "temporada " . $match->getTemporada();
            #}
        }

        return new JsonResponse($teamWinsLocal);

    }

    # K) WORKING
    public function visitorResultsByTeamName(Request $request){
        $teamName = $request->get('nombre');

        $teamsObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(['nombre'=>$teamName]);

        $teamMatchesObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->findBy(['equipoVisitante' => $teamName]);

        $teamWinsLocal = [];
        foreach ($teamMatchesObj as $match) {

            #if ($match->getPuntosLocal() > $match->getPuntosVisitante()){
            $teamWinsLocal[$teamsObj->getNombre()][]=$match->getEquipoLocal()->getNombre() .
                " " . $match->getPuntosLocal() .
                " " . $match->getEquipoVisitante()->getNombre() .
                " " . $match->getPuntosVisitante() .
                " " . "temporada " . $match->getTemporada();
            #}
        }

        return new JsonResponse($teamWinsLocal);
    }

    # L) WORKING
    public function avgReceivedPointsAsLocalByTeamName(Request $request){
        $teamName = $request->get('nombre');

        $teamsObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(['nombre'=>$teamName]);

        $partidosArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->showAvgPointsAsLocalByTeamName($teamsObj);

        return new JsonResponse($partidosArray);
    }

    # M) WORKING
    public function avgReceivedPointsAsVisitorByTeamName(Request $request){
        $teamName = $request->get('nombre');

        $teamsObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(['nombre'=>$teamName]);

        $partidosArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Partidos::class)
            ->showAvgPointsAsVisitorByTeamName($teamsObj);

        return new JsonResponse($partidosArray);
    }

}
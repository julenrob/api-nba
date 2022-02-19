<?php

namespace App\Controller;
use App\Entity\Estadisticas;
use App\Entity\Jugadores;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class EstadisticasController extends AbstractController
{
    # H) WORKING
    public function playerStatistics(Request $request){
        $playerName = $request->get('nombre');

        $playerObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findOneBy(['nombre'=>$playerName]);

        $estatisticasArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Estadisticas::class)
            ->showPlayerStatisticsByName($playerObj);

        $dataDict[$playerObj->getNombre()]=$estatisticasArray;

        return new JsonResponse($dataDict);
    }

    # I) WORKING
    public function playerStatisticsAvg(Request $request){
        $playerName = $request->get('nombre');

        $playerObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findOneBy(['nombre'=>$playerName]);

        $estadisticasArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Estadisticas::class)
            ->showAverageStatistics($playerObj);

        #$dataDict = [];
        $dataDict[$playerObj->getNombre()]=$estadisticasArray;

        return new JsonResponse($dataDict);
    }






}
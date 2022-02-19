<?php

namespace App\Controller;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JugadoresController extends AbstractController
{

    # E) WORKING
    public function playersInfo(){
        $playersArray = $this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->showPlayersInfo();
        return new JsonResponse($playersArray);
    }

    # F) WORKING
    public function playersInfoByName(Request $request){
        $player = $request->get('nombre');

        $playerObj= $this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findOneBy(['nombre'=>$player]);

        $teamArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->showPlayersByName($playerObj);

        return new JsonResponse($teamArray);
    }

    # G) WORKING
    public function playerHighWeight(Request $request){
        $playerName = $request->get('nombre');

        $playerObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findOneBy(['nombre'=>$playerName]);

        $alturaSeparado = explode('-', $playerObj->getAltura());
        $altura = (($alturaSeparado[0]*12+$alturaSeparado[1])*2.54);
        $peso = $playerObj->getPeso()*0.453592;

        $playerObj->setAltura($altura);
        $playerObj->setPeso($peso);

        $playerDict = [];
        $playerDict[$playerObj->getNombre()]["Altura"]=$playerObj->getAltura();
        $playerDict[$playerObj->getNombre()]["Peso"]=$playerObj->getPeso();
        $playerDict[$playerObj->getNombre()]["Posicion"]=$playerObj->getPosicion();

        return new JsonResponse($playerDict);
    }














}
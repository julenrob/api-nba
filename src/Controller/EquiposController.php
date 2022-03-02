<?php

namespace App\Controller;
use App\Entity\Equipos;
use App\Entity\Jugadores;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

class EquiposController extends AbstractController
{

    /**
     * @Route("/equipos", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     * )
     * @OA\Tag(name="equipos")
     * @Security(name="Bearer")
     */

    # A) WORKING
    public function teamsInfo(){
        $teamsArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->showTeamsInfo();
        return new JsonResponse($teamsArray);
    }

    /**
     * @Route("/equipos/{nombre}", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     * )
     * @OA\Tag(name="equipos")
     * @Security(name="Bearer")
     */

    # B) WORKING
    public function teamsInfoByName(Request $request){
        $name = $request->get('nombre');

        $nameArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->showTeamsByName($name);

        return new JsonResponse($nameArray);
    }

    # C) WORKING
    public function playersTeam(){

        $teamsArrayObj=$this->getDoctrine()
            ->getManager()
            ->getRepository(Jugadores::class)
            ->findAll();

        $teamsDict = [];
        foreach ($teamsArrayObj as $value){
            $teamsDict[$value->getNombreEquipo()->getNombre()][]=$value->getNombre();
        }

        return new JsonResponse($teamsDict);
    }

    # D) WORKING
    public function playersNameByTeam(Request $request){
        $team = $request->get('nombre');

        $equipoObj= $this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->findOneBy(['nombre'=>$team]);

        $teamArray=$this->getDoctrine()
            ->getManager()
            ->getRepository(Equipos::class)
            ->showPlayersByTeam($equipoObj);

        return new JsonResponse($teamArray);
    }

}
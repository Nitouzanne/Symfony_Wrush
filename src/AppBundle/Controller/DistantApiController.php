<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use RiotAPI\Definitions\Region;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DistantApiController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param $game
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function playerData($game, Request $request, EntityManagerInterface $em)
    {
        $pseudo = $request->get('pseudo');
        $region = $request->get('region', Region::EUROPE_WEST);

        if (null === $pseudo) {
            throw new NotFoundHttpException();
        }


        $summoner = $em->getExpressionBuilder();


        return new JsonResponse([
            "game" => $game,
            "level" => $summoner->getLevel(),
            "pseudo" => $summoner->getSummonerName(),
            "account_id" => $summoner->getAccountId(),
            "profil_icon_id" => $summoner->getProfilIconId(),
        ]);
    }
}

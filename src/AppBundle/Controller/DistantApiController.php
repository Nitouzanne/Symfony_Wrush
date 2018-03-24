<?php

namespace AppBundle\Controller;

use AppBundle\Mapper\ChampionMapper;
use AppBundle\Mapper\SummonerMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use RiotAPI\Definitions\Region;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DistantApiController
 * @author Nicolas Touzanne
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class DistantApiController extends Controller
{
    /**
     * @param Request $request
     * @param ChampionMapper $mapper
     * @return JsonResponse
     *
     * @Route("/champions", name="champions")
     */
    public function ChampionAction(Request $request, ChampionMapper $mapper)
    {
        $champion = $mapper->getChampionData();

        return new JsonResponse([
            "Id" => $champion->getId(),
            "Name" => $champion->getName(),
        ]);
    }

    /**
     * @param $game
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @Route("/summonerName", name="Summoner")
     */
    public function playerAction( Request $request, SummonerMapper $mapper)
    {
        $pseudo = $request->get('pseudo');
        $region = $request->get('region', Region::EUROPE_WEST);

        if (null === $pseudo) {
            throw new NotFoundHttpException();
        }

        $summoner = $mapper->getPlayerData($pseudo, $region);

        return new JsonResponse([
            "level" => $summoner->getLevel(),
            "pseudo" => $summoner->getSummonerName(),
            "account_id" => $summoner->getAccountId(),
            "profil_icon_id" => $summoner->getProfilIconId(),
            "TierSeason atteint" => $summoner->getHighestAchievedSeasonTier(),
            "League Points" => $summoner->getLeaguePoints(),

        ]);
    }

}

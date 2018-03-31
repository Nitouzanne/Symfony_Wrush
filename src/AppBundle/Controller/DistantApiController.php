<?php

namespace AppBundle\Controller;

use AppBundle\Mapper\ChampionMapper;
use AppBundle\Mapper\MatchSummonerMapper;
use AppBundle\Mapper\SummonerInMatchMapper;
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

        /**return new JsonResponse([
            "Id" => $champion->getId(),
            "Name" => $champion->getName()
        ]);*/
        return $this->json(array('Name' => $champion->getName()));
    }

    /**
     * @param $pseudo
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @Route("/summonerName/{pseudo}", name="Summoner")
     */
    public function playerAction( Request $request, SummonerMapper $mapper, MatchSummonerMapper $map, SummonerInMatchMapper $mappe, $pseudo)
    {
        $region = $request->get('region', Region::EUROPE_WEST);

        if (null === $pseudo) {
            throw new NotFoundHttpException();
        }

        $summoner = $mapper->getPlayerData($pseudo, $region);
        $accountId = $summoner->getAccountId();
        $matchSummoner = $map->getMatchData($accountId);
        $summonerInMatch = $mappe->getSummonerInMatchData($accountId);
        $daterevision = date("m-d-Y", $summoner->getRevisionDate()/1000);

        return new JsonResponse([
            "level" => $summoner->getLevel(),
            "pseudo" => $summoner->getSummonerName(),
            "account_id" => $summoner->getAccountId(),
            "profil_icon_id" => $summoner->getProfilIconId(),
            "Derniere mise a jour" => $daterevision,
            "TierSeason atteint" => $summoner->getHighestAchievedSeasonTier(),
            "League Points" => $summoner->getLeaguePoints(),
            "dernier Match" => $matchSummoner->getGameCreation(),
            "le type" => $matchSummoner->getGameType(),
            "joué avec " => $matchSummoner->getParticipantsIdentities(),
            "role " => $summonerInMatch->getRole(),
            " score " => $summonerInMatch->getWin(),
            " enemis tues" => $summonerInMatch->getKills(),
            " tués" => $summonerInMatch->getDeaths(),
            " a porte assistance" => $summonerInMatch->getAssists(),
        ]);
    }

}

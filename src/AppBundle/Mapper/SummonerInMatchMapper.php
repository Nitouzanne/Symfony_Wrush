<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\SummonerInMatch;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class SummonerInMatchMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class SummonerInMatchMapper
{
    /** @var RiotAPI  */
    private $api;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SummonerMapper constructor.
     * @param EntityManagerInterface $em
     * @param $api
     */
    public function __construct(EntityManagerInterface $em,RiotAPI $api)
    {
        $this->em = $em;
        $this->api = $api;
    }

    /**
     * @param int $accountId
     *
     * @param string $region
     * @return summonerInMatch
     */
    public function getSummonerInMatchData($accountId, $region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        $summonerInMatch = 0;
        $data = $this->api->getRecentMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        foreach ($matchLis as $key => $value){
            $matchId = $value->gameId;
            $partData = $this->api->getMatch($matchId);
            $partData2 = $partData->participants;
            foreach ($partData2 as $keys => $values){
                $stats = $values->stats;
                $summonerInMatch = new SummonerInMatch();
                $summonerInMatch->setRole($value->role);
                $summonerInMatch->setWin($stats->win);
                $summonerInMatch->setKills($stats->kills);
                $summonerInMatch->setDeaths($stats->deaths);
                $summonerInMatch->setAssists($stats->assists);
                $this->em->persist($summonerInMatch);
                $this->em->flush();
            }
        }
        return $summonerInMatch;
    }
}
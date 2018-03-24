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
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->api = new RiotAPI([
            RiotAPI::SET_KEY    => 'RGAPI-6a0d362b-8757-44f2-8082-9d90030dfbd2',
            RiotAPI::SET_REGION => Region::EUROPE_WEST,
            RiotAPI::SET_VERIFY_SSL => false,
        ]);
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
        $this->api->setRegion($region);

        $summonerInMatch = new SummonerInMatch();
        $data = $this->api->getMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        foreach ($matchLis as $key => $value){
            $matchId = $value->gameId;
            $summonerInMatch->setRole($value->role);
            $partData = $this->api->getMatch($matchId);
            $partData2 = $partData->participants;
            foreach ($partData2 as $keys => $values){
                $stats = $values->stats;
                $summonerInMatch->setWin($stats->win);
                $summonerInMatch->setKills($stats->kills);
                $summonerInMatch->setDeaths($stats->deaths);
                $summonerInMatch->setAssists($stats->assists);
            }
        }

        $this->em->persist($summonerInMatch);
        $this->em->flush();

        return $summonerInMatch;
    }
}
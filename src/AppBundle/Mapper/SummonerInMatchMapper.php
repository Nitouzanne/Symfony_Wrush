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
            RiotAPI::SET_KEY    => 'RGAPI-1c7fed3a-16c7-417b-ad25-e7fd06579fb5',
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
        $entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);

        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setRegion($region);

        $summonerInMatch = new SummonerInMatch();
        $data = $this->api->getMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        $c = 0;
        $s = 0;
        foreach ($matchLis as $key => $value){
            $matchId = $matchLis[$c]->gameId;
            $summonerInMatch->setRole($matchLis[$c]->role);
            $partData = $this->api->getMatch($matchId);
            $partData2 = $partData->participants;
            foreach ($partData2 as $keys => $values){
                $stats = $partData2[$s]->stats;
                $summonerInMatch->setWin($stats->win);
                $summonerInMatch->setKills($stats->kills);
                $summonerInMatch->setDeaths($stats->deaths);
                $summonerInMatch->setAssists($stats->assists);
            }
        }

        $entityManager->persist($summonerInMatch);
        $entityManager->flush();

        return $summonerInMatch;
    }
}
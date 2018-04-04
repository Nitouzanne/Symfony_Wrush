<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\MatchSummoner;
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
    public function getSummonerInMatchData(MatchSummoner $match, $region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        $service = $this->em->getRepository(SummonerInMatch::class);

        $sumInMatchs = [];

        foreach ($match as $key => $value){
            $partData = $this->api->getMatch($match->getId());
            $partData2 = $partData->participants;
            foreach ($partData2 as $keys => $values){
                $stats = $values->stats;
                $summonerInMatch = new SummonerInMatch();
                $summonerInMatch->setWin($stats->win);
                $summonerInMatch->setKills($stats->kills);
                $summonerInMatch->setDeaths($stats->deaths);
                $summonerInMatch->setAssists($stats->assists);
                $this->em->persist($summonerInMatch);

                $summonerInMatch->setMatchSummoner($match);
            }
        }


        $this->em->flush();
        return $summonerInMatch;
    }
}
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

        $data = $this->api->getMatchlistByAccount($accountId);
        $matchId = $data->matches[]->gameId;
        $partData = $this->api->getMatch($matchId);
        $partData2 = $partData->participants[]->stats;

        $summonerInMatch = new SummonerInMatch();

        $summonerInMatch->setWin($partData2->win);
        $summonerInMatch->setKills($partData2->kills);
        $summonerInMatch->setDeaths($partData2->deaths);
        $summonerInMatch->setAssists($partData2->assists);
        $summonerInMatch->setRole($data->matches[]->role);

        $entityManager->persist($summonerInMatch);
        $entityManager->flush();

        return $summonerInMatch;
    }
}
<?php

namespace AppBundle\Mapper;


use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;
use Symfony\Component\Form\Tests\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformerTest;

class SummonerMapper
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
     * @param string $name
     *
     * @param string $region
     * @return Summoner
     */
    public function getPlayerData($name,$region = null)
    {
        $entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);

        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setRegion($region);

        $data = $this->api->getSummonerByName($name);
        $accountId = $data->accountId;
        $dataMatchList = $this->api->getMatchlistByAccount($accountId);
        $matchId = $dataMatchList->matches[]->gameId;
        $summonerId = $data->id;
        $partData = $this->api->getMatch($matchId);
        $partData2 = $partData->participants[]->stats;
        $dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);
        $summoner = new Summoner();

        $summoner->setLevel($data->summonerLevel);
        $summoner->setSummonerName($data->name);
        $summoner->setAccountId($data->accountId);
        $summoner->setProfilIconId($data->profileIconId);
        $summoner->setRevisionDate($data->revisionDate);
        $summoner->setLeaguePoints($dataLeague[]->leaguePoints);
        $summoner->setHighestAchievedSeasonTier($partData->participants[]->highestAchievedSeasonTier);

        $entityManager->persist($summoner);
        $entityManager->flush();

        return $summoner;
    }
}
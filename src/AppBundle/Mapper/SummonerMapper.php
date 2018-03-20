<?php

namespace AppBundle\Mapper;


use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;
use Symfony\Component\Form\Tests\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformerTest;

/**
 * Class SummonerMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
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

        $summoner = new Summoner();
        $data = $this->api->getSummonerByName($name);
        $accountId = $data->accountId;
        $summonerId = $data->id;
        $dataMatchList = $this->api->getMatchlistByAccount($accountId);

        $matchLis = $dataMatchList->matches;
        $c = 0;
        $s = 0;
        foreach($matchLis as $key => $value){
            $matchId = $matchLis[$c]->gameId;
            $partData = $this->api->getMatch($matchId);
            $parData = $partData->participants;
            foreach ($parData as $keys => $values){
                $summoner->setHighestAchievedSeasonTier($parData[$s]->highestAchievedSeasonTier);
            }
        }
        $dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);
        $d = 0;
        foreach($dataLeague as $keyd => $valoue){
            $summoner->setLeaguePoints($dataLeague[d]->leaguePoints);
        }

        //$partData2 = $partData->participants[]->stats;
        $summoner->setLevel($data->summonerLevel);
        $summoner->setSummonerName($data->name);
        $summoner->setAccountId($data->accountId);
        $summoner->setProfilIconId($data->profileIconId);
        $summoner->setRevisionDate($data->revisionDate);

        $entityManager->persist($summoner);
        $entityManager->flush();

        return $summoner;
    }
}
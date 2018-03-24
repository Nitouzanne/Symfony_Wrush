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
            RiotAPI::SET_KEY    => 'RGAPI-6a0d362b-8757-44f2-8082-9d90030dfbd2',
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
        foreach($matchLis as $key => $value){
            $matchId = $value->gameId;
            $partData = $this->api->getMatch($matchId);
            $parData = $partData->participants;
            foreach ($parData as $keys => $values){
                $summoner->setHighestAchievedSeasonTier($values->highestAchievedSeasonTier);
            }
        }
        $dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);
        foreach($dataLeague as $keyd => $valoue){
            $summoner->setLeaguePoints($valoue->leaguePoints);
        }

        //$partData2 = $partData->participants[]->stats;
        $summoner->setLevel($data->summonerLevel);
        $summoner->setSummonerName($data->name);
        $summoner->setAccountId($data->accountId);
        $summoner->setProfilIconId($data->profileIconId);
        $summoner->setRevisionDate($data->revisionDate);

        $this->em->persist($summoner);
        $this->em->flush();

        return $summoner;
    }
}
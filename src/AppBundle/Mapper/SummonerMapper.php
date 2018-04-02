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
     * @param RiotAPI $api
     */
    public function __construct(EntityManagerInterface $em, RiotAPI $api)
    {
        $this->em = $em;
        $this->api = $api;
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
        $this->api->setTemporaryRegion($region);

        $summoner = 0;
        $data = $this->api->getSummonerByName($name);
        $accountId = $data->accountId;
        $summonerId = $data->id;
        $dataMatchList = $this->api->getMatchlistByAccount($accountId);
        $dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);

        $matchLis = $dataMatchList->matches;
        foreach($matchLis as $key => $value){
            $partData = $this->api->getMatch($value->gameId);
            $parData = $partData->participants;
            foreach ($parData as $keys => $values){
                foreach($dataLeague as $keyd => $valoue) {
                    $summoner = new Summoner();
                    $summoner->setLevel($data->summonerLevel);
                    $summoner->setSummonerName($data->name);
                    $summoner->setAccountId($data->accountId);
                    $summoner->setProfilIconId($data->profileIconId);
                    $summoner->setRevisionDate($data->revisionDate);
                    $summoner->setLeaguePoints($valoue->leaguePoints);
                    $summoner->setHighestAchievedSeasonTier($valoue->leagueName);

                    $this->em->persist($summoner);
                    $this->em->flush();
                }
            }
        }

        //$partData2 = $partData->participants[]->stats;
        return $summoner;
    }
}
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
            RiotAPI::SET_KEY    => 'RGAPI-3ebbaa6f-c791-4bb5-98cd-e279aa8e4957',
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
            $partData = $this->api->getMatch($value->gameId);
            $parData = $partData->participants;
            foreach ($parData as $keys => $values){
                $summoner = new Summoner();
                $summoner->setHighestAchievedSeasonTier($values->highestAchievedSeasonTier);
                $this->em->persist($summoner);
                $this->em->flush();
            }
        }
        $dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);
        foreach($dataLeague as $keyd => $valoue){
            $summoner = new Summoner();
            $summoner->setLeaguePoints($valoue->leaguePoints);
            $this->em->persist($summoner);
            $this->em->flush();
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
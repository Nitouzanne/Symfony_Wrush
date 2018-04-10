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


        $data = $this->api->getSummonerByName($name);
        $summonerId = $data->id;

        $service = $this->em->getRepository(Summoner::class);
        $summoner = $service->find($data->id);
        if ($summoner == null){
            $summoner = new Summoner();
            $summoner->setId($data->id);
            $summoner->setSummonerName($data->name);
            $summoner->setLevel($data->summonerLevel);
            $summoner->setAccountId($data->accountId);
            $summoner->setProfilIconId($data->profileIconId);
            $summoner->setRevisionDate(new \DateTime(date('d-m-Y H:i:s', $data->revisionDate/1000)));
        }

        //$summoner->setLeaguePoints($dataLeague->leaguePoints);
        //$summoner->setSeasonTier($dataLeague->tier);
        //$dataLeague = $this->api->getLeaguePositionsForSummoner($summonerId);

        $this->em->persist($summoner);
        $this->em->flush();
        //$partData2 = $partData->participants[]->stats;
        return $summoner;
    }
}
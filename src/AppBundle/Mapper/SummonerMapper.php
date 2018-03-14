<?php

namespace AppBundle\Mapper;

use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

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
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setRegion($region);

        $data = $this->api->getSummonerByName($name);

        $summoner = new Summoner();

        $summoner->setLevel($data->summonerLevel);
        $summoner->setSummonerName($data->name);
        $summoner->setAccountId($data->accountId);
        $summoner->setProfilIconId($data->profileIconId);

        return $summoner;
    }
}
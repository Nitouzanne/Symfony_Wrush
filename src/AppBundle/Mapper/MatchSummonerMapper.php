<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\MatchSummoner;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class MatchSummonerMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class MatchSummonerMapper
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
     * @param int $accountId
     *
     * @param string $region
     * @return matchSummoner
     */
    public function getMatchData($accountId, $region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setTemporaryRegion($region);

        $matchSummoner = 0;
        $data = $this->api->getRecentMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        foreach ($matchLis as $key => $value){
            $matchId = $value->gameId;
            $dataMatch = $this->api->getMatch($matchId);
            $matchSummoner = new MatchSummoner();
            $matchSummoner->setGameCreation($dataMatch->gameCreation);
            $matchSummoner->setParticipantsIdentities($dataMatch->participantIdentities);
            $matchSummoner->setGameType($dataMatch->gameType);
            $this->em->persist($matchSummoner);
            $this->em->flush();
        }

        return $matchSummoner;
    }
}
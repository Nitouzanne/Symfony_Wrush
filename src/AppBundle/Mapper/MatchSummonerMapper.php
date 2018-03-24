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
        $this->api->setRegion($region);

        $matchSummoner = new MatchSummoner();
        $data = $this->api->getMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        foreach ($matchLis as $key => $value){
            $matchId = $value->gameId;
            $dataMatch = $this->api->getMatch($matchId);
            $matchSummoner->setGameCreation($dataMatch->gameCreation);
            $matchSummoner->setParticipantsIdentities($dataMatch->participantIdentities);
            $matchSummoner->setGameType($dataMatch->gameType);
        }

        //$data->seasonId;
        //$data->participants;

        $this->em->persist($matchSummoner);
        $this->em->flush();

        return $matchSummoner;
    }
}
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
            RiotAPI::SET_KEY    => 'RGAPI-1c7fed3a-16c7-417b-ad25-e7fd06579fb5',
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
        $entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);

        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setRegion($region);

        $matchSummoner = new MatchSummoner();
        $data = $this->api->getMatchlistByAccount($accountId);
        $matchLis = $data->matches;

        $c = 0 ;
        foreach ($matchLis as $key => $value){
            $matchId = $matchLis[$c]->gameId;
            $dataMatch = $this->api->getMatch($matchId);
            $matchSummoner->setGameCreation($dataMatch->gameCreation);
            $matchSummoner->setParticipantsIdentities($dataMatch->participantIdentities);
            $matchSummoner->setGameType($dataMatch->gameType);
        }

        //$data->seasonId;
        //$data->participants;

        $entityManager->persist($matchSummoner);
        $entityManager->flush();

        return $matchSummoner;
    }
}
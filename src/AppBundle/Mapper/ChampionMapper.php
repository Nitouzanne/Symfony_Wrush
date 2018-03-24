<?php
namespace AppBundle\Mapper;

use AppBundle\Entity\Champion;
use Doctrine\ORM\EntityManagerInterface;
use RiotAPI\Definitions\Region;
use RiotAPI\RiotAPI;

/**
 * Class ChampionMapper
 * @author Nicolas Touzanne
 * @package AppBundle\Mapper
 */
class ChampionMapper
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
     * @param string $region
     * @return object Champion
     */
    public function getChampionData($region = null)
    {
        if (null === $region) {
            $region = Region::EUROPE_WEST;
        }
        $this->api->setRegion($region);

        $champion = 0;
        $data = $this->api->getStaticChampions();

            $champ = $data->data ;
            foreach ($champ as $keys => $val){
                $champion = new Champion();
                $champion->setName($val->name);
                $this->em->persist($champion);
                $this->em->flush();
            }
        return $champion;
    }
}
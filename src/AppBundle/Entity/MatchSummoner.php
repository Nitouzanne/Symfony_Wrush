<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * MatchSummoner
 *
 * @ORM\Table(name="match_summoner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchSummonerRepository")
 *
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
 *     )
 */
class MatchSummoner
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gameType", type="string", length=255)
     */
    private $gameType;

    /**
     * @var int
     *
     * @ORM\Column(name="gameCreation", type="bigint")
     */
    private $gameCreation;

    /**
     * @var array
     *
     * @ORM\Column(name="participantsIdentities", type="array")
     */
    private $participantsIdentities;

    /**
     * @ORM\OneToMany(targetEntity="SummonerInMatch", mappedBy="matchSummoner")
     */
    private $summonerInMatchs;

    public function _construct()
    {
        $this->summonerInMatchs = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gameType
     *
     * @param string $gameType
     *
     * @return MatchSummoner
     */
    public function setGameType($gameType)
    {
        $this->gameType = $gameType;

        return $this;
    }

    /**
     * Get gameType
     *
     * @return string
     */
    public function getGameType()
    {
        return $this->gameType;
    }

    /**
     * Set gameCreation
     *
     * @param integer $gameCreation
     *
     * @return MatchSummoner
     */
    public function setGameCreation($gameCreation)
    {
        $this->gameCreation = $gameCreation;

        return $this;
    }

    /**
     * Get gameCreation
     *
     * @return int
     */
    public function getGameCreation()
    {
        return $this->gameCreation;
    }

    /**
     * Set participantsIdentities
     *
     * @param array $participantsIdentities
     *
     * @return MatchSummoner
     */
    public function setParticipantsIdentities($participantsIdentities)
    {
        $this->participantsIdentities = $participantsIdentities;

        return $this;
    }

    /**
     * Get participantsIdentities
     *
     * @return array
     */
    public function getParticipantsIdentities()
    {
        return $this->participantsIdentities;
    }
}


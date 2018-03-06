<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SummonerInMatch
 *
 * @ORM\Table(name="summoner_in_match")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummonerInMatchRepository")
 */
class SummonerInMatch
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
     * @var int
     *
     * @ORM\Column(name="matchId", type="integer")
     */
    private $matchId;

    /**
     * @var integer
     *
     * @ORM\Column(name="championId", type="integer")
     */
    private $championId;

    /**
     * @var string
     *
     * @ORM\Column(name="lane", type="string", length=255)
     */
    private $lane;

    /**
     * @var integer
     *
     * @ORM\Column(name="participantId", type="integer")
     */
    private $participantId;

    /**
     * @ORM\OneToOne(targetEntity="matchSummoner",mappedBy="SummonerInMatch")
     */
    protected $matchSummoner;

    /**
     * @ORM\OneToOne(targetEntity="Champion", mappedBy="SummonerInMatch")
     */
    protected $champion;


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
     * Set matchId
     *
     * @param integer $matchId
     *
     * @return SummonerInMatch
     */
    public function setMatchId($matchId)
    {
        $this->matchId = $matchId;

        return $this;
    }

    /**
     * Get matchId
     *
     * @return int
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * Set championId
     *
     * @param integer $championId
     *
     * @return SummonerInMatch
     */
    public function setChampionId($championId)
    {
        $this->championId = $championId;

        return $this;
    }

    /**
     * Get championId
     *
     * @return integer
     */
    public function getChampionId()
    {
        return $this->championId;
    }

    /**
     * Set lane
     *
     * @param string $lane
     *
     * @return SummonerInMatch
     */
    public function setLane($lane)
    {
        $this->lane = $lane;

        return $this;
    }

    /**
     * Get lane
     *
     * @return string
     */
    public function getLane()
    {
        return $this->lane;
    }

    /**
     * Set participantId
     *
     * @param integer $participantId
     *
     * @return SummonerInMatch
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;

        return $this;
    }

    /**
     * Get participantId
     *
     * @return integer
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }
}


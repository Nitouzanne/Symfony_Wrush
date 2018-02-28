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
     * @var string
     *
     * @ORM\Column(name="champion", type="string", length=255)
     */
    private $champion;

    /**
     * @var string
     *
     * @ORM\Column(name="lane", type="string", length=255)
     */
    private $lane;

    /**
     * @var string
     *
     * @ORM\Column(name="participants", type="string", length=255)
     */
    private $participants;


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
     * Set champion
     *
     * @param string $champion
     *
     * @return SummonerInMatch
     */
    public function setChampion($champion)
    {
        $this->champion = $champion;

        return $this;
    }

    /**
     * Get champion
     *
     * @return string
     */
    public function getChampion()
    {
        return $this->champion;
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
     * Set participants
     *
     * @param string $participants
     *
     * @return SummonerInMatch
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;

        return $this;
    }

    /**
     * Get participants
     *
     * @return string
     */
    public function getParticipants()
    {
        return $this->participants;
    }
}


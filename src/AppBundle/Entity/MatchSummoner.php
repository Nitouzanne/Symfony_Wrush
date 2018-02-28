<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchSummoner
 *
 * @ORM\Table(name="match_summoner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchSummonerRepository")
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
     * @var int
     *
     * @ORM\Column(name="accountId", type="integer")
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudoInGame", type="string", length=255)
     */
    private $pseudoInGame;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="matchId", type="string", length=255)
     */
    private $matchId;

    /**
     * @var string
     *
     * @ORM\Column(name="participants", type="string", length=255)
     */
    private $participants;

    /**
     * @var bool
     *
     * @ORM\Column(name="win", type="boolean")
     */
    private $win;

    /**
     * @var int
     *
     * @ORM\Column(name="kills", type="integer")
     */
    private $kills;

    /**
     * @var int
     *
     * @ORM\Column(name="deaths", type="integer")
     */
    private $deaths;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer")
     */
    private $assists;


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
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return MatchSummoner
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set pseudoInGame
     *
     * @param string $pseudoInGame
     *
     * @return MatchSummoner
     */
    public function setPseudoInGame($pseudoInGame)
    {
        $this->pseudoInGame = $pseudoInGame;

        return $this;
    }

    /**
     * Get pseudoInGame
     *
     * @return string
     */
    public function getPseudoInGame()
    {
        return $this->pseudoInGame;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MatchSummoner
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set matchId
     *
     * @param string $matchId
     *
     * @return MatchSummoner
     */
    public function setMatchId($matchId)
    {
        $this->matchId = $matchId;

        return $this;
    }

    /**
     * Get matchId
     *
     * @return string
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * Set participants
     *
     * @param string $participants
     *
     * @return MatchSummoner
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

    /**
     * Set win
     *
     * @param boolean $win
     *
     * @return MatchSummoner
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return bool
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     *
     * @return MatchSummoner
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get kills
     *
     * @return int
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     *
     * @return MatchSummoner
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return int
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return MatchSummoner
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }
}


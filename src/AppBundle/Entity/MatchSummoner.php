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
     * @var integer
     *
     * @ORM\Column(name="matchId", type="integer")
     */
    private $matchId;

    /**
     * @var integer
     *
     * @ORM\Column(name="participantId", type="integer")
     */
    private $participantId;

    /**
     * @var string
     *
     * @ORM\Column(name="win", type="boolean", length=255)
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
     * @ORM\OneToOne(targetEntity="Summoner", inversedBy="matchSummoner")
     */
    protected $Summoner;

    /**
     * @ORM\OneToOne(targetEntity="SummonerInMatch", inversedBy="matchSummoner")
     */
    protected $SummonerInMatch;

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
     * @param integer $matchId
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
     * @return integer
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * Set participantId
     *
     * @param integer $participantId
     *
     * @return MatchSummoner
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

    /**
     * Set win
     *
     * @param string $win
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
     * @return string
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


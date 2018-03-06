<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Summoner
 *
 * @ORM\Table(name="summoner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummonerRepository")
 */
class Summoner
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
     * @ORM\Column(name="summonerName", type="string", length=255)
     */
    private $summonerName;

    /**
     * @var int
     *
     * @ORM\Column(name="AccountId", type="integer")
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="profilIconId", type="string", length=255)
     */
    private $profilIconId;

    /**
     * @var int
     *
     * @ORM\Column(name="Level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="leaguePoints", type="integer")
     */
    private $leaguePoints;

    /**
     * @ORM\OneToOne(targetEntity="accounts", mappedBy="Summoner")
     */
    protected $accounts;

    /**
     * @ORM\OneToOne(targetEntity="MatchSummoner", mappedBy="Summoner")
     */
    protected $matchSummoner;

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
     * Set summonerName
     *
     * @param string $pseudo
     *
     * @return Summoner
     */
    public function setSummonerName($summonerName)
    {
        $this->summonerName= $summonerName;

        return $this;
    }

    /**
     * Get summonerName
     *
     * @return string
     */
    public function getSummonerName()
    {
        return $this->summonerName;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return Summoner
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set profilIconId
     *
     * @param string $profilIconId
     *
     * @return Summoner
     */
    public function setProfilIconId($profilIconId)
    {
        $this->profilIconId = $profilIconId;

        return $this;
    }

    /**
     * Get profilIconId
     *
     * @return string
     */
    public function getProfilIconId()
    {
        return $this->profilIconId;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Summoner
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set leaguePoints
     *
     * @param integer $leaguePoints
     *
     * @return Summoner
     */
    public function setLeaguePoints($leaguePoints)
    {
        $this->leaguePoints = $leaguePoints;

        return $this;
    }

    /**
     * Get leaguePoints
     *
     * @return int
     */
    public function getLeaguePoints()
    {
        return $this->leaguePoints;
    }
}


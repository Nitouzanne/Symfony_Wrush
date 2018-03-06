<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Champion
 *
 * @ORM\Table(name="champion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChampionRepository")
 */
class Champion
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="championId", type="integer" )
     */
    private $championId;

    /**
     * @ORM\OneToOne(targetEntity="SummonerInMatch", inversedBy="champion")
     */
    protected $summonerInMatch;

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
 * Set name
 *
 * @param string $name
 *
 * @return Champion
 */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set championId
     *
     * @param integer $championId
     *
     * @return Champion
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
     * Set summonerInMatch
     *
     * @param \AppBundle\Entity\SummonerInMatch $summonerInMatch
     *
     * @return Champion
     */
    public function setSummonerInMatch(\AppBundle\Entity\SummonerInMatch $summonerInMatch = null)
    {
        $this->summonerInMatch = $summonerInMatch;

        return $this;
    }

    /**
     * Get summonerInMatch
     *
     * @return \AppBundle\Entity\SummonerInMatch
     */
    public function getSummonerInMatch()
    {
        return $this->summonerInMatch;
    }
}

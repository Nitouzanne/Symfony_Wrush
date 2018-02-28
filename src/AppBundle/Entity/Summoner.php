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
     * @ORM\Column(name="Pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="AccountId", type="string", length=255)
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Summoner
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set accountId
     *
     * @param string $accountId
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
     * @return string
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
}


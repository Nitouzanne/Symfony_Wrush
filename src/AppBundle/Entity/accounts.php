<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * accounts
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\accountsRepository")
 */
class accounts
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
     * @ORM\Column(name="User_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="game_id", type="integer")
     */
    private $gameId;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="accounts")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $User;

    /**
     * @ORM\OneToOne(targetEntity="Game", inversedBy="accounts")
     * @ORM\JoinColumn(name="gameId", referencedColumnName="id")
     */
    private $Game;

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return accounts
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     *
     * @return accounts
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return accounts
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
}


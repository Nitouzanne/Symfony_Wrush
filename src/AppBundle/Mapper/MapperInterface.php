<?php

namespace AppBundle\Mapper;

use AppBundle\Entity\Summoner;

interface MapperInterface
{
    /**
     * @param string $name
     * @param string $region
     * @return Summoner
     */
    function getPlayerData(string $name, string $region = null) : Summoner;
}
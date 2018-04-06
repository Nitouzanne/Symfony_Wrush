<?php
namespace AppBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\Summoner;
use AppBundle\Entity\SummonerInMatch;
use AppBundle\Entity\MatchSummoner;
use 

final class SummonerDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Summoner::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Summoner
    {
        // Retrieve the blog post item from somewhere then return it or null if not found
        return new Summoner($id);
    }
}
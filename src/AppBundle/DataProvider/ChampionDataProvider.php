<?php
namespace AppBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use AppBundle\Entity\Champion;
use AppBundle\Mapper\ChampionMapper;
use Symfony\Component\HttpFoundation\RequestStack;

final class ChampionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var $requestStack
     */
    private $requestStack;

    /**
     * @var ChampionMapper
     */
    private $mapper;

    public function __construct(RequestStack $requestStack, ChampionMapper $mapper)
    {
        $this->requestStack = $requestStack;
        $this->mapper = $mapper;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Champion::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        // Retrieve the blog post collection from somewhere

        $champion[] = $this->mapper->getChampionData();

        return $champion;
    }
}


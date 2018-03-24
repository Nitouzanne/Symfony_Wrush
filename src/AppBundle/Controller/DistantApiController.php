<?php

namespace AppBundle\Controller;

use AppBundle\Mapper\ChampionMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use RiotAPI\Definitions\Region;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DistantApiController
 * @author Nicolas Touzanne
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class DistantApiController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param Request $request
     * @param ChampionMapper $mapper
     * @return JsonResponse
     *
     * @Route("/champions", name="champions")
     */
    public function ChampionAction(Request $request, ChampionMapper $mapper)
    {
        $mapper->getChampionData();
        /*
        $pseudo = $request->get('pseudo');
        $region = $request->get('region', Region::EUROPE_WEST);

        if (null === $pseudo) {
            throw new NotFoundHttpException();
        }
        */
        return new JsonResponse([
            "Name" => $mapper,
        ]);

    }
}

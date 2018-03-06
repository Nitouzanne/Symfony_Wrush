<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RiotAPI\RiotAPI;
use RiotAPI\Definitions\Region;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//  Initialize the library
        $api = new RiotAPI([
            //  Your API key, you can get one at https://developer.riotgames.com/
            RiotAPI::SET_KEY    => 'RGAPI-1c7fed3a-16c7-417b-ad25-e7fd06579fb5',
            //  Target region (you can change it during lifetime of the library instance)
            RiotAPI::SET_REGION => Region::EUROPE_WEST,
        ]);

        $ch = $api->getStaticChampion(61);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'ch' => $ch,
        ]);
    }
}

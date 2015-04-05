<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 03/04/2015
 * Time: 13:07
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Api2Controller
 * @package AppBundle\Controller
 * @Route("/api")
 */

class Api2Controller extends Controller
{
    /**
     * @Route("/article/{id}", name="api_article", defaults={"id"=null}, requirements={"id"="\d+"})
     */
    public function seriesAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        /**@Var SeriesRepository $repo */
        $repo = $em->getRepository('AppBundle:Article');
        $article = $repo->findApi($id);
       // var_dump($article);



        return new JsonResponse($article);
    }
}
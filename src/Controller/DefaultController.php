<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home()
    {
        $series = ["a","b","c"];
        return $this->render("default/home.html.twig",[
            "series"=> $series
        ]);

    }
    /**
     * @Route("/test")
     */
    public function test()
    {
        return $this->render("default/test.html.twig");
    }
}

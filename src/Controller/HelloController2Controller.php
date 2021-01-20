<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController2Controller extends AbstractController
{
    /**
     * @Route("/hello/controller2/{name}", name="hello_controller2")
     */
    public function index(string $name): Response
    {

        $greet = '';

            $greet = '<h1>Hello ' . $name . ' </h1>';

        return new Response(        //new Response pour afficher du html pur
            '<html>
                <body>
                ' . $greet . '
                    <img style="text-align: center;" src="/images/under-construction-2.gif" />
                </body>
            </html>'
        );
        
    }
}

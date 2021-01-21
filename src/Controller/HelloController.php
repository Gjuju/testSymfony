<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="homepage")
     */
    public function index(Request $request): Response
    {
        $request->query->get('hello');

        $greet = '';

        if (! empty($request->query->get('hello'))) {
            $greet = '<h1>Hello ' . $request->query->get('hello') . ' </h1>
            <h1><a href="?">Retour au "pas d\'GET"</a></h1>';
        } else { 
            $greet = '<h1>Hello inconnu qui ne veut pas taper son GET hello</h1>
            <h1><a href="?hello=Julien">Juju est tu là ?</a></h1>';
        }

        return new Response(        //new Response pour afficher du html pur
            '<html>
                <body>
                ' . $greet . '
                    <img style="text-align: center;" src="images/under-construction-2.gif" />
                </body>
            </html>'
        );
    }
}

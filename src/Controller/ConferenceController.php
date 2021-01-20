<?php

namespace App\Controller;   // précise l'endroit abstrait ou l'on trouve le namespace 
                            // namespace ~= notion de "/repertoires de classes" ici : App\Controller

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;   // précise les classes utilisées dans le code qui suit
use Symfony\Component\HttpFoundation\Response;                      // ex : Son_NameSpace\La_Classe
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController               // Classe héritant de AbstractController
{
    /**
     * @Route("/conference", name="conference")
     */
    public function index(): Response                           // /!\ il faut passer par l'objet Response (réponse http)
    {      
        $number = random_int(0, 100);                               
        return new Response('Lucky number: '.$number.'');           // par défaut le maker retouorne une page twig (créée par le maker)
        /* return $this->render('conference/index.html.twig', [
            'controller_name' => 'ConferenceController',
        ]); */
    }
}

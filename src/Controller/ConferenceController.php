<?php

namespace App\Controller; // précise l'endroit abstrait ou l'on trouve le namespace
// namespace ~= notion de "/repertoires de classes" ici : App\Controller

use App\Entity\Conference;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // précise les classes utilisées dans le code qui suit
use Symfony\Component\HttpFoundation\Response; // ex : Son_NameSpace\La_Classe
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ConferenceRepository; // ajout pour utiliser ConferenceRepository

class ConferenceController extends AbstractController // Classe héritant de AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ConferenceRepository $repo): Response
    {
        return $this->render('conference/index.html.twig', [
            'conferences' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/conference/{id}", name="conference")
     */
    public function show(Conference $conference, CommentRepository $commentRepository): Response {
        return (
            $this->render('conference/show.html.twig', [
                'conference' => $conference,
                'comments' => $commentRepository->findBy(
                    ['conference' => $conference],
                    ['createdAt' => 'DESC']
                ),
            ])
        );
    }
}

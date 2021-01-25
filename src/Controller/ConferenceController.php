<?php

namespace App\Controller; // précise l'endroit abstrait ou l'on trouve le namespace
// namespace ~= notion de "/repertoires de classes" ici : App\Controller

use App\Entity\Conference;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\ConferenceRepository; // ajout pour utiliser ConferenceRepository

class ConferenceController extends AbstractController // Classe héritant de AbstractController
{
    /* public function index(ConferenceRepository $repo): Response
    {
        return $this->render('conference/index.html.twig', [
            'conferences' => $repo->findAll(),
            ]);
        } */

    /**
     * @Route("/", name="homepage")
     */
    public function index(ConferenceRepository $conferenceRepository, Request $request): Response
    {
        $years = $conferenceRepository->getListYear();
        $cities = $conferenceRepository->getListCity();

        $year_search = $request->query->get('year_search', '');
        $city_search = $request->query->get('city_search', '');;

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $conferenceRepository->getConferencePaginator($offset);
        return $this->render('conference/index.html.twig', [
            'year_search' => $year_search,
            'years' => $years,
            'city_search' => $city_search,
            'cities' => $cities,
            'conferences' => $paginator,
            'previous' => $offset - ConferenceRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ConferenceRepository::PAGINATOR_PER_PAGE),
        ]);
    }



    /**
     * @Route("/conference/{id}", name="conference")
     */
    public function show(Conference $conference, CommentRepository $commentRepository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);
        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}

<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Dto\SearchDto;
use App\Repository\ArticleRepository;
use App\Service\ArticleService;
use App\Service\ArticleServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    private const RECENT_ARTICLE_COUNT_ON_HOME = 5;
    #[Route('/', name: 'home')]
    public function index(ArticleServiceInterface $articleService, Request $request): Response
    {
        $searchDto = new SearchDto();
        $form = $this->createForm(\App\Form\AppSearchType::class, $searchDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $query = $articleService->getRecentArticles(self::RECENT_ARTICLE_COUNT_ON_HOME, $searchDto->getSearch());
        } else {
            $query = $articleService->getRecentArticles(self::RECENT_ARTICLE_COUNT_ON_HOME);
        }

        return $this->render('home/index.html.twig', [
            'articles' => $query->getResult(),
            'form' => $form
        ]);
    }
}
<?php
declare(strict_types=1);

namespace App\Controller;

class ArticleController extends Controller
{
  public function index(int $page = 1): void
  {
    $articles = $this->repository->findAll();

    $data = [
      'page' => $page,
      'articles' => $articles
    ];

    $this->render('article/index', $data);
  }
}

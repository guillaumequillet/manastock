<?php
declare(strict_types=1);

namespace App\Controller;

class CategoryController extends Controller
{
  public function index(int $page = 1): void
  {
    $categories = $this->repository->findAll();

    $data = [
      'page' => $page,
      'categories' => $categories
    ];

    $this->render('category/index', $data);
  }
}

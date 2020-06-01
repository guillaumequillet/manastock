<?php
declare(strict_types=1);

namespace App\Controller;

class OwnerController extends Controller
{
  public function index(int $page = 1): void
  {
    $owners = $this->repository->findAll();

    $data = [
      'page' => $page,
      'owners' => $owners
    ];

    $this->render('owner/index', $data);
  }
}

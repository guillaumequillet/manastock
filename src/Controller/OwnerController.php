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

  public function edit(int $id): void
  {
    $owner = $this->repository->find($id);

    if (is_null($owner)) {
      header('Location: index.php?controller=owner&action=index');
      exit();
    }

    $data = ['owner' => $owner];
    $this->render('owner/edit', $data);
  }
}

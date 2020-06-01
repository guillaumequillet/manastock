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

    // if the form was correctly filled, we persist the new values in Database
    if (isset($_POST['name']) && !empty($_POST['name'])) {
      $owner->setName(strip_tags($_POST['name']));
      $this->repository->persist($owner);
      $this->view->addLog(['message' => 'Le stockeur a bien été modifié', 'class' => 'alert-success']);
    }
    
    $data = ['owner' => $owner];
    $this->render('owner/edit', $data);
  }

  public function delete(int $id): void
  {
    $success = $this->repository->delete($id);
    if ($success) {
      $log = ['message' => 'Le stockeur a bien été supprimé', 'class' => 'alert-success'];
    } else {
      $log = ['message' => 'Le stockeur n\'a pu été supprimé', 'class' => 'alert-danger'];
    }
    $this->view->addLog($log);
    header('Location: index.php?controller=owner&action=index');
  }
}

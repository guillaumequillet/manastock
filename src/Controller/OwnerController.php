<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Owner;

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
      $this->view->addLog(['message' => 'Le stockeur demandé n\'existe pas', 'class' => 'alert-danger']);
      header('Location: index.php?controller=owner&action=index');
      exit();
    }

    // if the form was correctly filled, we persist the new values in Database
    if (isset($_POST['name']) && !empty($_POST['name'])) {
      $oldName = $owner->getName();
      $owner->setName(strip_tags($_POST['name']));
      $result = $this->repository->update($owner);
      if ($result) {
        $this->view->addLog(['message' => 'Le stockeur a bien été modifié', 'class' => 'alert-success']);
      } else {
        $owner->setName($oldName);
        $this->view->addLog(['message' => 'Le stockeur n\'a pas pu être modifié', 'class' => 'alert-danger']);
      }
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

  public function create(): void
  {
    // if the form was correctly filled, we persist the new values in Database
    if (isset($_POST['name']) && !empty($_POST['name'])) {
      $owner = new Owner();
      $owner->setName(strip_tags($_POST['name']));
      $result = $this->repository->create($owner);
      if ($result) {
        $this->view->addLog(['message' => 'Le stockeur a bien été créé', 'class' => 'alert-success']);
        header('Location: index.php?controller=owner&action=index');
        exit();
      } else {
        $this->view->addLog(['message' => 'Le stockeur n\'a pu été créé', 'class' => 'alert-danger']);
      }
    }
    $this->render('owner/create');
  }
}

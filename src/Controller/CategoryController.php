<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Category;

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

  public function edit(int $id): void
  {
    $category = $this->repository->find($id);

    if (is_null($category)) {
      $this->view->addLog(['message' => 'La catégorie demandée n\'existe pas', 'class' => 'alert-danger']);
      header('Location: index.php?controller=category&action=index');
      exit();
    }

    // if the form was correctly filled, we persist the new values in Database
    if (isset($_POST['name']) && !empty($_POST['name'])) {
      $oldName = $category->getName();
      $category->setName(strip_tags($_POST['name']));
      $category->setDescription(strip_tags($_POST['description']));
      $result = $this->repository->update($category);
      if ($result) {
        $this->view->addLog(['message' => 'La catégorie a bien été modifiée', 'class' => 'alert-success']);
      } else {
        $category->setName($oldName);
        $this->view->addLog(['message' => 'La catégorie n\'a pas pu être modifiée', 'class' => 'alert-danger']);
      }
    }
    
    $data = ['category' => $category];
    $this->render('category/edit', $data);
  }

  public function delete(int $id): void
  {
    $success = $this->repository->delete($id);
    if ($success) {
      $log = ['message' => 'La catégorie a bien été supprimée', 'class' => 'alert-success'];
    } else {
      $log = ['message' => 'La catégorie n\'a pu été supprimée', 'class' => 'alert-danger'];
    }
    $this->view->addLog($log);
    header('Location: index.php?controller=category&action=index');
  }

  public function create(): void
  {
    // if the form was correctly filled, we persist the new values in Database
    if (isset($_POST['name']) && !empty($_POST['name'])) {
      $category = new Category();
      $category->setName(strip_tags($_POST['name']));
      $category->setDescription(strip_tags($_POST['description']));
      $result = $this->repository->create($category);
      if ($result) {
        $this->view->addLog(['message' => 'La catégorie a bien été créée', 'class' => 'alert-success']);
        header('Location: index.php?controller=category&action=index');
        exit();
      } else {
        $this->view->addLog(['message' => 'La catégorie n\'a pu été créée', 'class' => 'alert-danger']);
      }
    }
    $this->render('category/create');
  }
}

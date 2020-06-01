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

  public function delete(int $id): void
  {
    $success = $this->repository->delete($id);
    if ($success) {
      $log = ['message' => 'L\'article a bien été supprimé', 'class' => 'alert-success'];
    } else {
      $log = ['message' => 'L\'article n\'a pu été supprimé', 'class' => 'alert-danger'];
    }
    $this->view->addLog($log);
    header('Location: index.php?controller=article&action=index');
  }
}

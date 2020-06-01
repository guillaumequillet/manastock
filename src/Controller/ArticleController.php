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

  public function edit(int $id): void
  {
    dump($_POST);
    $article = $this->repository->find($id);

    if (is_null($article)) {
      $this->view->addLog(['message' => 'L\'article demandé n\'existe pas', 'class' => 'alert-danger']);
      header('Location: index.php?controller=article&action=index');
      exit();
    }

    // if the form was correctly filled, we persist the new values in Database
    if (1===10 && isset($_POST['code']) && !empty($_POST['code'])
    && isset($_POST['owner']) && !empty($_POST['owner'])
    && isset($_POST['description']) 
    && isset($_POST['weight'])
    && isset($_POST['width'])
    && isset($_POST['height'])
    && isset($_POST['length'])
    && isset($_POST['barcode'])
    && isset($_POST['image'])
    && isset($_POST['categories'])) {
      $article->setCode(strip_tags($_POST['code']))
        ->setDescription(strip_tags($_POST['description']))
        ->setBatch(empty($_POST['batch']) ? false : true)
        ->setSerial(empty($_POST['serial']) ? false : true)
        ->setWeight(strip_tags($_POST['weight']))
        ->setWidth(strip_tags($_POST['width']))
        ->setHeight(strip_tags($_POST['height']))
        ->setLength(strip_tags($_POST['length']))
        ->setBarcode(strip_tags($_POST['barcode']))
        ->setImage(strip_tags($_POST['image']))
        ->setCategories(strip_tags($_POST['categories']))
        ->setOwner(strip_tags($_POST['owner']));
      $this->repository->update($article);
      $this->view->addLog(['message' => 'L\'article a bien été modifié', 'class' => 'alert-success']);
    }
    
    $data = ['article' => $article];
    $this->render('article/edit', $data);
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

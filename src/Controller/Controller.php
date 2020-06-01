<?php
declare(strict_types=1);

namespace App\Controller;
use App\View\View;
use App\Model\Repository\Repository;

class Controller
{
  protected $repository;
  protected $view;

  public function __construct() 
  {
    // we extract repository name from the Controller classname
    $classname = explode('\\', get_class($this));
    $entityName = explode('Controller', end($classname))[0];
    $repositoryName = '\\App\\Model\\Repository\\' . $entityName . 'Repository';
    if (class_exists($repositoryName)) {
      $this->repository = new $repositoryName();
    }
    $this->view = new View();
  }

  public function render(string $template, ?array $data = []): void
  {
    $this->view->render($template, $data);
  }
}

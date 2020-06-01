<?php
declare(strict_types=1);

namespace App\Controller;

class HomeController extends Controller
{
  public function index(int $page = 1): void
  {
    $this->render('home/index');
  }
}

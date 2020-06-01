<?php
declare(strict_types=1);

namespace App\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    private $twigLoader;
    private $twigEnvironment; 

    public function __construct()
    {
        $this->twigLoader = new FilesystemLoader('../templates');
        $this->twigEnvironment = new Environment($this->twigLoader, []); 
    }

    public function addLog(array $log): void
    {
        if (!isset($_SESSION['logs'])) {
            $_SESSION['logs'] = [];
        }

        $_SESSION['logs'][] = $log;
    }

    public function render(string $template, ?array $data = null): void 
    {
        if (is_null($data)) {
            $data = [];
        }

        if (isset($_SESSION['logs'])) {
            $data['logs'] = $_SESSION['logs'];
            unset($_SESSION['logs']);
        }

        echo $this->twigEnvironment->render($template . '.html.twig', $data);
    }
}

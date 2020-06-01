<?php
declare(strict_types=1);
require_once "../vendor/autoload.php";

// temp & awful router
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Article';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = '\\App\\Controller\\' . ucfirst($controller) . 'Controller';
(new $controller())->$action();
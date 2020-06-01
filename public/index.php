<?php
declare(strict_types=1);
session_start();

require_once "../vendor/autoload.php";

// temp & awful router
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Article';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$controller = '\\App\\Controller\\' . ucfirst($controller) . 'Controller';
if (is_null($id)) {
  (new $controller())->$action();
} else  {
  (new $controller())->$action($id);
}
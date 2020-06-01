<?php
declare(strict_types=1);

namespace App\Tool;
use PDO;
use PDOException;

class Database extends PDO
{
  private static $instance;
  private $host = 'localhost';
  private $name = 'manastock';
  private $username = 'root';
  private $password = '';

  private function __construct()  
  {
    try {
      parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->name . ';charset=utf8', $this->username, $this->password);
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public static function getInstance(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}

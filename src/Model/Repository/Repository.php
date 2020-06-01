<?php
declare(strict_types=1);

namespace App\Model\Repository;
use App\Tool\Database;
use App\Model\Entity\Entity;

class Repository
{
  protected $entityName;
  protected $tableName;

  public function __construct()
  {
    // we extract entity and table names from the Repository classname
    $classname = explode('\\', get_class($this));
    $entityName = explode('Repository', end($classname))[0];
    $this->entityName = "App\\Model\\Entity\\" . $entityName;
    $this->tableName = lcfirst($entityName);
  }

  public function findAll(): ?array
  {
    $req = Database::getInstance()->prepare('SELECT * FROM ' . $this->tableName);
    $req->execute([]);
    $res = $req->fetchAll();

    if ($res === false || empty($res)) {
      return null;
    }

    $entities = [];
    foreach ($res as $arrayRes) {
      $entity = new $this->entityName();
      $entity->hydrate($arrayRes);
      $entities[]= $entity;
    }
    return $entities;
  }

  public function find(int $id): ?Entity
  {
    $req = Database::getInstance()->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id=:id LIMIT 1');
    $req->execute(['id' => $id]);
    $res = $req->fetch();

    if ($res === false || empty($res)) {
      return null;
    }

    $entity = new $this->entityName();
    $entity->hydrate($res);
    return $entity;    
  }
}

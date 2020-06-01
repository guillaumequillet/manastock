<?php
declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Category;

class CategoryRepository extends Repository
{
  public function create(Category $category): bool
  {
    $req = $this->database->getInstance()->prepare('INSERT INTO `category` (name, description) VALUES(:name, :description)');
    $req->execute([
      'name' => $category->getName(),
      'description' => $category->getDescription()
    ]);
    return $req->rowCount() > 0;
  }

  public function update(Category $category): bool
  {
    $req = $this->database->getInstance()->prepare('UPDATE `category` SET name=:name, description=:description WHERE id=:id');
    $req->execute([
      'name' => $category->getName(), 
      'description' => $category->getDescription(),
      'id' => $category->getId()
    ]);
    return $req->rowCount() > 0;
  }
}

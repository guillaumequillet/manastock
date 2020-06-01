<?php
declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Article;

class ArticleRepository extends Repository
{
  public function create(Article $article): bool
  {
    $req = $this->database->getInstance()->prepare('
      INSERT INTO `article` (code, description, batch, serial, weight, width, height, length, barcode, image, categories, owner) 
      VALUES (:code, :description, :batch, :serial, :weight, :width, :height, :length, :barcode, :image, :categories, :owner)' 
    );
    $req->execute([
      'id' => $article->getId(),
      'code' => $article->getCode(),
      'description' => $article->getDescription(),
      'batch' => $article->getBatch(),
      'serial' => $article->getSerial(),
      'weight' => $article->getWeight(),
      'width' => $article->getWidth(),
      'height' => $article->getHeight(),
      'length' => $article->getLength(),
      'barcode' => $article->getBarcode(),
      'image' => $article->getImage(),
      'categories' => $article->getCategories(),
      'owner' => $article->getOwner()
    ]); 
    return $req->rowCount() > 0;
  }

  public function update(Article $article): bool
  {
    $req = $this->database->getInstance()->prepare('
      UPDATE `article` 
      SET code=:code, description=:description, batch=:batch, serial=:serial, weight=:weight, width=:width, height=:height, 
      length=:length, barcode=:barcode, image=:image, categories=:categories, owner=:owner 
      WHERE id=:id'
    );
    $req->execute([
      'id' => $article->getId(),
      'code' => $article->getCode(),
      'description' => $article->getDescription(),
      'batch' => $article->getBatch(),
      'serial' => $article->getSerial(),
      'weight' => $article->getWeight(),
      'width' => $article->getWidth(),
      'height' => $article->getHeight(),
      'length' => $article->getLength(),
      'barcode' => $article->getBarcode(),
      'image' => $article->getImage(),
      'categories' => $article->getCategories(),
      'owner' => $article->getOwner()
    ]); 
    return $req->rowCount() > 0;
  }
}

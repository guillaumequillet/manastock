<?php
declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Owner;

class OwnerRepository extends Repository
{
  public function create(Owner $owner): bool
  {
    $req = $this->database->getInstance()->prepare('INSERT INTO `owner` (name) VALUES(:name)');
    $req->execute(['name' => $owner->getName()]);
    return $req->rowCount() > 0;
  }

  public function update(Owner $owner): bool
  {
    $req = $this->database->getInstance()->prepare('UPDATE `owner` SET name=:name WHERE id=:id');
    $req->execute(['name' => $owner->getName(), 'id' => $owner->getId()]);
    return $req->rowCount() > 0;
  }
}

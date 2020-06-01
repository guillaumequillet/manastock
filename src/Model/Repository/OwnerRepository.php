<?php
declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Owner;

class OwnerRepository extends Repository
{
  public function persist(Owner $owner): void
  {
    $req = $this->database->prepare('UPDATE `owner` SET name=:name WHERE id=:id');
    $req->execute(['name' => $owner->getName(), 'id' => $owner->getId()]);
  }
}

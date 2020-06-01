<?php
declare(strict_types=1);

namespace App\Model\Entity;

class Entity
{
  public function hydrate(array $data): self
  {
    foreach ($data as $field => $value) {
      $method = 'set' . ucfirst($field);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
    return $this;
  }
}

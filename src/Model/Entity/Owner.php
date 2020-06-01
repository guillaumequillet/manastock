<?php
declare(strict_types=1);

namespace App\Model\Entity;

class Owner extends Entity
{
  // standard variables
  private $id;
  private $name;

  // getters
  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  // setters
  public function setId(int $id): self
  {
    $this->id = $id;
    return $this;
  }

  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }
}

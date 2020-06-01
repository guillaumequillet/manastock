<?php
declare(strict_types=1);

namespace App\Model\Entity;

class Category extends Entity
{
  // standard variables
  private $id;
  private $name;
  private $description;

  // getters
  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getDescription(): string
  {
    return $this->description;
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

  public function setDescription(string $description): self
  {
    $this->description = $description;
    return $this;
  }
}

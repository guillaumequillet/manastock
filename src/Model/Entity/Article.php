<?php
declare(strict_types=1);

namespace App\Model\Entity;

class Article extends Entity
{
  // standard variables
  private $id;
  private $code;
  private $description;
  private $batch;
  private $serial;
  private $weight;
  private $width;
  private $height;
  private $length;
  private $barcode;

  // entities variables
  private $categories;
  private $owner;

  // getters
  public function getId(): int
  {
    return $this->id;
  }

  public function getCode(): string
  {
    return $this->code;
  }

  public function getDescription(): string
  {
    return $this->description;
  }

  public function getBatch(): bool
  {
    return $this->batch;
  }

  public function getSerial(): bool
  {
    return $this->serial;
  }

  public function getWeight(): int
  {
    return $this->weight;
  }

  public function getWidth(): int
  {
    return $this->width;
  }

  public function getHeight(): int
  {
    return $this->height;
  }

  public function getLength(): int
  {
    return $this->length;
  }

  public function getBarcode(): string
  {
    return $this->barcode;
  }

  public function getCategories(): array
  {
    return $this->categories;
  }

  public function getOwner(): Owner
  {
    return $this->owner;
  }

    // setters
    public function setId(int $id): self
    {
      $this->id = $id;
      return $this;
    }
  
    public function setCode(string $code): self
    {
      $this->code = $code;
      return $this;
    }
  
    public function setDescription(string $description): self
    {
      $this->description = $description;
      return $this;
    }
  
    public function setBatch($batch): self
    {
      $this->batch = (bool)$batch;
      return $this;
    }
  
    public function setSerial($serial): self
    {
      $this->serial = (bool)$serial;
      return $this;
    }
  
    public function setWeight(int $weight): self
    {
      $this->weight = $weight;
      return $this;
    }
  
    public function setWidth(int $width): self
    {
      $this->width = $width;
      return $this;
    }
  
    public function setHeight(int $height): self
    {
      $this->height = $height;
      return $this;
    }
  
    public function setLength(int $length): self
    {
      $this->length = $length;
      return $this;
    }
  
    public function setBarcode(string $barcode): self
    {
      $this->barcode = $barcode;
      return $this;
    }
  
    public function setCategories($categories): self
    {
      // we want to decode the JSON string
      if (is_string($categories)) {
        $categories = json_decode($categories);
      }

      // if the categories are not hydrated as objects
      $categories = array_map(function ($element) { 
        return is_int($element) ? (new \App\Model\Repository\CategoryRepository())->find($element) : $element;
      }, $categories);

      $this->categories = $categories;
      return $this;
    }
  
    public function setOwner($owner): self
    {
      // if the owner is not hydrated as an object
      if (is_int($owner)) {
        $this->owner = (new \App\Model\Repository\OwnerRepository())->find($owner);
      } else {
        $this->owner = $owner;    
      } 
      return $this;
    }
}

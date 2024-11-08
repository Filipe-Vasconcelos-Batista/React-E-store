<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\MappedSuperclass;


#[MappedSuperclass]
abstract class BaseEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    protected int $id;

    #[Column(type: 'string')]
    protected string $name;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
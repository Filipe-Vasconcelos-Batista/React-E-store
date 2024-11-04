<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\MappedSuperclass]
class BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(type: 'string')]
    protected string $name;
}
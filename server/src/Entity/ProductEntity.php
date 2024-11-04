<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table(name: 'products')]
class ProductEntity extends BaseEntity
{
#[ORM\ManyToOne(targetEntity: CategoryEntity::class, inversedBy: 'products')]
#[ORM\JoinColumn(name:'category_id', referencedColumnName:'id')]
private CategoryEntity $category;

#[ORM\Column(type:'text')]
private string $description;

#[ORM\Column(type:'boolean')]
private bool $inStock;

#[ORM\ManyToOne(targetEntity: BrandEntity::class, inversedBy: 'products')]
#[ORM\JoinColumn(name:'brand_id', referencedColumnName:'id')]
private BrandEntity $brand;


}
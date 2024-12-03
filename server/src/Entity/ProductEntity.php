<?php

namespace App\Entity;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;
#[Entity]
#[Table(name: 'products')]
class ProductEntity extends BaseEntity
{
    #[ManyToOne(targetEntity: CategoryEntity::class, inversedBy: 'products')]
    #[JoinColumn(name:'category_id', referencedColumnName:'id')]
    private CategoryEntity $category;

    #[Column(type:'text')]
    private string $description;

    #[Column(type:'boolean')]
    private bool $inStock;

    #[Column(type: 'decimal', precision: 10, scale: 2)]
    private float $price;

    #[ManyToOne(targetEntity: BrandEntity::class, inversedBy: 'products')]
    #[JoinColumn(name:'brand_id', referencedColumnName:'id')]
    private BrandEntity $brand;

    /**
     * @return CategoryEntity
     */
    public function getCategory(): CategoryEntity
    {
        return $this->category;
    }

    /**
     * @param CategoryEntity $category
     */
    public function setCategory(CategoryEntity $category): void
    {
        $this->category = $category;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param bool $inStock
     */
    public function setInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }

    public function getInStock(): bool
    {
        return $this->inStock;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param BrandEntity $brand
     */
    public function setBrand(BrandEntity $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return BrandEntity
     */
    public function getBrand(): BrandEntity
    {
        return $this->brand;
    }



}
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

    #[ORM\Column(type: 'decimal', precision:10, scale: 2)]
    private float $price;

    #[ORM\ManyToOne(targetEntity: BrandEntity::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name:'brand_id', referencedColumnName:'id')]
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
     * @param bool $price
     */
    public function setPrice(bool $price): void
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
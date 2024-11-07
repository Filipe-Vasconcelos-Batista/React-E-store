<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table(name: 'attribute_items')]
class AttributeItemsEntity extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: ProductAttributesEntity::class)]
    #[ORM\JoinColumn(name: 'attribute_id', referencedColumnName: 'id')]
    private ProductAttributesEntity $attribute;
    #[ORM\Column(type: 'string')]
    private string $displayValue;
    #[ORM\Column(type: 'string')]
    private string $value;

    /**
     * @param ProductAttributesEntity $attribute
     */
    public function setAttribute(ProductAttributesEntity $attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return ProductAttributesEntity
     */
    public function getAttribute(): ProductAttributesEntity
    {
        return $this->attribute;
    }

    /**
     * @param string $displayValue
     */
    public function setDisplayValue(string $displayValue): void
    {
        $this->displayValue = $displayValue;
    }

    /**
     * @return string
     */
    public function getDisplayValue(): string
    {
        return $this->displayValue;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }


}
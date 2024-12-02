<?php
namespace App\DataFixtures;

require __DIR__.'/../../vendor/autoload.php';
$entityManager= require __DIR__.'/../../config/entity_manager.php';

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ProductEntity;
use App\Entity\ProductAttributesEntity;
use App\Entity\AttributeItemsEntity;
use App\Entity\BrandEntity;
use App\Entity\CategoryEntity;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        echo "starting Fixtures ....\n";
        $json = file_get_contents(__DIR__ . '../../public/documents/products.json');
        $data = json_decode($json, true);
        if(!$data){
            echo "failed to decode JSON. \n";
            return;
        }

        $categories = [];
        foreach ($data['categories'] as $categoryData) {
            $category = new CategoryEntity();
            $category->setName($categoryData['name']);
            $manager->persist($category);
            $categories[$categoryData['name']] = $category;
        }
        echo "Categories loaded.\n";

        // Process products
        foreach ($data['products'] as $productData) {
            // Find or create brand
            $brand = $manager->getRepository(BrandEntity::class)->findOneBy(['name' => $productData['brand']]);
            if (!$brand) {
                $brand = new BrandEntity();
                $brand->setName($productData['brand']);
                $manager->persist($brand);
            }

            // Create product
            $product = new ProductEntity();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setInStock($productData['inStock']);
            $product->setPrice($productData['prices'][0]['amount']); // Set the price from the prices array
            $product->setCategory($categories[$productData['category']]);
            $product->setBrand($brand);
            $manager->persist($product);

            // Process attributes
            foreach ($productData['attributes'] as $attributeData) {
                $attribute = new ProductAttributesEntity();
                $attribute->setName($attributeData['name']);
                $attribute->setType($attributeData['type']);
                $attribute->setProduct($product);
                $manager->persist($attribute);

                foreach ($attributeData['items'] as $itemData) {
                    $attributeItem = new AttributeItemsEntity();
                    $attributeItem->setName($itemData['id']);
                    $attributeItem->setDisplayValue($itemData['displayValue']);
                    $attributeItem->setValue($itemData['value']);
                    $attributeItem->setAttribute($attribute);
                    $manager->persist($attributeItem);
                }
            }
        }
        $manager->flush();
    }
}

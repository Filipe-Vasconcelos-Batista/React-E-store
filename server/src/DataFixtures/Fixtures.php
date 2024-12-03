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
        // Clear data for each entity
        $manager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=0;');
        $manager->createQuery('DELETE FROM App\Entity\ProductEntity')->execute();
        $manager->createQuery('DELETE FROM App\Entity\ProductAttributesEntity')->execute();
        $manager->createQuery('DELETE FROM App\Entity\AttributeItemsEntity')->execute();
        $manager->createQuery('DELETE FROM App\Entity\BrandEntity')->execute();
        $manager->createQuery('DELETE FROM App\Entity\CategoryEntity')->execute();
        $manager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1;');
        echo "Database entities cleared successfully.\n";
        $json = file_get_contents( '../../public/documents/products.json');
        if ($json === false) {
            echo "Failed to read JSON file.\n"; return;
        }
        echo "JSON file read successfully.\n";
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
            $brandName = trim($productData['brand']);
            $brandRepository = $manager->getRepository(BrandEntity::class);
            $brand = $brandRepository->findOneBy(['name' => $brandName]);
            if ($brand) {
                echo "Found existing brand: " . $productData['brand'] . "\n";
            }
            else {
                $brand = new BrandEntity();
                $brand->setName($productData['brand']);
                $manager->persist($brand);
                $manager->flush();
            }

            // Create product
            $product = new ProductEntity();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setInStock($productData['inStock']);
            $price = (float)$productData['prices'][0]['amount'];
            $product->setPrice($price);
            $product->setCategory($categories[$productData['category']]);
            $product->setBrand($brand);
            $manager->persist($product);
            $manager->flush();

            // Process attributes
            foreach ($productData['attributes'] as $attributeData) {
                $attribute = new ProductAttributesEntity();
                $attribute->setName($attributeData['name']);
                $attribute->setType($attributeData['type']);
                $attribute->setProduct($product);
                $manager->persist($attribute);
                $manager->flush();

                foreach ($attributeData['items'] as $itemData) {
                    $attributeItem = new AttributeItemsEntity();
                    $attributeItem->setName($itemData['id']);
                    $attributeItem->setDisplayValue($itemData['displayValue']);
                    $attributeItem->setValue($itemData['value']);
                    $attributeItem->setAttribute($attribute);
                    $manager->persist($attributeItem);
                    $manager->flush();
                }
            }
        }
        $manager->flush();
        echo "Fixtures loaded successfully.\n";
    }
}
$fixtures = new Fixtures();
$fixtures->load($entityManager);

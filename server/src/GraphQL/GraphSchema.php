<?php

namespace App\GraphQL;

use App\Entity\BrandEntity;
use App\Entity\CategoryEntity;
use App\Entity\ProductAttributesEntity;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

class GraphSchema {
    public function getGraphQLSchema(): Schema
    {
        // Define the Category Type
        $categoryType = new ObjectType([
            'name' => 'Category',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'name' => Type::nonNull(Type::string()),
            ]
        ]);

        // Define the Brand Type
        $brandType = new ObjectType([
            'name' => 'Brand',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'name' => Type::nonNull(Type::string()),
            ]
        ]);

        $attributeItemsType = new ObjectType([
            'name' => 'AttributeItem',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'displayValue' => Type::nonNull(Type::string()),
                'value' => Type::nonNull(Type::string()),
                'attribute' => [
                    'type' => Type::nonNull(Type::string()),
                    'resolve' => function($item) {
                        return $item->getAttribute();
                    }
                ]
            ]
        ]);

        $productAttributesType = new ObjectType([
            'name' => 'ProductAttribute',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'type' => Type::nonNull(Type::string()),
                'product' => [
                    'type' => Type::nonNull(Type::string()),
                    'resolve' => function($item) {
                        return $item->getProduct();
                    }
                ]
            ]
        ]);

        $productType = new ObjectType([
            'name' => 'Product',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'description' => Type::nonNull(Type::string()),
                'inStock' => Type::nonNull(Type::boolean()),
                'price' => Type::nonNull(Type::float()),
                'category' => [
                    'type' => $categoryType,
                    'resolve' => function($product) {
                        return $product->getCategory();
                    }
                ],
                'brand' => [
                    'type' => $brandType,
                    'resolve' => function($product) {
                        return $product->getBrand();
                    }
                ],
                'attributes' => [
                    'type' => Type::listOf($productAttributesType),
                    'resolve' => function($product) {
                        return $product->getAttributes();
                    }
                ]
            ]
        ]);


        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'categories' => [
                    'type' => Type::listOf($categoryType),
                    'resolve' => function($rootValue, $args, $context) {
                        $entityManager = $context['entityManager'];
                        $connection = $entityManager->getConnection();

                        $stmt = $connection->prepare('SELECT * FROM categories');
                        $rawCategories = $stmt->executeQuery()->fetchAllAssociative();

                        return array_map(function($raw) {
                            return [
                                'id' => (int)$raw['id'],
                                'name' => $raw['name']
                            ];
                        }, $rawCategories);
                    }
                    ],
                'products' => [
                    'type' => Type::listOf($productType),
                    'resolve' => function($rootValue, $args, $context) {
                        $entityManager = $context['entityManager'];
                        $connection=$entityManager->getConnection();

                        $category=$args['category'] ?? null;

                        $query= 'SELECT * FROM products';

                        if($category && $category !=='all'){
                            $query . ' WHERE category = :category';
                            $params['category'] = $category;
                        }

                        $stmt = $connection->prepare($query);
                        $rawProducts = $stmt->executeQuery()->fetchAllAssociative();
                        return array_map(function($raw) use($entityManager) {
                            $category= $entityManager->getRepository(CategoryEntity::class)->find($raw['name']);
                            $brand= $entityManager->getRepository(BrandEntity::class)->find($raw['name']);
                            $attributes= $entityManager->getRepository(ProductAttributesEntity::class)->findBy(['product'=> $raw['id']]);
                            return [
                                'id' => (int)$raw['id'],
                                'description' => $raw['description'],
                                'inStock' => (bool)$raw['inStock'],
                                'price' => (float)$raw['price'],
                                'category' => $category,
                                'brand' => $brand,
                                'attributes' => $attributes
                            ];
                        }, $rawProducts);
                    }
                ],
            ]
        ]);

        $mutationType = new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'sum' => [
                    'type' => Type::int(),
                    'args' => [
                        'x' => ['type' => Type::int()],
                        'y' => ['type' => Type::int()],
                    ],
                    'resolve' => static fn($calc, array $args): int => $args['x'] + $args['y'],
                ],
            ]
        ]);

        // Create and return the Schema
        return new Schema([
            'query' => $queryType,
            'mutation' => $mutationType
        ]);
    }
}

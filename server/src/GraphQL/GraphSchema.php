<?php

namespace App\GraphQL;

use App\Entity\CategoryEntity;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use RuntimeException;
use App\Entity\ProductEntity;

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
                        return $entityManager->getRepository(ProductEntity::class)->findAll();
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

<?php
require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/GraphQL/GraphSchema.php';
use GraphQL\GraphQL as GraphQLBase;
use App\GraphQL\GraphSchema;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load SchemaQL schema
$schemaQL = new GraphSchema();
$schema = $schemaQL->getGraphQLSchema();

// Handle the request
try { $rawInput = file_get_contents('php://input');
    if ($rawInput === false) {
        throw new RuntimeException('Failed to get php://input');
    }
    $input = json_decode($rawInput, true);
    $query = $input['query'] ?? null;
    $variableValues = $input['variables'] ?? null;
    $context = [
        'entityManager' => require __DIR__ . '/../../config/entity_manager.php',
        ];
    $result = GraphQLBase::executeQuery($schema, $query, null, $context, $variableValues);
    $output = $result->toArray();
} catch (Throwable $e) {
    $output = [ 'error' => [ 'message' => $e->getMessage(), ], ];
}

header('Content-Type: application/json; charset=UTF-8');

echo json_encode($output);
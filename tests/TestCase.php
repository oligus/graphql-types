<?php declare(strict_types=1);

namespace Test;

use Exception;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use GraphQLTypes\TypeConfigDecorator;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use GraphQL\Error\DebugFlag;

class TestCase extends PHPUnit_TestCase
{
    private ?Schema $schema = null;

    public function query(string $query, array $variables = [])
    {
        if (!$this->schema instanceof Schema) {
            $this->schema = BuildSchema::build(file_get_contents(TEST_PATH . '/schema.graphql'), TypeConfigDecorator::resolve());
        }

        try {
            $result = GraphQL::executeQuery($this->schema, $query, RootValue::resolve(), null, $variables);
            $output = $result->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);
        } catch (Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }

        return json_encode($output, JSON_PRETTY_PRINT);
    }
}

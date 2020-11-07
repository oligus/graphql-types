<?php declare(strict_types=1);

namespace Test\Types\e2e;

use Test\TestCase;
use Spatie\Snapshots\MatchesSnapshots;;

class UuidTypeTest extends TestCase
{
    use MatchesSnapshots;

    public function testQuery()
    {
        $result = $this->query('{ test { id } }', []);
        $this->assertMatchesSnapshot(json_encode($result));
    }
}
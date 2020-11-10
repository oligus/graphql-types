<?php declare(strict_types=1);

namespace Test\Types\e2e;

use Test\TestCase;
use Spatie\Snapshots\MatchesSnapshots;;

class UrlTypeTest extends TestCase
{
    use MatchesSnapshots;

    public function testQuery()
    {
        $result = $this->query('{ record { url } }', []);
        $this->assertMatchesSnapshot($result);
    }
}
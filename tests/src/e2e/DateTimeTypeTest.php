<?php declare(strict_types=1);

namespace Test\Types\e2e;

use Test\TestCase;
use Spatie\Snapshots\MatchesSnapshots;;

class DateTimeTypeTest extends TestCase
{
    use MatchesSnapshots;

    public function testQuery()
    {
        $result = $this->query('{ record { dateTime } }', []);
        $this->assertMatchesSnapshot($result);
    }
}

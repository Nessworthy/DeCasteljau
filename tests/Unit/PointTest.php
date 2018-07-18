<?php
namespace Nessworthy\DeCasteljau\Tests\Unit;

use Nessworthy\DeCasteljau\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{

    public function testX()
    {
        $point = new Point(100, 50);
        $this->assertEquals(100, $point->x());

        $point = new Point(-100.1, 50);
        $this->assertEquals(-100.1, $point->x());
    }

    public function testY()
    {
        $point = new Point(100, 50);
        $this->assertEquals(50, $point->y());

        $point = new Point(100, -25.5);
        $this->assertEquals(-25.5, $point->y());
    }
}

<?php
namespace Nessworthy\DeCasteljau\Tests\Feature;

use Nessworthy\DeCasteljau\CubicBezierCurve;
use Nessworthy\DeCasteljau\Point;
use PHPUnit\Framework\TestCase;

class CubicBezierCurveTest extends TestCase
{
    public function testCorrectCalculationsWhenCalculatingSegment()
    {
        $curve = new CubicBezierCurve(
            new Point(0, 0),
            new Point(75, 0),
            new Point(150, 75),
            new Point(150, 150)
        );

        $curveSegment = $curve->getSegment(0.5, 0.75);

        $point1 = $curveSegment->getControlPoint1();
        $point2 = $curveSegment->getControlPoint2();
        $point3 = $curveSegment->getControlPoint3();
        $point4 = $curveSegment->getControlPoint4();

        $this->assertEquals(103.125, $point1->x());
        $this->assertEquals(46.875, $point1->y());

        $this->assertEquals(117.1875, $point2->x());
        $this->assertEquals(60.9375, $point2->y());

        $this->assertEquals(128.90625, $point3->x());
        $this->assertEquals(77.34375, $point3->y());

        $this->assertEquals(137.109375, $point4->x());
        $this->assertEquals(94.921875, $point4->y());
    }
}

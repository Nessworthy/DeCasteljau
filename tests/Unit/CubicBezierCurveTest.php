<?php
namespace Nessworthy\DeCasteljau\Tests\Unit;

use Nessworthy\DeCasteljau\CubicBezierCurve;
use Nessworthy\DeCasteljau\Point;
use PHPUnit\Framework\TestCase;

class CubicBezierCurveTest extends TestCase
{
    public function testControlPointFetching()
    {
        /** @var Point $point1 */
        $point1 = $this->getMockBuilder(Point::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Point $point2 */
        $point2 = $this->getMockBuilder(Point::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Point $point3 */
        $point3 = $this->getMockBuilder(Point::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Point $point4 */
        $point4 = $this->getMockBuilder(Point::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bezierCurve = new CubicBezierCurve($point1, $point2, $point3, $point4);

        $this->assertEquals($point1, $bezierCurve->getControlPoint1());
        $this->assertEquals($point2, $bezierCurve->getControlPoint2());
        $this->assertEquals($point3, $bezierCurve->getControlPoint3());
        $this->assertEquals($point4, $bezierCurve->getControlPoint4());
    }
}

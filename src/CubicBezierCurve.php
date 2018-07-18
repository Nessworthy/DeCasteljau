<?php declare(strict_types=1);

namespace Nessworthy\DeCasteljau;

class CubicBezierCurve
{
    /**
     * @var Point
     */
    private $controlPoint1;

    /**
     * @var Point
     */
    private $controlPoint2;

    /**
     * @var Point
     */
    private $controlPoint3;

    /**
     * @var Point
     */
    private $controlPoint4;

    public function __construct(
        Point $controlPoint1,
        Point $controlPoint2,
        Point $controlPoint3,
        Point $controlPoint4
    ) {
        $this->controlPoint1 = $controlPoint1;
        $this->controlPoint2 = $controlPoint2;
        $this->controlPoint3 = $controlPoint3;
        $this->controlPoint4 = $controlPoint4;
    }

    /**
     * @return Point
     */
    public function getControlPoint1(): Point
    {
        return $this->controlPoint1;
    }

    /**
     * @return Point
     */
    public function getControlPoint2(): Point
    {
        return $this->controlPoint2;
    }

    /**
     * @return Point
     */
    public function getControlPoint3(): Point
    {
        return $this->controlPoint3;
    }

    /**
     * @return Point
     */
    public function getControlPoint4(): Point
    {
        return $this->controlPoint4;
    }

    public function getSegment(float $from, float $to): CubicBezierCurve
    {
        return new CubicBezierCurve(
            $this->calcSegmentControlPoint1($from),
            $this->calcSegmentControlPoint2($from, $to),
            $this->calcSegmentControlPoint3($from, $to),
            $this->calcSegmentControlPoint4($to)
        );
    }

    private function calcSegmentControlPoint1(
        float $from
    ): Point
    {
        $fn = function($from, $plane) {
            $t0 = $from;
            $u0 = 1 - $t0;
            return
                ($u0 * $u0 * $u0) * $this->getControlPoint1()->{$plane}()
                + ($t0 * $u0 * $u0 + $u0 * $t0 * $u0 + $u0 * $u0 * $t0) * $this->getControlPoint2()->{$plane}()
                + ($t0 * $t0 * $u0 + $u0 * $t0 * $t0 + $t0 * $u0 * $t0) * $this->getControlPoint3()->{$plane}()
                + ($t0 * $t0 * $t0) * $this->getControlPoint4()->{$plane}();
        };
        $x = $fn($from, 'x');
        $y = $fn($from, 'y');
        return new Point($x, $y);
    }

    private function calcSegmentControlPoint2(
        float $from,
        float $to
    ): Point
    {
        $fn = function($from, $to, $plane) {
            $t0 = $from;
            $t1 = $to;
            $u0 = 1 - $t0;
            $u1 = 1 - $to;
            return
                ($u0 * $u0 * $u1) * $this->getControlPoint1()->{$plane}()
                + ($t0 * $u0 * $u1 + $u0 * $t0 * $u1 + $u0 * $u0 * $t1) * $this->getControlPoint2()->{$plane}()
                + ($t0 * $t0 * $u1 + $u0 * $t0 * $t1 + $t0 * $u0 * $t1) * $this->getControlPoint3()->{$plane}()
                + ($t0 * $t0 * $t1) * $this->getControlPoint4()->{$plane}();
        };
        $x = $fn($from, $to, 'x');
        $y = $fn($from, $to, 'y');
        return new Point($x, $y);
    }

    private function calcSegmentControlPoint3(
        float $from,
        float $to
    ): Point
    {
        $fn = function($from, $to, $plane) {
            $t0 = $from;
            $t1 = $to;
            $u0 = 1 - $t0;
            $u1 = 1 - $to;
            return
                ($u0 * $u1 * $u1) * $this->getControlPoint1()->{$plane}()
                + ($t0 * $u1 * $u1 + $u0 * $t1 * $u1 + $u0 * $u1 * $t1) * $this->getControlPoint2()->{$plane}()
                + ($t0 * $t1 * $u1 + $u0 * $t1 * $t1 + $t0 * $u1 * $t1) * $this->getControlPoint3()->{$plane}()
                + ($t0 * $t1 * $t1) * $this->getControlPoint4()->{$plane}();
        };
        $x = $fn($from, $to, 'x');
        $y = $fn($from, $to, 'y');
        return new Point($x, $y);
    }

    private function calcSegmentControlPoint4(
        float $to
    ): Point
    {
        $fn = function($to, $plane) {
            $t1 = $to;
            $u1 = 1 - $to;
            return
                ($u1 * $u1 * $u1) * $this->getControlPoint1()->{$plane}()
                + ($t1 * $u1 * $u1 + $u1 * $t1 * $u1 + $u1 * $u1 * $t1) * $this->getControlPoint2()->{$plane}()
                + ($t1 * $t1 * $u1 + $u1 * $t1 * $t1 + $t1 * $u1 * $t1) * $this->getControlPoint3()->{$plane}()
                + ($t1 * $t1 * $t1) * $this->getControlPoint4()->{$plane}();
        };
        $x = $fn($to, 'x');
        $y = $fn($to, 'y');
        return new Point($x, $y);
    }
}

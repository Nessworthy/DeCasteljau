# Nessworthy / decasteljau

A stupid way of using [De Casteljau's algorithm](https://en.wikipedia.org/wiki/De_Casteljau's_algorithm) to calculate control points of a segment in a cubic bezier curve in PHP.

I used this a fair amount when trying to work out segments for SVG paths.

## Requirements

* PHP 7

## Installation

`composer require nessworthy/decasteljau`

## Usage

The algorithm requires 6 pieces of information - the original 4 control points of your bezier curve, where you want to cut your segment, and how long you want your segment to be.

Example:

```php
<?php

use Nessworthy\DeCasteljau\CubicBezierCurve;
use Nessworthy\DeCasteljau\Point;

$curve = new CubicBezierCurve(
    new Point(0, 0),    // Your start point.
    new Point(75, 0),   // The first curve point.
    new Point(150, 75), // The second curve point.
    new Point(150, 150) // Your finishing point.
);

// Calculate control points for the third quarter of the original curve.
$curveSegment = $curve->getSegment(0.5, 0.75); // Instance of CubicBezierCurve 

// Useful for calculating SVG bezier paths!
echo 'M' . $curveSegment->getControlPoint1()->x() . ' ' . $curveSegment->getControlPoint1()->y();
echo ' C' . $curveSegment->getControlPoint2()->x() . ' ' . $curveSegment->getControlPoint2()->y();
echo ', ' . $curveSegment->getControlPoint3()->x() . ' ' . $curveSegment->getControlPoint3()->y();
echo ', ' . $curveSegment->getControlPoint4()->x() . ' ' . $curveSegment->getControlPoint4()->y();

```

## License

[WTFPL](http://www.wtfpl.net) - See [LICENSE.md](LICENSE.md)
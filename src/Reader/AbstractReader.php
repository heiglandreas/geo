<?php
/**
 * Copyright (c) 2008-2011 Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category   Geolocation
 * @package    Org\Heigl\Geo
 * @subpackage Reader
 * @author     Andreas Heigl <andreas@heigl.org>
 * @copyright  2008-2011 Andreas Heigl<andreas@heigl.org>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */

namespace Org\Heigl\Geo\Reader;

use \Org\Heigl\Geo\InvalidArgumentException
  , \Org\Heigl\Geo\PointInterface
  , \Org\Heigl\Geo\AbstractShape
  , \Org\Heigl\Geo\Point
  , \Org\Heigl\Geo\Polygon
  , \Org\Heigl\Geo\Shape
  ;

/**
 * This describes an abstract Reader-class
 *
 * @category   Geo
 * @package    Org\Heigl\Geo
 * @subpackage Reader
 * @author     Andreas Heigl <a.heigl@wdv.de>
 * @copyright  2008-2011 Andreas Heigl
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      29.02.2012
 */
abstract class AbstractReader
{
    /**
     * Get an instance of the point-class
     *
     * @param float $x The X-Value for the new point
     * @param float $y The Y-value for the new point
     *
     * @return PointInterface
     */
    public function getNewPoint($x, $y)
    {
        $point = new Point();
        return $point->setX($x)->setY($y);
    }

    /**
     * Get an instance of the Polygon-class
     *
     * @return AbstractShape
     */
    public function getNewPolygon()
    {
        return new Polygon();
    }

    /**
     * Get an instance of the shape-class
     *
     * @return AbstractShape
     */
    public function getNewShape()
    {
        return new Shape();
    }

    /**
     * Render the given file
     *
     * @param string $file the location of a file to parse
     *
     * @return AbstractShape()
     */
    abstract public function parse($file);
}
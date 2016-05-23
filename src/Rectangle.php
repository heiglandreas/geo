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
 * @category  Geolocation
 * @package   Org\Heigl\Geo
 * @author    Andreas Heigl <andreas@heigl.org>
 * @copyright 2008-2011 Andreas Heigl<andreas@heigl.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @link      http://github.com/heiglandreas/geo
 * @since     24.02.2012
 */

namespace Org\Heigl\Geo;

/**
 * A Rectangle is defined by two points.
 *
 * It is a special implementation of a polygon
 *
 * The upper left point and the lower right point.
 *
 * @category  Geo
 * @package   Org\Heigl\Geo
 * @author    Andreas Heigl <a.heigl@wdv.de>
 * @copyright 2008-2011 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @link      http://github.com/heiglandreas/geo
 * @since     24.02.2012
 */
class Rectangle
{
    /**
     * Store the bottom left corner of the rectangle.
     *
     * @var Point $bottomRight
     */
    protected $bottomRight = null;

    /**
     * Store the tor right cornser of the rectangle.
     *
     * @var Point $topLeft
     */
    protected $topLeft = null;

    /**
     * Create an instance of the rectangle
     *
     * @return void
     */
    public function __construct()
    {
        $this->setTopLeft(new Point());
        $this->setBottomRight(new Point());
    }

    /**
     * Set the top left corner of the rectangle
     *
     * @param Point $point The Top-Left point
     *
     * @return Rectangle
     */
    public function setTopLeft(Point $point)
    {
        $this->topLeft = $point;
        $this->normalize();
        return $this;
    }

    /**
     * Set the bottom right corner of the rectangle
     *
     * @param Point $point The Bottom-Right corner
     *
     * @return Rectangle
     */
    public function setBottomRight(Point $point)
    {
        $this->bottomRight = $point;
        $this->normalize();
        return $this;
    }

    /**
     * Get the top left corner of the rectangle
     *
     * @return Point
     */
    public function getTopLeft()
    {
        return $this->topLeft;
    }

    /**
     * Get the bottom right corner of the rectangle
     *
     * @return Point
     */
    public function getBottomRight()
    {
        return $this->bottomRight;
    }

    /**
     * Get the left value
     *
     * @return float
     */
    public function getLeft()
    {
        return $this->getTopLeft()->getX();
    }

    /**
     * Get the right value
     *
     * @return float
     */
    public function getRight()
    {
        return $this->getBottomRight()->getX();
    }

    /**
     * Get the top value
     *
     * @return float
     */
    public function getTop()
    {
        return $this->getTopLeft()->getY();
    }

    /**
     * Get the bottom value
     *
     * @return float
     */
    public function getBottom()
    {
        return $this->getBottomRight()->getY();
    }

    /**
     * Get the width of the Rectangle
     *
     * @return float
     */
    public function getWidth()
    {
        $l = $this->getTopLeft()->getX();
        $r = $this->getBottomRight()->getX();

        return $r-$l;
    }

    /**
     * Get the height of the Rectangle
     *
     * @return float
     */
    public function getHeight()
    {
        $t = $this->getTopLeft()->getY();
        $b = $this->getBottomRight()->getY();

        return $t-$b;
    }

    /**
     * Normalize the points so that top left is actually top left.
     *
     * @return Rectangle
     */
    public function normalize()
    {
        return $this;
    }

    /**
     * Create a Rectangel
     *
     * @param mixed $top    The top offset
     * @param mixed $left   The left offset
     * @param mixed $bottom The bottom offset
     * @param mixed $right  The Right offset
     *
     * @return Rectangle
     */
    public static function factory($top, $left, $bottom, $right)
    {
        $r = new Rectangle();
        $r->setTopLeft(Point::factory($left, $top));
        $r->setBottomRight(Point::factory($right, $bottom));
        return $r;
    }
}
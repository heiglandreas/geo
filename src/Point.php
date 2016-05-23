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
 * This describes any point that can be references using latitude/longitude
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
class Point implements StackableInterface, PointInterface
{
    /**
     * Which class shall be used to render this Object.
     *
     * @var string rendererClass
     */
    public $rendererClass = 'Point';

    /**
     * Store the X-Value of the point.
     *
     * @var float $X
     */
    protected $x = null;

    /**
     * Store the Y-Value of the point.
     *
     * @var float $Y
     */
    protected $y = null;

    /**
     * Set the X-value of the point.
     *
     * @param float $x THe X-value to be set
     *
     * @return \Org\Heigl\Geo\Point
     */
    public function setX($x)
    {
        $this->x = (float) $x;
        return $this;
    }

    /**
     * Set the Y-value of the point
     *
     * @param float $y The Y-value to be set
     *
     * @return \Org\Heigl\Geo\Point
     */
    public function setY($y)
    {
        $this->y = (float) $y;
        return $this;
    }

    /**
     * Create a point-object from an X- and a Y-value.
     *
     * @param float $x THe X-value to be set
     * @param float $y The Y-value to be set
     *
     * @return \Org\Heigl\Geo\Point
     */
    public static function factory($x, $y)
    {
        $point = new Point();
        return $point->setX($x)->setY($y);
    }

    /**
     * Get the X-value of the point
     *
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Get the Y-value of the point
     *
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Get the top-value
     *
     * Implements StackableInterface::getTop()
     *
     * @return float
     */
    public function getTop()
    {
        return $this->y;
    }

    /**
     * Get the bottom-value
     *
     * Implements StackableInterface::getBottom()
     *
     * @return float
     */
    public function getBottom()
    {
        return $this->y;
    }

    /**
     * Get the Left-value
     *
     * Implements StackableInterface::getLeft()
     *
     * @return float
     */
    public function getLeft()
    {
        return $this->x;
    }

    /**
     * Get the Right-value
     *
     * Implements StackableInterface::getRight()
     *
     * @return float
     */
    public function getRight()
    {
        return $this->x;
    }
}
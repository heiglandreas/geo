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
 * This describes a polygon consisting of multiple points.
 *
 * A Polygon is a closed line that contains points inside the line and has
 * points outside its area.
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
class Polygon extends AbstractShape
{
    /**
     * Add a point to the point-list
     *
     * adding one point more than once is possible.
     *
     * @param Point $point The point to add
     *
     * @return Polygon
     */
    public function addPoint(Point $point)
    {
        return $this->addStackable($point);
    }

    /**
     * Get a point from the point-list by it's ID
     *
     * @param int $id The ID of the point
     *
     * @throws InvalidArgumentException
     * @return Point
     */
    public function getPoint($id)
    {
        return $this->getStackable($id);
    }

    /**
     * Check whether the given point exists or not.
     *
     * @param int|Point $point The point or it's key to search for
     *
     * @return boolean
     */
    public function hasPoint($point)
    {
        return $this->hasStackable($point);
    }

    /**
     * Remove a point from the list
     *
     * @param int|Point $point The point to be removed
     *
     * @throws InvalidArgumentException
     * @return Polygon
     */
    public function removePoint($point)
    {
        return $this->removeStackable($point);
    }
}
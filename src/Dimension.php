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
class Dimension
{
    private $width;

    private $height;

    public function __construct(float $width = 0.0, float $height = 0.0)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function setWidth(float $width) : self
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight(float $height) : self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth() : float
    {
        return $this->width;
    }

    public function getHeight() : float
    {
        return $this->height;
    }
}

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
 * @author     Andreas Heigl <andreas@heigl.org>
 * @copyright  2008-2011 Andreas Heigl<andreas@heigl.org>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */

namespace Org\Heigl\GeoTest;

use \Org\Heigl\Geo\Reader\AbstractReader
  , \Org\Heigl\Geo\Rectangle
  , \Org\Heigl\Geo\Point
  , \Org\Heigl\Geo\Shape
  , \Org\Heigl\Geo\PointInterface
  , \Org\Heigl\Geo\AbstractShape
;

/**
 * This describes Tests for the Point-Class
 *
 * @category   Geo
 * @package    Org\Heigl\Geo
 * @author     Andreas Heigl <a.heigl@wdv.de>
 * @copyright  2008-2011 Andreas Heigl
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */
class AbstractReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingPoint()
    {
        $p = new TestReader();
        $this->assertInstanceof('\Org\Heigl\Geo\Point', $p->getNewPoint('0','0') );
        $this->assertInstanceof('\Org\Heigl\Geo\PointInterface', $p->getNewPoint('0','0') );
    }

    public function testGettingPolygon()
    {
        // Setup
        $p = new TestReader();
        $this->assertInstanceof('\Org\Heigl\Geo\Polygon', $p->getNewPolygon());
        $this->assertInstanceof('\Org\Heigl\Geo\AbstractShape', $p->getNewPolygon());
    }

    public function testGettingShape()
    {
        // Setup
        $p = new TestReader();
        $this->assertInstanceof('\Org\Heigl\Geo\Shape', $p->getNewShape());
        $this->assertInstanceof('\Org\Heigl\Geo\AbstractShape', $p->getNewShape());
    }
}

class TestReader extends AbstractReader
{
    public function parse($file)
    {
        return $this->getNewShape();
    }
}

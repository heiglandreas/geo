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

use \Org\Heigl\Geo\Rectangle,
    \Org\Heigl\Geo\Point;

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
class RectangleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider settingProvider
     */
    public function testTLValues($set)
    {
        $p = new Rectangle();
        $this->assertAttributeEquals(new Point(),'topLeft',$p);
        $this->assertSame($p, $p->setTopLeft($set));
        $this->assertAttributeEquals($set,'topLeft',$p);
        $this->assertSame($set, $p->getTopLeft());
    }

    /**
     * @dataProvider settingProvider
     */
    public function testBRValues($set)
    {
        $p = new Rectangle();
        $this->assertAttributeEquals(new Point(), 'bottomRight',$p);
        $this->assertSame($p, $p->setBottomRight($set));
        $this->assertAttributeEquals($set, 'bottomRight',$p);
        $this->assertSame($set, $p->getBottomRight());
    }

    /**
     * @dataProvider settingProvider
     * Enter description here ...
     */

    public function settingProvider()
    {
        return array(
            array(Point::factory(1,1)),
            array(Point::factory(2,4)),
        );
    }

    /**
     * @dataProvider dimensionProvider
     */
    public function testGettingDimensions($top,$left,$bottom,$right)
    {
        $f = Rectangle::factory($top,$left,$bottom,$right);
        $this->assertSame($left, $f->getLeft());
        $this->assertSame($top, $f->getTop());
        $this->assertSame($bottom, $f->getBottom());
        $this->assertSame($right, $f->getRight());
        $this->assertSame($right-$left, $f->getWidth());
        $this->assertSame($top-$bottom, $f->getHeight());
    }

    public function dimensionProvider()
    {
        return array(
            array(-1.0,1.0,1.0,-1.0),
            array(1.0,2.0,2.0,1.0),
            array(10.0,2.0,20.0,10.0),
        );
    }

    public function testFactoryCreation()
    {
        $p1 = Point::factory('-1',-1);
        $p2 = Point::factory(1,1);
        $r = Rectangle::factory(-1,-1,1,1);
        $this->assertInstanceof('Org\Heigl\Geo\Rectangle', $r);
        $this->assertAttributeEquals($p1,'topLeft',$r);
        $this->assertAttributeEquals($p2,'bottomRight',$r);
    }


}

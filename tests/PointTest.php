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

use \Org\Heigl\Geo\Point;

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
class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider settingProvider
     */
    public function testXValues($set,$await)
    {
        $p = new Point();
        $this->assertAttributeEquals(0,'x',$p);
        $this->assertSame($p, $p->setX($set));
        $this->assertAttributeEquals($await,'x',$p);
        $this->assertSame($await, $p->getX());
    }

    /**
     * @dataProvider settingProvider
     */
    public function testYValues($set,$await)
    {
        $p = new Point();
        $this->assertAttributeEquals(0,'y',$p);
        $this->assertSame($p, $p->setY($set));
        $this->assertAttributeEquals($await,'y',$p);
        $this->assertSame($await, $p->getY());
    }

    /**
     * @dataProvider settingProvider
     * Enter description here ...
     */

    public function settingProvider()
    {
        return array(
            array(0,0.0),
            array('0',0.0),
            array(false,0.0),
            array('0 Ahnung',0.0),
            array('-10',-10.0),
            array('-10.5',-10.5),
            array('10.5',10.5),
            array('10,5', 10.0),
            array('test',0.0),
        );
    }



    public function testFactoryCreation()
    {
        $p = Point::factory('1',-200);
        $this->assertInstanceof('Org\Heigl\Geo\Point', $p);
        $this->assertAttributeEquals(1.0,'x',$p);
        $this->assertAttributeEquals(-200.0,'y',$p);
    }

    /**
     * @dataProvider dimensionProvider
     */
    public function testGettingDimensions($x, $y)
    {
        $p = Point::factory($x, $y);
        $this->assertEquals((float) $x, $p->getLeft());
        $this->assertEquals((float) $x, $p->getRight());
        $this->assertEquals((float) $y, $p->getTop());
        $this->assertEquals((float) $y, $p->getBottom());
    }

    public function dimensionProvider()
    {
        return array(
            array(0.0, 2.0),
            array('a', '2.0'),
            array('20 Meilen', 4),
        );
    }

}

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

use \Org\Heigl\Geo\Polygon,
    \Org\Heigl\Geo\Point,
    \Org\Heigl\Geo\Rectangle
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
class PolygonTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingPoints()
    {
        $p = new Polygon();
        $p1 = new Point();
        $p2 = new Point();
        $this->assertAttributeEquals(array(),'stack',$p);
        $this->assertSame($p, $p->addPoint($p1));
        $this->assertAttributeEquals(array($p1),'stack',$p);
        $this->assertSame($p, $p->addPoint($p1));
        $this->assertAttributeEquals(array($p1,$p1),'stack',$p);
        $this->assertSame($p, $p->addPoint($p2));
        $this->assertAttributeEquals(array($p1,$p1,$p2),'stack',$p);
    }

    public function testGettingPoints()
    {
        // Setup
        $p = new Polygon();
        $p1 = new Point();
        $p2 = new Point();
        $p3 = new Point();
        $p->addPoint($p1)->addPoint($p2);
        $this->assertAttributeEquals(array($p1,$p2),'stack',$p);

        // Get points
        $this->assertSame($p1, $p->getPoint(0));
        $this->assertSame($p2, $p->getPoint(1));

        try{
            $p->getPoint(2);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
        try{
            $p->getPoint($p3);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemovingPoints()
    {
        $p = new Polygon();
        $p1 = new Point();
        $p2 = new Point();
        $p3     = new Point();
        $p->addPoint($p1)->addPoint($p2);
        $this->assertAttributeEquals(array($p1,$p2),'stack',$p);

        $this->assertSame($p,$p->removePoint($p1));
        $this->assertAttributeEquals(array($p2),'stack',$p);

        $this->assertSame($p, $p->addPoint($p1));
        $this->assertAttributeEquals(array($p2, $p1),'stack',$p);

        $this->assertSame($p, $p->removePoint(0));
        $this->assertAttributeEquals(array($p1),'stack',$p);

        try{
            $p->removePoint(2);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
        try{
            $p->removePoint($p3);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }

    }

    public function testHasPoint()
    {
        $p = new Polygon();
        $p1 = new Point();
        $p2 = new Point();
        $p->addPoint($p1);
        $this->assertTrue($p->hasPoint(0));
        $this->assertTrue($p->hasPoint($p1));
        $this->assertFalse($p->hasPoint($p2));
        $this->assertFalse($p->hasPoint(1));
        $p->addPoint($p2)->removePoint($p1);
        $this->assertTrue($p->hasPoint(0));
        $this->assertTrue($p->hasPoint($p2));
        $this->assertFalse($p->hasPoint($p1));
        $this->assertFalse($p->hasPoint(1));
    }

    /**
     * @dataProvider boxProvider
     */
    public function testGettingBoundingBox($rect, $points)
    {
        $p = new Polygon();
        foreach ( $points as $point ) {
            $p->addPoint($point);
        }
        $r = $p->getBoundingBox();
        $this->assertInstanceof('\Org\Heigl\Geo\Rectangle', $r);
        $this->assertEquals($rect, $r);
    }

    public function boxProvider()
    {
        return array (
            array(Rectangle::factory(1,-1,-1,1),array(Point::factory(1,-1),Point::factory('-1','1'))),
        );
    }


}

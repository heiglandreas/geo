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

use \Org\Heigl\Geo\AbstractShape
  , \Org\Heigl\Geo\Rectangle
  , \Org\Heigl\Geo\Point
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
class AbstractShapeTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingStackable()
    {
        $p = new TestShape();
        $p1 = new TestShape();
        $p2 = new TestShape();
        $this->assertAttributeEquals(array(),'stack',$p);
        $this->assertSame($p, $p->addStackable($p1));
        $this->assertAttributeEquals(array($p1),'stack',$p);
        $this->assertSame($p, $p->addStackable($p1));
        $this->assertAttributeEquals(array($p1,$p1),'stack',$p);
        $this->assertSame($p, $p->addStackable($p2));
        $this->assertAttributeEquals(array($p1,$p1,$p2),'stack',$p);
    }

    public function testGettingStackable()
    {
        // Setup
        $p = new TestShape();
        $p1 = new TestShape();
        $p2 = new TestShape();
        $p3 = new TestShape();
        $p->addStackable($p1)->addStackable($p2);
        $this->assertAttributeEquals(array($p1,$p2),'stack',$p);

        // Get points
        $this->assertSame($p1, $p->getStackable(0));
        $this->assertSame($p2, $p->getStackable(1));

        try{
            $p->getStackable(2);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
        try{
            $p->getStackable($p3);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemovingPoints()
    {
        $p  = new TestShape();
        $p1 = new TestShape();
        $p2 = new TestShape();
        $p3 = new TestShape();
        $p->addStackable($p1)->addStackable($p2);
        $this->assertAttributeEquals(array($p1,$p2),'stack',$p);

        $this->assertSame($p,$p->removeStackable($p1));
        $this->assertAttributeEquals(array($p2),'stack',$p);

        $this->assertSame($p, $p->addStackable($p1));
        $this->assertAttributeEquals(array($p2, $p1),'stack',$p);

        $this->assertSame($p, $p->removeStackable(0));
        $this->assertAttributeEquals(array($p1),'stack',$p);

        try{
            $p->removeStackable(2);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
        try{
            $p->removeStackable($p3);
            $this->assertTrue(false);
        }catch(\Org\Heigl\Geo\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }

    }

    public function testHasStackable()
    {
        $p  = new TestShape();
        $p1 = new TestShape();
        $p2 = new TestShape();
        $p->addStackable($p1);
        $this->assertTrue($p->hasStackable(0));
        $this->assertTrue($p->hasStackable($p1));
        $this->assertFalse($p->hasStackable($p2));
        $this->assertFalse($p->hasStackable(1));
        $p->addStackable($p2)->removeStackable($p1);
        $this->assertTrue($p->hasStackable(0));
        $this->assertTrue($p->hasStackable($p2));
        $this->assertFalse($p->hasStackable($p1));
        $this->assertFalse($p->hasStackable(1));
    }

    /**
     * @dataProvider boxProvider
     */
    public function testGettingBoundingBox($rect, $stackables)
    {
        $p = new TestShape();
        foreach ( $stackables as $stackable ) {
            $p->addStackable($stackable);
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

    public function testIterator()
    {
        $p = new TestShape();
        $this->assertFalse($p->valid());
        $this->assertSame($p,$p->addStackable(new TestShape()));
        $this->assertTrue($p->valid());
        $this->assertEquals(0,$p->key());
        $this->assertEquals(new TestShape(), $p->current());
        $p->next();
        $this->assertFalse($p->valid());
        $p->rewind();
        $this->assertTrue($p->valid());
    }

    public function testCountable()
    {
        $p = new TestShape();
        $this->assertEquals(0, $p->count());
        $p->addStackable(new TestShape());
        $this->assertEquals(1, $p->count());
        $p->addStackable(new TestShape());
        $this->assertEquals(2, $p->count());
        $p->removeStackable(0);
        $this->assertEquals(1, $p->count());
    }

}

class TestShape extends AbstractShape
{
    //
}

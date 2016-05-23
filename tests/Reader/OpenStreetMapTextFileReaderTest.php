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

use \Org\Heigl\Geo\Reader\OpenStreetMapTextFileReader
  , \Org\Heigl\Geo\InvalidArgumentException
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
class OpenStreetMapTextFileReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testParsingNonExistentFile()
    {
        $p = new OpenStreetMapTextFileReader();
        try{
            $p->parse('foo/bar.txt');
            $this->assertFalse(true);
        } catch (InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testParsingEmptyFile()
    {
        $p = new OpenStreetMapTextFileReader();
        $s = $p->parse(__DIR__ . DIRECTORY_SEPARATOR . 'share' . DIRECTORY_SEPARATOR . 'osm_empty.txt');
        $this->assertInstanceof('\Org\Heigl\Geo\Shape', $s);
        $this->assertEquals(0, $s->count());
    }

    public function testParsingOneLineFile()
    {
        $p = new OpenStreetMapTextFileReader();
        $s = $p->parse(__DIR__ . DIRECTORY_SEPARATOR . 'share' . DIRECTORY_SEPARATOR . 'osm_oneline.txt');
        $this->assertInstanceof('\Org\Heigl\Geo\Shape', $s);
        $this->assertEquals(1, $s->count());
        $polygon = $s->current();
        $this->assertInstanceof('\Org\Heigl\Geo\Polygon', $polygon);
        $this->assertEquals(1, $polygon->count());
        $point = $polygon->current();
        $this->assertInstanceof('\Org\Heigl\Geo\Point', $point);
        $this->assertEquals(0.12345, $point->getX());
        $this->assertEquals(0.12345, $point->getY());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getLeft());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getTop());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getBottom());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getRight());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getLeft());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getTop());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getBottom());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getRight());
    }

    public function testParsingMultiLineFile()
    {
        $p = new OpenStreetMapTextFileReader();
        $s = $p->parse(__DIR__ . DIRECTORY_SEPARATOR . 'share' . DIRECTORY_SEPARATOR . 'osm_multiline.txt');
        $this->assertInstanceof('\Org\Heigl\Geo\Shape', $s);
        $this->assertEquals(2, $s->count());
        $polygon = $s->current();
        $this->assertInstanceof('\Org\Heigl\Geo\Polygon', $polygon);
        $this->assertEquals(5, $polygon->count());
        $point = $polygon->current();
        $this->assertInstanceof('\Org\Heigl\Geo\Point', $point);
        $this->assertEquals(0.12345, $point->getX());
        $this->assertEquals(0.12345, $point->getY());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getLeft());
        $this->assertEquals(1.12345, $polygon->getBoundingBox()->getTop());
        $this->assertEquals(0.12345, $polygon->getBoundingBox()->getBottom());
        $this->assertEquals(1.12345, $polygon->getBoundingBox()->getRight());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getLeft());
        $this->assertEquals(3.12345, $s->getBoundingBox()->getTop());
        $this->assertEquals(0.12345, $s->getBoundingBox()->getBottom());
        $this->assertEquals(3.12345, $s->getBoundingBox()->getRight());
    }
}

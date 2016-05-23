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
 * @subpackage Reader
 * @author     Andreas Heigl <andreas@heigl.org>
 * @copyright  2008-2011 Andreas Heigl<andreas@heigl.org>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */

namespace Org\Heigl\Geo\Reader;

use \Org\Heigl\Geo\InvalidArgumentException;
/**
 * This describes a Reader for data from the OpenStreetMap-Project
 *
 * Such a file contains either a point definition or is blank.
 *
 * A blank line defines the end of a polygon.
 *
 * Each point is defined using latitude/longitude values
 *
 * @category   Geo
 * @package    Org\Heigl\Geo
 * @subpackage Reader
 * @author     Andreas Heigl <a.heigl@wdv.de>
 * @copyright  2008-2011 Andreas Heigl
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */
class OpenStreetMapTextFileReader extends AbstractReader
{
    /**
     * Render the given file
     *
     * @param string $file the location of a file to parse
     *
     * @throws InvalidArgumentException When no input file an be read
     * @return AbstractShape()
     */
    public function parse($file)
    {
        if ( ! is_readable($file) ) {
            throw new InvalidArgumentException(sprintf('The file %s could not be read', $file));
        }

        $shape = $this->getNewShape();
        $polygon = $this->getNewPolygon();
        foreach ( file($file) as $line ) {
            if ( ! trim($line) ) {
                // This line is empty, so let's add the last polygon to the
                // shape and create a new one
                if ( 0 < $polygon->count() ) {
                    $shape->add($polygon);
                    $polygon = $this->getNewPolygon();
                }
                continue;
            }
            $line = explode(',', trim($line));
            if ( 2 != count($line) ) {
                continue;
            }
            $point = $this->getnewPoint($line[0], $line[1]);
            $polygon->addPoint($point);
        }
        if ( 0 < $polygon->count() ) {
            $shape->add($polygon);
        }
        return $shape;
    }
}
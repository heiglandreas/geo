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
 * @subpackage Renderer
 * @author     Andreas Heigl <andreas@heigl.org>
 * @copyright  2008-2011 Andreas Heigl<andreas@heigl.org>
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */

namespace Org\Heigl\Geo\Renderer;

use \Org\Heigl\Geo\AbstractShape;

/**
 * This describes a base-renderer
 *
 * @category   Geo
 * @package    Org\Heigl\Geo
 * @subpackage Renderer
 * @author     Andreas Heigl <a.heigl@wdv.de>
 * @copyright  2008-2011 Andreas Heigl
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    0.0
 * @link       http://github.com/heiglandreas/geo
 * @since      24.02.2012
 */
class Renderer
{
    /**
     * Holds the result-object.
     *
     * @var Result $result
     */
    protected $result = null;

    /**
     * Create an instance of a renderer
     *
     * @param string $renderer The Renderer to use
     *
     * @throws Exception
     * @return Renderer
     */
    public static function factory($renderer)
    {
        $class = '\\Org\\Heigl\\Geo\\Renderer\\' . ucfirst(strtolower($renderer)) . '\\Renderer';
        try{
            return new $class();
        }catch(Exception $e){
            throw $e;
        }
    }

    /**
     * Render the given shape to the given Result-class
     *
     * @param AbstractShape $shape  The shape to render
     * @param Result        $result The Result-Object to append the result to
     *
     * @return Result
     */
    public function render(AbstractShape $shape, Result $result)
    {
        return $this->getRenderer($shape)->render($result);
        $result = new \Org\Heigl\Geo\Renderer\Result();
        foreach ( $shape as $item ) {
            $class = get_class($item);
            $namespace = get_namespace($item);
            $class = str_replace($namespace, '', $class);
            $renderer = new $class();
            $class->render($item, $result);
        }
        return $result;
    }

    /**
     * Create a renderer for a given geo-object and return it.
     *
     * @param mixed $shape The shape to get the renderer for
     *
     * @return Renderer
     */
    public function getRenderer($shape)
    {
        $class = get_class($shape);
        $namespace = get_namespace($shape);
        $class = str_replace($namespace, '', $class);
        $renderer = new $class();
        $renderer->setObject($shape);
        return $renderer;
    }

    /**
     * Set the result-object
     *
     * @param Result $result The Result-Object
     *
     * @return Renderer
     */
    public function setResult(Result $result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * Get the result-object
     *
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }
}
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

use \Org\Heigl\Geo\Rectangle;

/**
 * This describes an abstract shape that resides inside a bounding box.
 *
 * @category  Geo
 * @package   Org\Heigl\Geo
 * @author    Andreas Heigl <a.heigl@wdv.de>
 * @copyright 2008-2011 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @link      http://github.com/heiglandreas/geo
 * @since     27.02.2012
 */
abstract class AbstractShape implements \Iterator, \Countable, StackableInterface
{
    /**
     * The stack.
     *
     * @var StackableInterface[] $stack
     */
    protected $stack = array();

    /**
     * This property holds the bounding box of the Shape.
     *
     * @var Org\Heigl\Geo\Rectangle
     */
    protected $boundingBox = null;

    /**
     * Create an instance of the Shape
     *
     * @return void
     */
    public function __construct()
    {
        $this->boundingBox = new Rectangle();
    }

    /**
     * Get the bounding box of this polygon
     *
     * @return Org\Heigl\Geo\Rectangle
     */
    public function getBoundingBox()
    {
        return $this->boundingBox;
    }

    /**
     * Implements \Iterator::current()
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->stack);
    }

    /**
     * Implements \Iterator::key()
     *
     * @return scalar
     */
    public function key()
    {
        return key($this->stack);
    }

    /**
     * Implements \Iterator::next()
     *
     * @return void
     */
    public function next()
    {
        next($this->stack);
    }

    /**
     * Implements \Iterator::valid()
     *
     * @return boolean
     */
    public function valid()
    {
        return (false===current($this->stack))?false:true;
    }

    /**
     * Implements \Iterator::rewind()
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->stack);
    }

    /**
     * Implements \Countable::count()
     *
     * @return int
     */
    public function count()
    {
        return count($this->stack);
    }

    /**
     * Add a stackable to the stack
     *
     * @param StackableInterface $stackable The stackable to add
     *
     * @return AbstractShape
     */
    public function addStackable(StackableInterface $stackable)
    {
        $this->stack[] = $stackable;
        $this->updateBoundingBox($stackable);
        return $this;
    }

    /**
     * Update the bounding box
     *
     * @param StackableInterface $stackable The Stackable to update the stack with
     *
     * @return Polygon
     */
    protected function updateBoundingBox(StackableInterface $stackable)
    {
        $bb = $this->getBoundingBox();
        if ( null === $bb->getLeft() || $stackable->getLeft() < $bb->getLeft() ) {
            $bb->getTopLeft()->setX($stackable->getLeft());
        }
        if ( null === $bb->getRight() || $stackable->getRight() > $bb->getRight() ) {
            $bb->getBottomRight()->setX($stackable->getRight());
        }
        if ( null === $bb->getBottom() || $stackable->getBottom() < $bb->getBottom() ) {
            $bb->getBottomRight()->setY($stackable->getBottom());
        }
        if ( null === $bb->getTop() || $stackable->getTop() > $bb->getTop() ) {
            $bb->getTopLeft()->setY($stackable->getTop());
        }

        return $this;
    }


    /**
     * Get a Stackable from the stack by it's ID
     *
     * @param int $id The ID of the stackable
     *
     * @throws InvalidArgumentException
     * @return StackableInterface
     */
    public function getStackable($id)
    {
        if ( ! $this->hasStackable($id) ) {
            throw new InvalidArgumentException('The requested Key does not exist');
        }
        return $this->stack[$id];
    }

    /**
     * Check whether the given point exists or not.
     *
     * @param int|StackableInterface $stackable The stackable or it's key to
     * search for
     *
     * @return boolean
     */
    public function hasStackable($stackable)
    {
        if ( $stackable instanceof StackableInterface) {
            if ( false !== array_search($stackable, $this->stack, true) ) {
                return true;
            }
            return false;
        }
        return isset($this->stack[$stackable]);
    }

    /**
     * Remove a point from the list
     *
     * @param int|StackableInterface $stackable The Stackable to be removed
     *
     * @throws InvalidArgumentException
     * @return AbstractShape
     */
    public function removeStackable($stackable)
    {
        if ( ! $this->hasStackable($stackable) ) {
            throw new InvalidArgumentException('The requested Stackable does not exist');
        }
        if ( $stackable instanceof StackableInterface ) {
            $stackable = array_search($stackable, $this->stack);
        }
        array_splice($this->stack, $stackable, 1);
        return $this;
    }

    /**
     * Get the top-value
     *
     * Implements StackableInterface::getTop()
     *
     * @return float
     */
    public function getTop()
    {
        return $this->getBoundingBox()->getTop();
    }

    /**
     * Get the bottom-value
     *
     * Implements StackableInterface::getBottom()
     *
     * @return float
     */
    public function getBottom()
    {
        return $this->getBoundingBox()->getBottom();
    }

    /**
     * Get the Left-value
     *
     * Implements StackableInterface::getLeft()
     *
     * @return float
     */
    public function getLeft()
    {
        return $this->getBoundingBox()->getLeft();
    }

    /**
     * Get the Right-value
     *
     * Implements StackableInterface::getRight()
     *
     * @return float
     */
    public function getRight()
    {
        return $this->getBoundingBox()->getRight();
    }
}
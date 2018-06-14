<?php
/**
 * @author Mehmet Karaküçük <mehmetkarakucuk@gmail.com>
 */
namespace OOP_Example;

require_once 'Shelf.php';
require_once 'Coke.php';

/**
 *
 */
class Refrigerator
{
    private $_shelf;
    private $_isDoorOpened;

    public function __construct()
    {
        $this->_shelf = array(
            new Shelf(),
            new Shelf(),
            new Shelf()
        );

        $this->_isDoorOpened = false;
    }

    public function openTheDoor()
    {
        $this->_isDoorOpened = true;
    }

    public function closeTheDoor()
    {
        $this->_isDoorOpened = false;
    }

    /**
     * @return boolean      The door status
     */
    public function isDoorOpened()
    {
        return $this->_isDoorOpened;
    }

    public function putCan($can)
    {
        // if (!$this->isDoorOpened()) {
        //     throw new Exception("Please open the door!", 403);
        // }

        if (gettype($can) === 'array') {
            foreach ($can as $_can) {
                $this->_putCanToShelf($_can);
            }
        } else {
            $this->_putCanToShelf($can);
        }
    }

    /**
     *
     *
     * @param  int    $count [description]
     * @return [type]        [description]
     */
    public function getCan(int $count)
    {
        // if (!$this->isDoorOpened()) {
        //     throw new Exception("Please open the door!", 403);
        // }

        $count = floor(abs($count));

        $can = array();

        for ($i=0; $i < $count; $i++) {
            $output = $this->_getCanFromShelf();
            if ($output === false) {
                break;
            }
            $can[] = $output;
        }

        return $can;
    }

    /**
     * get Stock Count
     *
     * @return int
     */
    public function getStockCount()
    {
        $result = 0;
        foreach ($this->_shelf as $shelf) {
            $result += $shelf->getStockCount();
        }

        return $result;
    }

    /**
     * isFull
     *
     * @return boolean
     */
    public function isFull()
    {
        foreach ($this->_shelf as $shelf) {
            if (!$shelf->isFull()) {
                return false;
            }
        }

        return true;
    }

    /**
     *
     * @throws Exception        There is no space available
     * @throws Exception        Please put a can!
     * @param  ICan $can
     * @return bool
     */
    private function _putCanToShelf($can)
    {
        $success = false;

        foreach ($this->_shelf as $shelf) {
            if (!$shelf->isFull()) {
                $success = $shelf->put($can);
                break;
            }
        }

        if (!$success) {
            throw new \Exception("There is no space available!", 406);
        }
    }

    /**
     *
     * @return mixed
     */
    private function _getCanFromShelf()
    {
        foreach ($this->_shelf as $_shelf) {
            if (!$_shelf->isEmpty()) {
                return $_shelf->get();
            }
        }

        return false;
    }
}

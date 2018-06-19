<?php
/**
 * @author Mehmet Karaküçük <mehmetkarakucuk@gmail.com>
 */
namespace OOP_Example;

require_once 'ICan.php';

/**
 *
 */
class Shelf
{
    const CAPACITY = 20;

    private $stock;
    private $isFull;
    private $stock_count;

    public function __construct()
    {
        $this->stock = array();
        $this->isFull = false;
        $this->stock_count = 0;
    }

    public function getStockCount()
    {
        return count($this->stock);
    }

    public function getEmptySpace()
    {
        return self::CAPACITY - $this->stock_count;
    }

    public function isEmpty()
    {
        return $this->stock_count === 0;
    }

    public function isFull()
    {
        return $this->isFull;
    }

    public function put($can)
    {
        if (($can instanceof ICan) === false) {
            throw new \Exception('Please put a can!', 405);
        }

        if ($this->isFull()) {
            return false;
        }

        if ($this->getEmptySpace() < $can->getWeight()) {
            return false;
        }

        $this->stock[] = $can;
        $this->stock_count += $can->getWeight();
        $this->isFull = ($this->stock_count === self::CAPACITY);

        return true;
    }

    public function get()
    {
        if (empty($this->stock)) {
            return false;
        }

        $this->isFull = false;

        $can = array_pop($this->stock);
        $this->stock_count -= $can->getWeight();

        return $can;
    }
}

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

    public function __construct()
    {
        $this->stock = array();
        $this->isFull = false;
    }

    public function getStockCount()
    {
        return count($this->stock);
    }

    public function getEmptySpace()
    {
        return self::CAPACITY - $this->getStockCount();
    }

    public function isEmpty()
    {
        return empty($this->stock);
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

        $this->stock[] = $can;
        $this->isFull = ($this->getStockCount() === self::CAPACITY);

        return true;
    }

    public function get()
    {
        if (empty($this->stock)) {
            return false;
        }

        $this->isFull = false;

        return array_pop($this->stock);
    }
}

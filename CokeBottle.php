<?php
/**
 * @author Mehmet Karaküçük <mehmetkarakucuk@gmail.com>
 */
namespace OOP_Example;

require_once 'IBottle.php';

/**
 *
 */
class CokeBottle
{
    private $energy;
    private $sugar;

    public function __construct()
    {
        $this->energy = 105;
        $this->sugar = 27;
    }

    /**
     * @return float
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @return float
     */
    public function getSugar()
    {
        return $this->sugar;
    }
}

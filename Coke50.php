<?php
/**
 * @author Mehmet Karaküçük <mehmetkarakucuk@gmail.com>
 */
namespace OOP_Example;

require_once 'ICan.php';

/**
 *
 */
class Coke50 implements ICan
{
    private $energy;
    private $sugar;
    private $weight;

    public function __construct()
    {
        $this->energy = 45;
        $this->sugar = 11.2;
        $this->weight = 2;
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

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
}

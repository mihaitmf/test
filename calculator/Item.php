<?php
namespace Calculator;

class Item
{
    private $quantity;
    private $price;

    public function __construct($quantity, $price)
    {
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}

<?php
namespace Calculator;

class Calculator
{
    /**
     * @param Item[] $items
     * @return double
     */
    public function calculateTotalPrice(array $items, $state)
    {
        $totalPrice = 0;
        foreach ($items as $item) {

            if ($item->getQuantity() > 0 && $item->getPrice() > 0) {
                $totalPrice += $item->getQuantity() * $item->getPrice();
            }
        }

        $totalPrice = $this->addDiscount($totalPrice);
        return $totalPrice;
    }

    private function addDiscount($totalPrice)
    {
        if ($totalPrice > 50) {
            return $totalPrice - 0.9;
        }
        if ($totalPrice > 40) {
            return $totalPrice - 0.7;
        }
        if ($totalPrice > 30) {
            return $totalPrice - 0.5;
        }
        if ($totalPrice > 20) {
            return $totalPrice - 0.3;
        }
        if ($totalPrice > 10) {
            return $totalPrice - 0.1;
        }
        return $totalPrice;
    }
}

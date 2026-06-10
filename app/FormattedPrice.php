<?php

namespace App;

trait FormattedPrice
{
    public function formattedPrice(string $field = 'price'): string
    {
        return number_format($this->$field, 2, ',', '.');
    }
}

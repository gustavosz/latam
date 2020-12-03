<?php


namespace App\Exercise2;


class Product
{
    private $sku;
    private $name;

    public function __construct($sku, $name)
    {
        $this->sku = $sku;
        $this->name = $name;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

}

<?php


namespace App\Exercise2;


use Illuminate\Support\Collection;

class Purchase
{
    private $number;
    private $date;
    private $products;

    public function __construct($number, $date)
    {
        $this->number = $number;
        $this->date = $date;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProductBySku(string $sku): array
    {
        $products = new Collection($this->products);

        $filtered = $products->filter(function ($value) use ($sku) {
            return $sku === $value->getSku();
        });

        return $filtered->all();
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setProducts(array $products): void
    {
        $this->products = new Collection($products);
    }
}

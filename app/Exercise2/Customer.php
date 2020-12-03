<?php


namespace App\Exercise2;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class Customer
{
    private $purchases;

    public function __construct(string $purchases)
    {
        $this->purchases = json_decode($purchases, true);
    }

    public function getPurchases(): array
    {
        $purchases = array();
        foreach ($this->purchases['customer']['purchases'] as $index => $value) {
            $purchase = new Purchase($value['number'], $value['date']);

            foreach ($value['products'] as $val) {
                $product = new Product($val['sku'], $val['name']);
                $purchase->addProduct($product);
            }

            $purchases[] = $purchase;
        }

        return $purchases;
    }

    public function getPurchasesDuplicated(): array
    {
        $purchases = new Collection($this->purchases['customer']['purchases']);

        return $purchases->duplicates('products')->first();
    }

    public function calculateRePurchase(): array
    {
        $duplicates = $this->getPurchasesDuplicated();
        $validPurchases = array();

        foreach ($duplicates as $duplicate) {
            $purchases = $this->getPurchases();
            foreach ($purchases as $purchase) {
                $product = $purchase->getProductBySku($duplicate['sku']);
                if (!empty($product)) {
                    $purchase->setProducts([$product][0]);
                    $validPurchases[] = $purchase;
                }
            }
        }

        $products = array();
        foreach ($validPurchases as $purchase) {
            $firstProduct = $purchase->getProducts()->first();

            if (isset($products[$firstProduct->getSku()])) {
                $products[$firstProduct->getSku()]['dates'][] = $purchase->getDate();
            } else {
                $products[$firstProduct->getSku()] = [
                    'dates' => [
                        $purchase->getDate()
                    ]
                ];
            }
        }

        $result = array();
        foreach ($products as $index => $product) {
            $media = 0;
            foreach ($product['dates'] as $index2 => $date) {
                if ($index2 !== 0) {
                    $from = Carbon::parse($product['dates'][$index2 - 1]);
                    $to = Carbon::parse($date);

                    $media += $from->diffInDays($to);
                }
            }

            $result[$index] = $media / (count($product['dates']) - 1);
        }

        return $result;
    }
}

<?php


namespace App\Actions;


use App\Models\Product;

class ExtendProductModelAction
{
    public function __invoke($products)
    {
        $products->each(function($item) {
            if($item->promotions()->whereStatus(1)->count()) {
                $promotion = $item->promotions()->whereStatus(1)->whereNotNull('discount')->first();
                $item->discount = $promotion->discount;
                $item->currentPrice = round(($item->getRawOriginal('price') * (1 - ($item->discount / 100))));
            }
        });

        return $products;
    }
}

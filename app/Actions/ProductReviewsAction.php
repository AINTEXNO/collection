<?php


namespace App\Actions;


class ProductReviewsAction
{
    public function __invoke($product)
    {
        return $product->reviews->each(function ($review) {
            $review->user = "{$review->user->name} {$review->user->surname}";
            $review->created = date_format($review->created_at, "d F, Y");
        });
    }
}

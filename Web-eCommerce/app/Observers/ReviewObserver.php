<?php

namespace App\Observers;

use App\Review;
use App\Product;

class ReviewObserver
{
    /**
     * Handle the review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $productId = $review->product_id;

        $PT = Product::find($productId);
        $PT->star_tot_number += $review->stars;
        $PT->n_reviews++;
        $PT->save();
    }
    /**
     * Handle the review "updated" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function updating(Review $review)
    {
        if($review->isDirty('stars')) // stars has changed
        {
            $new_stars = $review->stars; 
            $old_stars = $review->getOriginal('stars');
            $diff = $new_stars - $old_stars;

            $productId = $review->product_id;
            
            $PT = Product::find($productId);
            $PT->star_tot_number += $diff;
            $PT->save();
        }
    }
    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $productId = $review->product_id;

        $PT = Product::find($productId);
        $PT->star_tot_number -= $review->stars;
        $PT->n_reviews--;
        $PT->save();
    }
}

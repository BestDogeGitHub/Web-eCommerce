<?php

namespace App\Observers;

use App\Review;
use App\ProductType;

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
        $productTypeId = $review->product_type_id;

        $PT = ProductType::find($productTypeId);
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
    public function updated(Review $review)
    {
        //
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        //
    }
}

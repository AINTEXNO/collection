<?php

namespace App\Http\Controllers;

use App\Actions\GetUserByTokenAction;
use App\Actions\ProductReviewsAction;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProductReviewsAction $action, $product)
    {
        $product = Product::find($product);
        $reviews = $action($product);

        return response()->json([
            'status' => true,
            'data' => [
                'reviews' => $reviews
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreReviewRequest $request
     * @param GetUserByTokenAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, GetUserByTokenAction $action, ProductReviewsAction $prod): \Illuminate\Http\JsonResponse
    {
        $user = $action($request->api_token);
        $product = Product::find($request->product_id);

        if($user) {
            $request->merge(['user_id' => $user->id]);
            Review::create($request->all());

            return response()->json([
                'status' => true,
                'data' => [
                    'reviews' => $prod($product)
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Incorrect token'
        ])->setStatusCode(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}

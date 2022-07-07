<?php

namespace App\Http\Controllers;

use App\Actions\ExtendProductModelAction;
use App\Actions\StoreUploadFileAction;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Color;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Promotion;
use App\Models\Style;
use App\Traits\Helpers;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ExtendProductModelAction $action)
    {
        $products = $action(Product::orderByDesc('id')->get());
        $promotions = Promotion::orderBYDesc('id')->get();
        $brands = Brand::all();
        $categories = Category::all();
        $styles = Style::all();
        $collections = Collection::all();
        $colors = Color::all();
        $prices = (object)[
            'min' => $products->min('price'),
            'max' => $products->max('price')
        ];

        return view('product.index', compact(
            'categories',
            'products',
            'promotions',
            'brands',
            'categories',
            'styles',
            'colors',
            'collections',
            'prices',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('is-admin');

        $collections = Collection::all();
        $categories = Category::all();
        $brands = Brand::all();
        $styles = Style::all();
        $colors = Color::all();

        return view('product.create', compact(
            'collections',
            'categories',
            'brands',
            'styles',
            'colors'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @param \App\Actions\StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreProductRequest $request, StoreUploadFileAction $action): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('is-admin');

        $request->merge(['photo' => $action($request->file('image')), 'code' => '']);
        Product::create($request->all());

        return back()->with(['created' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @param \App\Actions\ExtendProductModelAction $action
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product, ExtendProductModelAction $action)
    {
        if($product->promotions()->whereStatus(1)->count()) {
            $promotion = $product->promotions()->whereStatus(1)->whereNotNull('discount')->first();
            $product->discount = $promotion->discount;
            $product->currentPrice = $product->price - (($product->price / 100) * $promotion->discount);
        }

        $similarProducts = $action(Product::whereCategoryId($product->category->id)->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get());
        $orderProducts = OrderProduct::whereHas('order', function ($order) {
            $order->where('user_id', auth()->id())->where('order_status_id', 3);
        })->get();

        $rating = $product->reviews->map(function ($review) {
            return $review->rating;
        })->toArray();

        $rating = count($rating) ? round(array_sum($rating) / count($rating)) : 0;

        $hasProductInUserOrders = (boolean)$orderProducts->where('product_id', $product->id)->count();

        return view('product.show', compact('product', 'similarProducts', 'hasProductInUserOrders', 'rating'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('is-admin');

        $collections = Collection::all();
        $categories = Category::all();
        $brands = Brand::all();
        $styles = Style::all();
        $colors = Color::all();

        return view('product.edit', compact(
            'collections',
            'categories',
            'brands',
            'styles',
            'colors',
            'product',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return back()->with(['updated' => "Данные товара \"{$product->title}\" успешно обновлены"]);
    }

    public function products()
    {
        $products = Product::orderByDesc('id')->get();
        return view('admin.products', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with(['delete' => "Товар \"{$product->title}\" удален"]);
    }

    public function updateCartProducts(Request $request, ExtendProductModelAction $action)
    {
        $products = $action(Product::find($request->products));

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }
}

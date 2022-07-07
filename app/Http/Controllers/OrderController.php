<?php

namespace App\Http\Controllers;

use App\Actions\ExtendProductModelAction;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $orders = Order::OrderFilter($request->query('status'))->orderByDesc('id')->get();

        $orders->each(function($order) {
            $order->products->each(function($product) {
                if($product->product->promotions()->whereStatus(1)->count()) {
                    $promotion = $product->product->promotions()->whereStatus(1)->whereNotNull('discount')->first();
                    $product->product->discount = $promotion->discount;
                    $product->product->currentPrice = $product->product->price - (($product->product->price / 100) * $promotion->discount);
                }
            });
        });

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('order.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        $statuses = OrderStatus::all();
        return view('order.show', compact('order', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return back()->with(['updated' => "Статус заказа №{$order->code} успешно изменен"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function createOrder(Request $request)
    {
        $request->merge([
            'code' => rand(10000, 99999),
            'total' => (int)$request->total
        ]);

        $order = Order::create($request->all());

        foreach($request->products as $key => $value) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $key,
                'count' => $value
            ]);

            $product = Product::find($key);
            $product->update(['count' => $product->count - $value]);
            $product->save();
        }

        return response()->json([
            'status' => true,
            'params' => [
                'code' => $request->code
            ]
        ])->setStatusCode(200);
    }

    public function usersOrders()
    {
        $orders = Order::orderByDesc('id')->get();
        return view('admin.orders', compact('orders'));
    }
}

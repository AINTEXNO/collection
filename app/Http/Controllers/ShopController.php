<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $shops = Shop::all();
        return view('shop.index', compact('shops'));
    }

    public function all()
    {
        $shops = Shop::all();
        $shops = $shops->each(function($shop) {
             $shop->city = $shop->city->title;
        });

        return response()->json([
            'status' => true,
            'data' => [
                'shops' => $shops
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $cities = City::all();
        return view('shop.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShopRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreShopRequest $request)
    {
        Shop::create($request->validated());
        return redirect()->route('shops.all')->with(['created' => "Новый магазин \"{$request->title}\" добавлен"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop->update($request->validated());
        return back()->with(['updated' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return back()->with(['delete' => "Магазин \"{$shop->title}\" удален"]);
    }
}

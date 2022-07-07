<?php

namespace App\Http\Controllers;

use App\Actions\ExtendProductModelAction;
use App\Models\Post;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Shop;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(ExtendProductModelAction $action)
    {
        $products = $action(Product::orderByDesc('id')->where('count', '>', 0)->limit(8)->get());
        $trends = $action(Product::orderBy('count')->where('count', '>', 0)->limit(4)->get());
        $promotion = Promotion::orderByDesc('id')->first();
        $posts = Post::orderByDesc('id')->limit(3)->get();

        return view('pages.home', compact('products', 'trends', 'promotion', 'posts'));
    }

    public function control()
    {
        return view('admin.control');
    }

    public function shops()
    {
        $shops = Shop::all();
        return view('control.shop.index', compact('shops'));
    }
}

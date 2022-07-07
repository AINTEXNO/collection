<?php

namespace App\Http\Controllers;

use App\Actions\ExtendProductModelAction;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Color;
use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    protected $model;
    protected $products;

    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->products = $this->model->where('count', '>', 0)->get();
    }

    public function filter(Request $request, ExtendProductModelAction $action): \Illuminate\Http\JsonResponse
    {
        $search = $request->query();

        foreach ($search as $parameter => $query) {
            $queryParams = explode('_', $query);
            call_user_func_array(array($this, $parameter), array($queryParams));
        }

        return $this->response($action($this->products));
    }

    public function response($response): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => [
                'products' => $response
            ]
        ]);
    }

    public function promotion($parameters)
    {
        $this->products->each(function($product) use ($parameters) {
            $product->aliases = $product->promotions()->pluck('alias')->toArray();
        });

        $this->products = $this->products->filter(function($product) use ($parameters) {
            return array_intersect($product->aliases, $parameters);
        });
    }

    public function price($parameters)
    {
        $values = implode('-', $parameters);
        $prices = explode('-', $values);

        $minPrice = min($prices);
        $maxPrice = max($prices);

        $this->products = $this->products->where('price', '>=', $minPrice)
            ->where('price', '<=', $maxPrice);
    }

    public function brand($parameters)
    {
        $brands = Brand::whereIn('alias', $parameters)->pluck('id');
        $this->products = $this->products->whereIn('brand_id', $brands);
    }

    public function category($parameters)
    {
        $categories = Category::whereIn('alias', $parameters)->pluck('id');
        $this->products = $this->products->whereIn('category_id', $categories);
    }

    public function style($parameters)
    {
        $styles = Style::whereIn('alias', $parameters)->pluck('id');
        $this->products = $this->products->whereIn('style_id', $styles);
    }

    public function collection($parameters)
    {
        $collections = Collection::whereIn('alias', $parameters)->pluck('id');
        $this->products = $this->products->whereIn('collection_id', $collections);
    }

    public function color($parameters)
    {
        $colors = Color::whereIn('alias', $parameters)->pluck('id');
        $this->products = $this->products->whereIn('color_id', $colors);
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\ExtendProductModelAction;
use App\Actions\StoreUploadFileAction;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $promotions = Promotion::where('status', 1)->orderByDesc('id')->get();
        return view('promotion.index', compact('promotions'));
    }

    public function adminPromotions()
    {
        $promotions = Promotion::orderByDesc('id')->get();
        return view('admin.promotions', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePromotionRequest $request
     * @param StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePromotionRequest $request, StoreUploadFileAction $action): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $validated['photo'] = $action($request->file('image'));
        $validated['user_id'] = auth()->id();

        Promotion::create($validated);

        return back()->with(['created' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Promotion $promotion
     * @param ExtendProductModelAction $action
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Promotion $promotion, ExtendProductModelAction $action)
    {
        $products = $action($promotion->products()->orderByDesc('id')->where('count', '>', 0)->limit(4)->get());
        return view('promotion.show', compact('promotion', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Promotion $promotion)
    {
        return view('promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePromotionRequest $request
     * @param \App\Models\Promotion $promotion
     * @param \App\Actions\StoreUploadFileAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion, StoreUploadFileAction $action)
    {
        $validated = $request->validated();

        if($file = $request->file('image'))
            $validated['photo'] = $action($file);

        $promotion->update($validated);

        return redirect()->route('admin.promotions')->with(['updated' => "Акция \"{$promotion->title}\" успешно обновлена"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Promotion $promotion): \Illuminate\Http\RedirectResponse
    {
        $promotion->delete();
        return back()->with(['delete' => "Акция {$promotion->title} успешно удалена"]);
    }

    /**
     * @param \App\Models\Promotion $promotion
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function attach(Promotion $promotion)
    {
        $products = Product::all();
        return view('promotion.attach', compact('products', 'promotion'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachPromotions(Request $request): \Illuminate\Http\RedirectResponse
    {
        $promotion = Promotion::find($request->promotion_id);

        $request->action ? $promotion->products()->attach($request->products)
            : $promotion->products()->detach($request->products);

        return $request->action ? back()->with(['attached' => true]) : back()->with(['detached' => true]);
    }

    public function editPromotionStatus(Request $request, Promotion $promotion): \Illuminate\Http\RedirectResponse
    {
        $promotion->update(['status' => $request->status]);
        return back()->with(['status' => "Статус акции успешно изменен"]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestPromotions(Request $request): \Illuminate\Http\JsonResponse
    {
        $promotions = Promotion::orderByDesc('id')->whereStatus(1)->limit($request->count)->get();
        return response()->json([
            'status' => true,
            'data' => $promotions
        ]);
    }

    public function detach(Request $request, Product $product)
    {
        $promotion = $request->promotion;
        $product->promotions()->detach($promotion);
        return back()->with(['detached' => "Продукт \"{$product->title}\" откреплен от акции"]);
    }
}

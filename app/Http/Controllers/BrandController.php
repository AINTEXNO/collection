<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('control.brand.index', compact('brands'));
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
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();
        $validated['alias'] = $validated['title'];

        Brand::create($validated);
        return back()->with(['created' => "Бренд \"{$request->title}\" успешно добавлен"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Brand $brand)
    {
        return back()->with(["edit-{$brand->id}" => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $request->merge(['title' => $request->input('title-update')]);
        $brand->update($request->all());
        return back()->with(['updated' => "Наименование бренда успешно изменено"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with(['delete' => "Бренд \"{$brand->title}\" удален"]);
    }
}

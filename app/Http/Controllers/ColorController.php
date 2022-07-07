<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $colors = Color::all();
        return view('control.color.index', compact('colors'));
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
     * @param  \App\Http\Requests\StoreColorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreColorRequest $request)
    {
        $validated = $request->validated();
        $validated['alias'] = $validated['title'];

        Color::create($validated);
        return back()->with(['created' => "Цвет \"{$request->title}\" успешно добавлен"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Color $color)
    {
        return back()->with(["edit-{$color->id}" => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateColorRequest  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $request->merge(['title' => $request->input('title-update')]);
        $color->update($request->all());
        return back()->with(['updated' => "Цвет успешно изменен"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return back()->with(['delete' => "Цвет \"{$color->title}\" удален"]);
    }
}

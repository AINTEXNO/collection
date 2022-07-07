<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Http\Requests\StoreStyleRequest;
use App\Http\Requests\UpdateStyleRequest;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $styles = Style::all();
        return view('control.style.index', compact('styles'));
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
     * @param  \App\Http\Requests\StoreStyleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStyleRequest $request)
    {
        $validated = $request->validated();
        $validated['alias'] = $validated['title'];

        Style::create($validated);
        return back()->with(['created' => "Стиль \"{$request->title}\" успешно добавлен"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Style $style)
    {
        return back()->with(["edit-{$style->id}" => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStyleRequest  $request
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStyleRequest $request, Style $style)
    {
        $request->merge(['title' => $request->input('title-update')]);
        $style->update($request->all());
        return back()->with(['updated' => "Наименование стиля успешно изменено"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Style $style)
    {
        $style->delete();
        return back()->with(['delete' => "Стиль \"{$style->title}\" удален"]);
    }
}

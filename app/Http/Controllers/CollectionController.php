<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $collections = Collection::all();
        return view('control.collection.index', compact('collections'));
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
     * @param  \App\Http\Requests\StoreCollectionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCollectionRequest $request)
    {
        $validated = $request->validated();
        $validated['alias'] = $validated['title'];

        Collection::create($validated);
        return back()->with(['created' => "Коллекция \"{$request->title}\" успешно добавлена"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Collection $collection)
    {
        return back()->with(["edit-{$collection->id}" => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCollectionRequest  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $request->merge(['title' => $request->input('title-update')]);
        $collection->update($request->all());
        return back()->with(['updated' => "Наименование коллекции успешно изменено"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return back()->with(['delete' => "Коллекция \"{$collection->title}\" удалена"]);
    }
}

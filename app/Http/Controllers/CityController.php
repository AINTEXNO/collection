<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cities = City::all();
        return view('control.city.index', compact('cities'));
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
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCityRequest $request)
    {
        $validated = $request->validated();
        $validated['alias'] = $validated['title'];

        City::create($validated);
        return back()->with(['created' => "Город \"{$request->title}\" успешно добавлен"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(City $city)
    {
        return back()->with(["edit-{$city->id}" => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $request->merge(['title' => $request->input('title-update')]);
        $city->update($request->all());
        return back()->with(['updated' => "Наименование города успешно изменено"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();
        return back()->with(['delete' => "Город \"{$city->title}\" удален"]);
    }
}

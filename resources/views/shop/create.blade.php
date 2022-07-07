@extends('layouts.base')

@section('title') Добавление магазина @endsection

@section('content')
    @include('parts.header')

    {{--breadcrumbs--}}

    <section class="w-full flex justify-center">
        <div class="container">
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                            <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Главная
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('account.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Аккаунт</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.control') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Управление контентом</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('shops.all') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Магазины</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Добавить магазин</span>
                        </div>
                    </li>
                </ol>
            </nav>

        </div>
    </section>

    {{--/breadcrumbs--}}

    <section class="w-full h-[calc(100vh-200px)] flex justify-center items-center">
        <div class="container">
            <form action="{{ route('shops.store') }}" method="POST" class="w-full flex flex-col items-start">
                @csrf
                <div class="w-full flex justify-center items-start box-border">

                    {{--first form--}}

                    <div class="w-1/2 border border-gray-150 rounded-sm box-border py-5 px-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Данные магазина</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="title" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Наименование <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="title" id="title" class="@error('title') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Наименование магазина" value="{{ old('title') }}">
                                    @error('title')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="address" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Адрес <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="address" id="address" class="@error('address') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Адрес магазина" value="{{ old('address') }}">
                                    @error('address')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="schedule" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">График <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="schedule" id="schedule" class="@error('schedule') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Адрес магазина" value="{{ old('schedule') }}">
                                    @error('schedule')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="phone_number" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Номер телефона <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="phone_number" id="phone_number" class="@error('phone_number') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Номер телефона" value="{{ old('phone_number') }}">
                                    @error('phone_number')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="city_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Город <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="city_id" id="city_id" class="@error('city_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите город</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@extends('layouts.base')

@section('title') Добавление акции @endsection

@section('content')
    @include('parts.header')

    {{--breadcrumbs--}}

    <section class="w-full justify-center">
        <div class="container">
            <nav class="flex mt-4 mb-4" aria-label="Breadcrumb">
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
                            <a href="{{ route('admin.promotions') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Акции</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Добавление акции</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{--/breadcrumbs--}}

    <section class="w-full h-[calc(100vh-200px)] flex justify-center items-center">
        <div class="container">
            <form action="{{ route('promotions.store') }}" method="POST" class="w-full flex flex-col items-start" enctype="multipart/form-data">
                @csrf
                @if(session()->has('created'))
                    <div class="w-full p-4 mb-4 text-sm text-blue-700 font-normal bg-blue-100 rounded-lg" role="alert">
                        <span class="font-normal">Новая акция успешно добавлена</span>
                    </div>
                @endif
                <div class="w-full flex items-start box-border">

                    {{--first form--}}

                    <div class="w-1/2 border border-gray-150 rounded-sm box-border py-5 px-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Данные акции</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="title" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Наименование <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="title" id="title" class="@error('title') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Наименование акции" value="{{ old('title') }}">
                                    @error('title')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="image" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Фотография <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="file" name="image" id="image" class="@error('image') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Фотография акции" value="{{ old('image') }}">
                                    @error('image')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="description" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Описание <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <textarea name="description" id="description" class="@error('description') border-red-400 @enderror resize-none w-full h-32 border box-border py-1.5 px-3 mt-1 rounded-sm" placeholder="Описание акции">{{ old('description') }}</textarea>
                                    @error('description')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--second form--}}

                    <div class="w-1/2 border border-gray-150 rounded-sm box-border py-5 px-6 ml-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Продолжительность акции</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="start_date" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Начало акции <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="date" name="start_date" id="start_date" class="@error('start_date') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Дата начала акции" value="{{ old('start_date') }}">
                                    @error('start_date')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="end_date" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Окончание акции <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="date" name="end_date" id="end_date" class="@error('end_date') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Наименование товара" value="{{ old('end_date') }}">
                                    @error('end_date')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="discount" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Скидка</label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="number" name="discount" id="discount" min="1" max="100" step="1" class="@error('discount') border-red-400 @enderror w-1/2 border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Скидка" value="{{ old('discount') }}">
                                    @error('discount')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex flex-col items-start">
                               <span class="flex items-center">
                                    <input type="checkbox" name="status" value="1" class="mr-5">
                                    Опубликовать после создания
                                </span>
                                @error('status')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Добавить акцию</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

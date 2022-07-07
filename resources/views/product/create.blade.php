@extends('layouts.base')

@section('title') Добавление товара @endsection

@section('content')
    @include('parts.header')

    {{--breadcrumbs--}}

    <section class="w-full justify-center">
        <div class="container">
            <nav class="flex mb-4" aria-label="Breadcrumb">
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
                            <a href="{{ route('admin.products') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Товары</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Добавить товар</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{--/breadcrumbs--}}

    <section class="w-full h-[calc(100vh-200px)] flex justify-center items-center">
        <div class="container">
            <form action="{{ route('product.store') }}" method="POST" class="w-full flex flex-col items-start" enctype="multipart/form-data">
                @csrf
                @if(session()->has('created'))
                    <div class="w-full p-4 mb-4 text-sm text-blue-700 font-normal bg-blue-100 rounded-lg" role="alert">
                        <span class="font-normal">Новый товар успешно добавлен</span>
                    </div>
                @endif
                <div class="w-full flex items-start box-border">

                    {{--first form--}}

                    <div class="w-1/2 border border-gray-150 rounded-sm box-border py-5 px-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Данные товара</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="category_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Категория <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="category_id" id="category_id" class="@error('category_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите категорию</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="title" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Наименование <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="text" name="title" id="title" class="@error('title') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Наименование товара" value="{{ old('title') }}">
                                    @error('title')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="image" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Фотография <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="file" name="image" id="image" class="@error('image') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Наименование товара" value="{{ old('image') }}">
                                    @error('image')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="description" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Описание <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                <textarea name="description" id="description" class="@error('description') border-red-400 @enderror resize-none w-full h-20 border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Описание товара">{{ old('description') }}</textarea>
                                    @error('description')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="price" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Стоимость <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="number" name="price" id="price" min="1" step="0.01" class="@error('price') border-red-400 @enderror w-1/2 border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Стоимость" value="{{ old('price') }}">
                                    @error('price')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="count" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Количество <span class="font-medium text-red-500">*</span></label>
                                <div class="w-full flex flex-col items-start">
                                    <input type="number" name="count" id="count" min="1" class="@error('count') border-red-400 @enderror w-1/2 border py-1.5 px-3 mt-1 text-base rounded-sm" placeholder="Количество" value="{{ old('count') }}">
                                    @error('count')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--second form--}}

                    <div class="w-1/2 border border-gray-150 rounded-sm box-border py-5 px-6 ml-6">
                        <div class="w-full border-b border-gray-200 mt-3 mb-6">
                            <h2 class="text-lg text-gray-600 mb-2">Данные продавца</h2>
                        </div>
                        <div class="w-full flex flex-col items-start">
                            <div class="w-full flex mb-3">
                                <label for="collection_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Коллекция</label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="collection_id" id="collection_id" class="@error('collection_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите коллекцию</option>
                                        @foreach($collections as $collection)
                                            <option value="{{ $collection->id }}">{{ $collection->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('collection_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="style_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Стиль</label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="style_id" id="style_id" class="@error('style_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите стиль</option>
                                        @foreach($styles as $style)
                                            <option value="{{ $style->id }}">{{ $style->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('style_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="brand_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Бренд</label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="brand_id" id="brand_id" class="@error('brand_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите бренд</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex mb-3">
                                <label for="color_id" class="w-52 text-md font-normal text-gray-700 text-nowrap mr-5 flex items-center">Цвет</label>
                                <div class="w-full flex flex-col items-start">
                                    <select name="color_id" id="color_id" class="@error('color_id') border-red-400 @enderror w-full border py-1.5 px-3 mt-1 text-base rounded-sm">
                                        <option disabled selected>Выберите цвет</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')<p class="text-base text-red-400 my-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-600 rounded-full uppercase text-black mt-7">Добавить товар</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

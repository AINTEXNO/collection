@extends('layouts.base')

@section('title') Каталог @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-10" id="filters">
        <div class="container flex flex-start items-start">
            <div class="w-1/5 flex flex-col" id="accordion-menu">
                <ul class="w-full flex flex-col border rounded pb-2.5">
                    <li class="w-full py-3 px-5 bg-gray-200 text-sm text-gray-600 uppercase font-medium">
                        Категории
                    </li>
                    <li class="px-4 py-1 flex flex-col mt-2">
                        <p class="w-full cursor-pointer text-base pb-1">Акции</p>
                        <ul class="w-full">
                            @foreach($promotions as $promotion)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="promotion" value="{{ $promotion->id }}" class="mr-2" id="category-{{ $promotion->id }}" data-alias="{{ $promotion->alias }}">
                                    <label for="category-{{ $promotion->id }}" class="filter-title whitespace-nowrap overflow-hidden text-ellipsis"> {{ $promotion->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="px-4 py-1 flex flex-col mt-2">
                        <p class="w-full filter-item cursor-pointer text-base pb-1">Категория</p>
                        <ul class="w-full px-3 filter-list">
                            @foreach($categories as $category)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="category" value="{{ $category->id }}" class="mr-2" id="category-{{ $category->id }}" data-alias="{{ $category->alias }}">
                                    <label for="category-{{ $category->id }}" class="filter-title"> {{ $category->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="px-4 py-1 flex flex-col">
                        <p class="w-full filter-item cursor-pointer text-base pb-1">Бренд</p>
                        <ul class="w-full px-3 filter-list">
                            @foreach($brands as $brand)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="brand" value="{{ $brand->id }}" class="mr-2 mb-px" id="brand-{{ $brand->id }}" data-alias="{{ $brand->alias }}">
                                    <label for="brand-{{ $brand->id }}" class="filter-title"> {{ $brand->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="px-4 py-1 flex flex-col">
                        <p class="w-full filter-item cursor-pointer text-base pb-1">Стиль</p>
                        <ul class="w-full px-3 filter-list">
                            @foreach($styles as $style)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="style" value="{{ $style->id }}" class="mr-2 mb-px" id="style-{{ $style->id }}" data-alias="{{ $style->alias }}">
                                    <label for="style-{{ $style->id }}" class="filter-title"> {{ $style->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="px-4 py-1 flex flex-col">
                        <p class="w-full filter-item cursor-pointer text-base pb-1">Коллекция</p>
                        <ul class="w-full px-3 filter-list">
                            @foreach($collections as $collection)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="collection" value="{{ $collection->id }}"
                                           class="mr-2 mb-px" id="collection-{{ $collection->id }}" data-alias="{{ $collection->alias}}">
                                    <label for="collection-{{ $collection->id }}" class="filter-title"> {{ $collection->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="px-4 py-1 flex flex-col">
                        <p class="w-full filter-item cursor-pointer text-base pb-1">Цвет</p>
                        <ul class="w-full px-3 filter-list">
                            @foreach($colors as $color)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="color" value="{{ $color->id }}" class="mr-2 mb-px" id="color-{{ $color->id }}" data-alias="{{ $color->alias }}">
                                    <label for="color-{{ $color->id }}" class="filter-title"> {{ $color->title }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="w-full flex flex-col border rounded mt-5 pb-2.5">
                    <li class="w-full py-3 px-5 bg-gray-200 text-sm text-gray-600 uppercase font-medium">
                        Фильтры
                    </li>
                    <li class="w-full flex flex-col px-4 py-2">
                        <p class="text-sm font-medium my-2">Стоимость</p>
                        <ul class="w-full">
                            <li class="w-full text-sm flex items-center">
                                <input type="checkbox" name="price" value="1" class="mr-2 mb-px" id="price-1" data-id="2" data-alias="{{ $prices->min }}-990">
                                <label for="price-1" class="filter-title">{{ $prices->min }}-990</label>
                            </li>
                            <li class="w-full text-sm mt-2 flex items-center">
                                <input type="checkbox" name="price" value="2" class="mr-2 mb-px" id="price-1" data-id="2" data-alias="990-1990">
                                <label for="price-1" class="filter-title">990-1990</label>
                            </li>
                            @if($prices->max > 1990)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="price" value="3" class="mr-2 mb-px" id="price-1" data-id="3" data-alias="1990-2990">
                                    <label for="price-1" class="filter-title">1990-2990</label>
                                </li>
                            @elseif($prices->max > 2990)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="price" value="4" class="mr-2 mb-px" id="price-1" data-id="4" data-alias="2990-3990">
                                    <label for="price-1" class="filter-title">2990-3990</label>
                                </li>
                            @elseif($prices->max > 3990)
                                <li class="w-full text-sm mt-2 flex items-center">
                                    <input type="checkbox" name="price" value="4" class="mr-2 mb-px" id="price-1" data-id="4" data-alias="3990-{{ $prices->max }}">
                                    <label for="price-1" class="filter-title">3990-{{ $prices->max }}</label>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="w-4/5 ml-10 flex flex-col items-start">
                <div class="w-full grid grid-cols-4 gap-8" id="products-list"></div>
            </div>
        </div>
    </section>
    @include('parts.footer')
    <script type="module" src="{{ asset('js/filters/app.js') }}"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
@endsection



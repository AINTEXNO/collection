@extends('layouts.base')

@section('title') {{ $product->title }} @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-4" id="product">
        <div class="container flex flex-col items-start">

            {{--breadcrumbs--}}

            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('product.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                            Каталог
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">{{ $product->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <div class="w-full flex justify-start items-start">
                <div class="w-2/6 h-[calc(460px)] bg-gray-100 flex justify-center rounded-sm items-center relative">
                    <img src="/public/storage/{{ $product->photo }}" alt="{{ $product->title }}" class="w-3/4">
                    @if($product->promotions()->whereStatus(1)->count())
                        <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                    @endif
                    @if($product->discount)
                        <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-{{ $product->discount }}%</span>
                    @endif
                </div>
                <div class="w-4/6 flex-col items-start ml-10">
                    <h2 class="text-2xl font-medium">{{ $product->title }}</h2>
                    <div class="w-full flex items-center my-3 mb-5">
                        <div class="flex items-center">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 {{ $i < $rating ? 'text-yellow-300' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-md font-normal ml-2 text-gray-600">{{ $product->reviews->count() }} отзыв</p>
                    </div>
                    <div class="w-1/2 border-t border-b border-gray-100 py-4">
                        <ul class="w-full flex flex-col items-start">
                            <li class="w-full flex items-center mb-2">
                                <p class="text-base font-medium mr-4">Категория: </p>
                                <p class="text-base">{{ $product->category->title ?? 'Не указано' }}</p>
                            </li>
                            <li class="w-full flex items-center mb-2">
                                <p class="text-base font-medium mr-4">Коллекция: </p>
                                <p class="text-base">{{ $product->collection->title ?? 'Не указано' }}</p>
                            </li>
                            <li class="w-full flex items-center mb-2">
                                <p class="text-base font-medium mr-4">Бренд: </p>
                                <p class="text-base">{{ $product->brand->title ?? 'Не указано' }}</p>
                            </li>
                            <li class="w-full flex items-center mb-2">
                                <p class="text-base font-medium mr-4">Стиль: </p>
                                <p class="text-base">{{ $product->style->title ?? 'Не указано' }}</p>
                            </li>
                            <li class="w-full flex items-center mb-2">
                                <p class="text-base font-medium mr-4">Цвет: </p>
                                <p class="text-base">{{ $product->color->title ?? 'Не указано' }}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        @if($product->count)
                            @if($product->discount)
                                <div class="flex items-end">
                                    <p class="text-lg font-medium mr-4">
                                        {{ round($product->currentPrice) }}
                                        &#8381;
                                    </p>
                                    <p class="text-base text-gray-400 line-through mb-px">
                                        {{ $product->price }} &#8381;
                                    </p>
                                </div>
                            @else
                                <p class="text-lg font-medium">{{ $product->price }} &#8381;</p>
                            @endif
                        @else
                            <p class="text-lg font-medium">Нет в наличии <span class="text-sm font-normal text-gray-400">({{ $product->price }} &#8381;)</span></p>
                        @endif
                    </div>
                    <p class="text-sm text-gray-400 mt-1">Включая налог НДС</p>
                    @if($product->count)
                    <div class="w-full flex items-center mt-7">
                        <div class="w-12 h-12 flex justify-center items-center border border-2 border-gray-100 rounded-md fill-gray-300 mr-4 cursor-pointer duration-200" id="add-to-favorites" data-id="{{ $product->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="cursor-pointer duration-200" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </div>
                        <input type="number" min="1" step="1" max="{{ $product->count }}" id="counter" class="w-24 h-12 box-border px-4 border border-gray-100 rounded" value="1">
                        <button type="submit" data-price="{{ $product->getOriginal('price') }}" data-id="{{ $product->id }}" class="px-6 py-3 text-sm bg-stone-800 rounded-full uppercase text-white ml-7" id="add-button">Добавить в корзину</button>
                    </div>
                    @endif
                </div>
            </div>
            <ul class="w-full flex flex-wrap text-center text-gray-400 border-b border-gray-100 mt-10" id="tabs">
                <li class="mr-2 tab-element tab-element--active" data-tab="#tab-1">
                    <p class="inline-block text-base p-4 rounded-t-md">Описание</p>
                </li>
                <li class="mr-2 tab-element" data-tab="#tab-2">
                    <p class="inline-block text-base p-4 rounded-t-md">Отзывы</p>
                </li>
            </ul>
            <div class="w-full flex-col items-start mt-4 mb-10 tab-item active-tab" id="tab-1">
                <h4 class="text-lg font-normal">Описание товара</h4>
                <p class="text-base text-gray-600 mt-2 text-justify">
                    {{ $product->description }}
                </p>
            </div>
            <div class="w-full flex-col items-start mt-4 tab-item mb-10" id="tab-2">
                <h4 class="text-lg font-normal">Отзывы о товаре</h4>
                <div class="flex items-start mt-4" id="reviews-section" data-product="{{ $product->id }}">
                    <div class="w-2/3 flex flex-col items-start rounded-md mr-24">
                        <div class="w-full flex flex-col">
                            <div class="w-full" id="reviews-list">
                                {{--reviews--}}
                            </div>
                            <div class="w-full flex justify-center mt-4">
                                <a href="#" class="px-5 py-1.5 bg-white border border-indigo-600 text-indigo-500 rounded-full hover:bg-indigo-600 hover:text-white duration-300" data-progress="1" id="progress-button">Показать еще</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 flex flex-col">
                        <div class="w-full" id="review-stats">
                            {{--reviews statistics--}}
                        </div>
                        @auth
                            @if($hasProductInUserOrders)
                                <div class="mt-8">
                                    <button class="px-5 py-1.5 bg-indigo-500 border border-indigo-600 text-white rounded-full" id="open-modal">
                                        Оставить отзыв
                                    </button>
                                </div>
                            @endif
                        @endauth

                        @auth
                        <div class="modal" id="review-modal">
                            <form action="" class="modal__form mt-4" id="create-review">
                                <h2 class="text-gray-600 text-lg mb-4">Добавить отзыв</h2>
                                <div class="w-full rounded-sm box-border">
                                    <div class="flex items-center mt-3" id="rating-select">
                                        <svg class="rating-star w-5 h-5 text-gray-300" data-rating="1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="rating-star w-5 h-5 text-gray-300" data-rating="2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="rating-star w-5 h-5 text-gray-300" data-rating="3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="rating-star w-5 h-5 text-gray-300" data-rating="4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg class="rating-star w-5 h-5 text-gray-300" data-rating="5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>
                                    <div class="w-full flex flex-col">
                                        <div class="w-full flex flex-col items-start mt-3">
                                            <textarea name="text" id="review-text" class="resize-none border-gray-100 w-full h-28 border py-1.5 px-3 text-base rounded-md comments-field" placeholder="Ваш отзыв"></textarea>
                                            <p class="text-base text-red-400 my-2 hidden"></p>
                                        </div>
                                    </div>
                                    <div class="w-full flex justify-end">
                                        <button type="submit" class="px-6 py-2.5 text-sm bg-indigo-600 text-white rounded-full text-black mt-7 button-disabled" id="create-review-btn">Добавить</button>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" id="product-id" class="comments-field" value="{{ $product->id }}">
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
            @if($similarProducts->count())
            <section class="w-full flex justify-center mt-2 mb-10">
                <div class="container flex flex-col items-start">
                    <h2 class="text-xl text-gray-900">Похожие товары</h2>
                    <div class="w-full grid grid-cols-4 gap-8 mt-6">
                        @foreach($similarProducts as $similarProduct)
                            <article class="flex flex-col relative">
                                <a href="{{ route('product.show', ['product' => $similarProduct->id]) }}" class="h-72 bg-gray-100 flex justify-center items-center">
                                    <img src="/public/storage/{{ $similarProduct->photo }}" alt="{{ $similarProduct->title }}" class="w-3/4">
                                </a>
                                <h2 class="text-lg mt-2">{{ $similarProduct->title }}</h2>
                                @if($similarProduct->discount)
                                    <div class="flex items-end">
                                        <p class="text-lg font-medium mr-4">
                                            {{ $similarProduct->currentPrice }}
                                            &#8381;
                                        </p>
                                        <p class="text-base text-gray-400 line-through mb-px">
                                            {{ $similarProduct->price }} &#8381;
                                        </p>
                                    </div>
                                    <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-{{ $similarProduct->discount }}%</span>
                                @else
                                    <p class="text-lg font-medium">{{ $similarProduct->price }} &#8381;</p>
                                @endif
                                <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                            </article>
                        @endforeach
                    </div>
                    <div class="w-full flex justify-end mt-10">
                        <a href="{{ route('product.index', ['category' => $product->category->alias]) }}" class="px-5 py-1.5 bg-white border border-indigo-600 text-indigo-500 rounded-full hover:bg-indigo-600 hover:text-white duration-300">Больше товаров</a>
                    </div>
                </div>
            </section>
            @endif
            @include('parts.footer')
            <div class="cart-info">
                <input type="hidden" name="id" class="cart-info__input" value="{{ $product->id }}">
                <input type="hidden" name="title" class="cart-info__input" value="{{ $product->title }}">
                <input type="hidden" name="category" class="cart-info__input" value="{{ $product->category->title }}">
                <input type="hidden" name="price" class="cart-info__input" value="{{ $product->getOriginal('price') }}">
                <input type="hidden" name="count" class="cart-info__input" value="{{ $product->count }}">
                <input type="hidden" name="photo" class="cart-info__input" value="{{ $product->photo }}">
                <input type="hidden" name="description" class="cart-info__input" value="{{ $product->description }}">
                @if($product->discount)
                    <input type="hidden" name="discount" class="cart-info__input" value="{{ $product->discount }}">
                    <input type="hidden" name="current" class="cart-info__input" value="{{ round($product->currentPrice) }}">
                @endif
            </div>
        </div>
    </section>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/add-to-favorites.js') }}"></script>
    <script src="{{ asset('js/tabs.js') }}"></script>
    <script type="module" src="{{ asset('js/rating-select.js') }}"></script>
    <script type="module" src="{{ asset('js/reviews/create.js') }}"></script>
    <script type="module" src="{{ asset('js/reviews/reviews-handler.js') }}"></script>
@endsection

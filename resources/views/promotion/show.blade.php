@extends('layouts.base')

@section('title') {{ $promotion->title }} @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container flex flex-col">
            <div class="w-full flex flex-start items-start">
                <div class="w-full flex flex-col">
                    <article class="w-full flex flex-col border border-gray-100 rounded-md overflow-hidden">
                        <div class="w-full h-96 overflow-hidden relative">
                            <img src="/public/storage/{{ $promotion->photo }}" alt="{{ $promotion->title }}" class="w-full object-cover absolute -top-20 right-0">
                        </div>
                        <div class="w-full box-border p-5 flex flex-col items-start">
                            <h2 class="text-xl">{{ $promotion->title }}</h2>
                            <div class="flex items-center text-base text-gray-500 mt-2">
                                <p class="text-gray-400">во всех магазинах {{ $promotion->duration }}</p>
                            </div>
                            <div class="h-full flex flex-col justify-between">
                                <p class="text-base text-gray-400 mt-4 post-text text-justify">
                                    {!! nl2br($promotion->description) !!}
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full flex justify-center mt-8 mb-16">
        <div class="container flex flex-col items-start">
            <h2 class="text-xl text-gray-900">Товары в акции</h2>
            <div class="w-full grid grid-cols-4 gap-8 mt-6">
                @foreach($products as $product)
                    <article class="flex flex-col relative">
                        <a href="{{ route('product.show', ['product' => $product->id]) }}" class="h-72 bg-gray-100 flex justify-center items-center">
                            <img src="/public/storage/{{ $product->photo }}" alt="{{ $product->title }}" class="w-3/4">
                        </a>
                        <h2 class="text-lg mt-2">{{ $product->title }}</h2>
                        @if($product->discount)
                            <div class="flex items-end">
                                <p class="text-lg font-medium mr-4">
                                    {{ $product->currentPrice }}
                                    &#8381;
                                </p>
                                <p class="text-base text-gray-400 line-through mb-px">
                                    {{ $product->price }} &#8381;
                                </p>
                            </div>
                            <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-{{ $product->discount }}%</span>
                        @else
                            <p class="text-lg font-medium">{{ $product->price }} &#8381;</p>
                        @endif
                        <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                    </article>
                @endforeach
            </div>
            <div class="w-full flex justify-end mt-10">
                <a href="/product?promotion={{ $promotion->alias }}" class="px-5 py-1.5 bg-white border border-indigo-600 text-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white duration-300">Все товары в акции</a>
            </div>
        </div>
    </section>
    @include('parts.footer')
@endsection

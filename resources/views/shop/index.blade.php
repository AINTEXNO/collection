@extends('layouts.base')

@section('title') Магазины @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8" id="shops">
        <div class="container flex flex-col">
            <h2 class="text-xl text-gray-900">Магазины</h2>
            <div class="w-full flex justify-between items-start mt-8">
                <div class="w-1/3 border border-gray-100 rounded-sm mr-6 p-10">
                    <h2 class="text-gray-900 text-lg">Поиск магазинов</h2>
                    <input type="text" class="w-full py-2.5 rounded-sm border border-gray-200 px-4 mt-3" placeholder="Введите название города" id="shops-input">
                </div>
                <div class="w-2/3 flex flex-col items-center" id="shops-list">
                    @foreach($shops as $shop)
                        <div class="w-full flex justify-start items-start border border-gray-100 p-6 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="mr-6" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                            <div class="flex flex-col">
                                <h3 class="text-gray-900 text-lg font-medium">{{ $shop->title }}</h3>
                                <p class="text-gray-500 text-base">{{ $shop->address }}</p>
                                <p class="text-gray-400 text-sm mt-3">{{ $shop->schedule }}</p>
                                <p class="text-gray-500 text-sm mt-px">{{ $shop->phone_number }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script type="module" src="{{ asset('js/shops.js') }}"></script>
@endsection

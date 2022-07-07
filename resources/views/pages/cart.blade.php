@extends('layouts.base')

@section('title') Корзина @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex flex-col items-center">
        <div class="w-full flex justify-center" id="cart-item">
            <div class="w-full container">
                <div class="w-full flex my-10 mt-8">
                    <div class="w-4/5 bg-white">
                        <div class="flex justify-between border-b pb-8">
                            <h2 class="text-xl text-gray-900">Корзина</h2>
                        </div>
                        <div class="w-full flex mt-10 mb-5">
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-2/6">Товары</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/6 text-center">Количество</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/6 text-center">Стоимость</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/6 text-center">Итоговая стоимость</h3>
                            <div class="w-1/6"></div>
                        </div>

                        <div class="d-flex flex-direction-column" id="product-items"></div>
                    </div>

                    <div id="summary" class="w-1/4 pl-10"></div>

                </div>
            </div>
        </div>
    </section>
    <script type="module" src="{{ asset('js/cart.js') }}"></script>
@endsection



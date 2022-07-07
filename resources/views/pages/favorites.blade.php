@extends('layouts.base')

@section('title') Избранное @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container flex flex-col">
            <h2 class="text-xl text-gray-900">Избранное</h2>
            <div class="w-full flex flex-start items-start mt-8">
                <div class="w-full flex justify-between flex-wrap" id="favorites-items">
                    {{--favorites--}}
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/favorites.js') }}"></script>
@endsection

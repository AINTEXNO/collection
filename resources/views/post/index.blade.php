@extends('layouts.base')

@section('title') Новости @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8 mb-10">
        <div class="container flex flex-col">
            <h2 class="text-xl text-gray-900">Новости</h2>
            <div class="w-full flex flex-start items-start mt-8">
                <div class="w-full grid grid-cols-2 gap-10">
                    @foreach($posts as $post)
                    <article class="flex flex-col border border-gray-100 rounded-md overflow-hidden">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="w-full h-80 overflow-hidden post-img">
                            <img src="/public/storage/{{ $post->photo }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-110 duration-300">
                        </a>
                        <div class="w-full box-border p-5 flex flex-col items-start">
                            <h2 class="text-lg">{{ $post->title }}</h2>
                            <div class="flex items-center text-base text-gray-500 mt-1">
                                <p>{{ $post->created }}</p>
                                <span class="h-5 w-px bg-gray-300 mx-3"></span>
                                <p>{{ $post->comments->count() }} комментариев</p>
                            </div>
                            <div class="h-full flex flex-col justify-between">
                                <p class="text-base text-gray-400 mt-3 text-justify t-overflow-lg overflow-hidden post-text">{{ $post->text }}</p>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

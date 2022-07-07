@extends('layouts.base')

@section('title') Комментарии @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center mt-8">
        <div class="container flex flex-col">

            {{--breadcrumbs--}}

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
                            <a href="{{ route('admin.posts') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Новости</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Комментарии</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <div class="w-full">
                <h2 class="text-xl text-gray-900">Комментарии</h2>
                <p class="text-base text-gray-500">к новости "{{ $post->title }}"</p>
            </div>
            @if(session()->has('delete'))
                <div class="p-4 mb-4 text-sm text-red-600 mt-4 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">Комментарий к новости удален</span>
                </div>
            @endif
            <div class="w-full mt-10">
                <div class="w-3/4 flex flex-col items-start" id="comments-list">
                    @foreach($comments as $comment)
                        <div class="w-full flex justify-start mb-10">
                            <img src="/public/storage/{{ $comment->user->photo }}" alt="{{ $comment->user->name }}" class="post-img-sm rounded-full overflow-hidden object-cover">
                            <div class="w-full flex-col items-start ml-6">
                                <div class="w-full flex justify-between items-center">
                                    <h3 class="text-base">{{ $comment->user->name }} {{ $comment->user->surname }}</h3>
                                    <div class="text-base text-gray-400 flex items-center relative">
                                        @auth
                                            @can('is-admin')
                                                <form action="{{ route('comment.delete', ['comment' => $comment->id]) }}" method="POST" class="mt-1" onsubmit="confirmation(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill mr-3 hover:fill-red-500 cursor-pointer duration-200" data-id="{{ $comment->id }}" id="delete-comment-btn" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        @endauth
                                        {{ $comment->created }}
                                    </div>
                                </div>
                                <p class="text-base text-gray-500 text-justify mt-1">{{ $comment->text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection

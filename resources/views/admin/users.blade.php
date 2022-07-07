@extends('layouts.base')

@section('title') Пользователи @endsection

@section('content')
    @include('parts.header')
    <section class="w-full flex justify-center">
        <div class="container">

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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" stroke-width="1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Пользователи</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{--/breadcrumbs--}}

            <h2 class="text-xl text-gray-900">Пользователи</h2>
            @if(session()->has('blocked'))
                <div class="p-4 text-sm text-red-600 bg-red-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('blocked') }}</span>
                </div>
            @endif
            @if(session()->has('unlocked'))
                <div class="w-full p-4 text-sm text-green-700 bg-green-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('unlocked') }}</span>
                </div>
            @endif
            @if(session()->has('updated'))
                <div class="w-full p-4 text-sm text-green-700 bg-green-100 rounded-lg mt-4" role="alert">
                    <span class="font-medium">{{ session()->get('updated') }}</span>
                </div>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">
                            Имя
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Должность
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Статус
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата регистрации
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <img src="/public/storage/{{ $user->photo ?? 'undefined.png' }}" alt="{{ $user->full_name }}" class="w-10 h-10 rounded-full object-cover">
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.role.update', ['user' => $user->id]) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <select name="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-1.5 mr-5">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id === $user->role_id) selected @endif>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="focus:outline-none text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-md text-sm px-3 py-1.5">Изменить</button>
                            </form>
                        </td>
                        <td class="px-6">
                            <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if($user->blocked)
                                    <button type="submit" name="status" value="0" class="focus:outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-md text-sm px-3 py-1.5
                                        @if($user->id === auth()->id()) pointer-events-none opacity-80 @endif">Заблокирован</button>
                                @else
                                    <button type="submit" name="status" value="1" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-md text-sm px-3 py-1.5
                                        @if($user->id === auth()->id()) pointer-events-none opacity-80 @endif">Активен</button>
                                @endif
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->created }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/confirmation.js') }}"></script>
@endsection

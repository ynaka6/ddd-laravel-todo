@extends('layouts.app')

@section('content')
<div>
    <div class="max-w-xl mx-auto">
        <form
            action="{{ route('task.store') }}"
            method="post"
            class="relative flex flex-col max-h-screen min-h-screen flex items-center bg-white shadow-2xl"
        >
            @csrf
            <div class="w-full flex justify-between items-center border-b">
                <a
                    href="{{ route('home') }}"
                    class="ml-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><path class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/></svg>
                </a>
                <h1 class="px-4 py-8 text-2xl lg:text-3xl">
                    {{ $viewModel->title() }}
                </h1>
                <div class="mr-2">
                    <button
                        type="submit"
                        class=""
                    >SUBMIT</button>
                </div>
            </div>
            <div class="w-full">
                <label class="hidden">{{ $viewModel->namePlaceholder() }}</label>
                <input
                    type="text"
                    name="title"
                    class="appearance-none bg-transparent border-none w-full text-gray-800 p-6 focus:outline-none"
                    placeholder="{{ $viewModel->namePlaceholder() }}"
                    value=""
                >
            </div>
        </form>
    </div>
</div>
@endsection

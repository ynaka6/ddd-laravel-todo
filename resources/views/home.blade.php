@extends('layouts.app')

@section('content')
<div>
    <div class="absolute top-0 right-0 mt-2 mr-2 z-10 lg:mt-4 lg:mr-4">
        @auth
            <a
                href="{{ route('logout') }}"
                class="flex flex-col justify-center items-center hover:opacity-75"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
            >
                <div class="bg-red-500 rounded-full p-4 mb-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 471.2 471.2" width="16" height="16" class="fill-current">
                        <path d="M227.619,444.2h-122.9c-33.4,0-60.5-27.2-60.5-60.5V87.5c0-33.4,27.2-60.5,60.5-60.5h124.9c7.5,0,13.5-6,13.5-13.5    s-6-13.5-13.5-13.5h-124.9c-48.3,0-87.5,39.3-87.5,87.5v296.2c0,48.3,39.3,87.5,87.5,87.5h122.9c7.5,0,13.5-6,13.5-13.5    S235.019,444.2,227.619,444.2z"/>
                        <path d="M450.019,226.1l-85.8-85.8c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1l62.8,62.8h-273.9c-7.5,0-13.5,6-13.5,13.5    s6,13.5,13.5,13.5h273.9l-62.8,62.8c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.8-85.8    C455.319,239.9,455.319,231.3,450.019,226.1z"/>
                    </svg>
                </div>
                <span class="no-underline text-xs">{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        @endauth
    </div>
    <div class="max-w-xl mx-auto">
        <div class="relative flex flex-col max-h-screen min-h-screen flex items-center bg-white shadow-2xl">
            <div class="flex flex-grow overflow-y-auto w-full">
                <div class="w-full overflow-y-scroll">
                    <h1 class="ml-10 px-4 py-8 text-2xl lg:text-3xl">
                        {{ $selectedTaskList->name() }}
                    </h1>
                    @forelse($tasks as $task) 
                        <div class="flex flex-row items-center border-b h-16">
                            <div
                                x-data="
                                    {
                                        checked: {{ $task->isCompleteStr() }},
                                        url: '{{ route('task.change.state', [ $selectedTaskList->id(), $task->id(), $task->isComplete() ? 'rollback-complete' : 'complete' ]) }}'
                                    }
                                "
                                class="py-2 px-4"
                                @click="
                                    checked = !checked;
                                    location.href = url;
                                "
                            >
                                <svg
                                    x-show="checked"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    width="24"
                                    height="24"
                                    class="text-blue-500 fill-current"
                                >
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                                </svg>
                                <div
                                    x-show="!checked"
                                    class="border-2 border-gray-800 rounded-full h-6 w-6"
                                >
                                </div>
                            </div>
                            <div>
                                <p>{{ $task->title() }}<p>
                                @if ($task->detail())
                                    <p class="mt-2 text-xs text-gray-700">
                                        {{ $task->detail() ?? '' }}
                                    <p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col justify-center items-center mx-auto -my-16">
                            <p class="font-bold text-2xl mb-10">Not Found Your Task</p>
                            <img
                                src="{{ asset('img/svg/undraw_task_31wc.svg') }}"
                                alt="No Task"
                                class="w-64"
                            >
                        </div>
                    @endforelse
                </div>
            </div>
            <div
                x-data="
                    {
                        openForm: false,
                        openMenu: false,
                        openDetailForm: false,
                        openSetting: false
                    }
                "
                class="w-full"
            >
                <div class="w-full bg-gray-200 p-4">
                    <div class="flex justify-between">
                        <div>
                            <a
                                href="#"
                                @click="openMenu = true"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/></svg>
                            </a>
                        </div>
                        <div class="relative">
                            <a href="#"
                                class="absolute top-0 bg-gray-200 border-2 border-gray-800 p-1 text-lg text-gray-900 rounded-full shadow-2xl"
                                style="margin-top: -1rem; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);"
                                @click="openForm = true"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
                            </a>
                        </div>
                        <div>
                            <a
                                href="#"
                                @click="openSetting = true"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    x-show="openMenu"
                    class="absolute bottom-0 w-full bg-gray-300 rounded-t-lg"
                    @click.away="openMenu = false"
                >
                    <div class="w-full border-b border-gray-500 p-4">
                        <div class="font-semibold text-xs text-gray-700 mb-1">User Information</div>
                        <span>{{ $loginUser->email() }}</span>
                    </div>
                    <div class="w-full py-2">
                        @foreach($taskList as $list)
                            <div
                                class="p-4 pl-12 mr-2 {{ $list->isSelected() ? 'bg-red-200 font-semibold text-red-800 rounded-r-full' : '' }}"
                            >
                                {{ $list->name() }}
                            </div>
                        @endforeach
                    </div>
                    <div class="ml-12 w-auto border-b border-gray-500"></div>
                    <a
                        href="{{ route('list.new') }}"
                        class="w-full flex items-center p-4"
                    >
                        <div class="mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
                        </div>
                        <div>
                            Add New List
                        </div>
                    </a>
                </div>
                <div
                    x-show="openForm"
                    class="absolute bottom-0 w-full bg-gray-300 p-4 rounded-t-lg"
                    @click.away="openForm = false"
                >
                    <form action="{{ route('task.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="listId" value="{{ $selectedTaskList->id() }}">
                        <div class="py-2">
                            <div class="mb-2">
                                <label class="px-4 font-semibold text-xs text-gray-700">Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    class="appearance-none bg-transparent border-none w-full text-gray-800 py-2 px-4 focus+outline-none"
                                    placeholder="New Task"
                                >
                            </div>
                            <div
                                x-show="openDetailForm"
                                class="mb-2"
                            >
                                <label class="px-4 font-semibold text-xs text-gray-700">Detail</label>
                                <input
                                    type="text"
                                    name="detail"
                                    class="appearance-none bg-transparent border-none w-full text-gray-800 py-2 px-4 focus+outline-none"
                                    placeholder="Add Detail"
                                >
                            </div>
                        </div>
                        <div class="flex justify-between pt-2">
                            <div class="flex-inline">
                                <a href="#" @click="openDetailForm = !openDetailForm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/></svg>
                                </a>
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    class=""
                                >SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    x-show="openSetting"
                    class="absolute bottom-0 w-full bg-gray-300 rounded-t-lg"
                    @click.away="openSetting = false"
                >
                    <a
                        href="{{ route('list.edit', [ $selectedTaskList->id() ]) }}"
                        class="w-full flex items-center p-4"
                    >
                        <div class="mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg>
                        </div>
                        <div>
                        Change List name
                        </div>
                    </a>
                    <a
                        href="{{ route('list.edit', [ $selectedTaskList->id() ]) }}"
                        class="w-full flex items-center p-4"
                    >
                        <div class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/></svg>
                        </div>
                        <div>
                            Delete completed tasks
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

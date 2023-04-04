<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach (auth()->user()->notifications as $notification)
                            @if ($notification['read_at'] == null)
                                <li class="p-2 my-1 rouned-sm sm:pb-4 bg-gray-100">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full"
                                                src="{{ url('https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . $notification['data']['name']) }}"
                                                alt="Neil image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate dark:text-white">
                                                {{ $notification['data']['name'] . __(' started to follow you') }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $notification['data']['email'] }}
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('markRead', ['id' => $notification->id]) }}"
                                                class="text-blue-500">Read</a>
                                            {{-- <a cl href="{{ route('markUnRead', ['id' => $notification->id]) }}"
                                                class="text-blue-500 ml-1">Unread</a> --}}
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="py-2 sm:pb-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full"
                                                src="{{ url('https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . $notification['data']['name']) }}"
                                                alt="Neil image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $notification['data']['name'] . __(' started to follow you') }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $notification['data']['email'] }}
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a cl href="{{ route('markUnRead', ['id' => $notification->id]) }}"
                                                class="text-blue-500 ml-1">Unread</a>

                                        </div>
                                    </div>
                                </li>
                            @endif
                            <hr>
                        @endforeach
                    </ul>
                    <br>
                    <a class="text-sm text-blue-400 underline" href="{{ route('readAll') }}">Mark all as read</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

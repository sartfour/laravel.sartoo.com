<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('sartoo - Top Ten Lists of Every Sort Imaginable') }}
        </h2>
    </x-slot>

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <table class="w-full text-md rounded mb-4">
            <thead>
            <tr class="border-b">
                <th class="text-left p-3 px-5">Recent Lists</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($recentLists as $list)
                <tr class="border-b hover:bg-yellow-100">
                    <td class="p-3 px-5">
                        {{$list->full_title}}
                    </td>
                </tr>
            @empty
                <tr class="border-b hover:bg-yellow-100">
                    <td class="p-3 px-5">
                        <i>No lists</i>
                    </td>
                    <td class="p-3 px-5">
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <table class="w-full text-md rounded mb-4">
            <thead>
            <tr class="border-b">
                <th class="text-left p-3 px-5">Recent Items</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($recentItems as $item)
                <tr class="border-b hover:bg-yellow-100">
                    <td class="p-3 px-5">
                        <a href="{{ route('items.show', [$item]) }}">{{$item->name}}</a>
                    </td>
                </tr>
            @empty
                <tr class="border-b hover:bg-yellow-100">
                    <td class="p-3 px-5">
                        <i>No items</i>
                    </td>
                    <td class="p-3 px-5">
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center">

            </div>
        </div>

        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>

</x-app-layout>
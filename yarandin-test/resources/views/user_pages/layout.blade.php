<x-app-layout :bodyClassName="$bodyClassName ?? ''">
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col overflow-y-auto">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Title List') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-teal-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="content" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('student-title')
            </div>
        </div>
    </div>
</x-app-layout>
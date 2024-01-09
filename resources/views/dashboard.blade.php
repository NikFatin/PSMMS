<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-teal-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(auth()->user()->role_id == 2)
                    @livewire('student-request')
                @elseif(auth()->user()->role_id == 3)
                    {{-- Content for supervisor role (role_id = 3) --}}
                    <p>Welcome, Supervisor! Here's your supervisor-specific content.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

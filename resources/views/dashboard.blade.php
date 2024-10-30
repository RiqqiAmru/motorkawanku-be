<x-applive-layout>
    {{-- see what role the user logged in --}}
    @if (Auth::user()->hasRole('admin'))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>
    @elseif (Auth::user()->hasRole('user'))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Dashboard') }}
            </h2>
        </x-slot>
    @endif

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->role == 'admin')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @livewire('AdminDashboard')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-applive-layout>

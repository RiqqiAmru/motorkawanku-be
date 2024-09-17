<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div x-data="{
                        tableItems: {{ $users }}
                    }" class="max-w-screen-xl mx-auto px-4 md:px-8">
                        <div class="items-start justify-between md:flex">
                            <div class="max-w-lg">
                                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-bold sm:text-2xl">Users
                                </h3>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <a href="javascript:void(0)"
                                    class="inline-block px-4 py-2 text-white duration-150 font-medium bg-indigo-600 rounded-lg hover:bg-indigo-500 active:bg-indigo-700 md:text-sm">Tambah
                                    User</a>
                            </div>
                        </div>
                        <div class="mt-12 relative h-max overflow-auto">
                            <table class="w-full table-auto text-sm text-left">
                                <thead class="text-gray-600 dark:text-gray-200 font-medium border-b">
                                    <tr>
                                        <th class="py-3 pr-6">nama</th>
                                        <th class="py-3 pr-6">email</th>
                                        <th class="py-3 pr-6">role</th>
                                        <th class="py-3 pr-6">terakhir login</th>
                                        <th class="py-3 pr-6"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 dark:text-gray-200 divide-y">
                                    <template x-for="(item, idx) in tableItems" :key="idx">
                                        <tr>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.name"></td>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.email"></td>
                                            <td class="pr-6 py-4 whitespace-nowrap">
                                                <span
                                                    :class="`px-3 py-2 rounded-full font-semibold text-xs ${item.status === 'Active' ? 'text-green-600 bg-green-50' : 'text-blue-600 bg-blue-50'}`"
                                                    x-text="item.role"></span>
                                            </td>
                                            <td class="pr-6 py-4 whitespace-nowrap" x-text="item.last_activity  ">
                                            </td>
                                            <td class="text-right whitespace-nowrap">
                                                <x-danger-button
                                                    x-on:click.prevent="$dispatch('open-modal', {name:'confirm-user-deletion', id :'kocak'})">{{ __('hapus') }}
                                                </x-danger-button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users.partials.modal-delete-user')

</x-app-layout>

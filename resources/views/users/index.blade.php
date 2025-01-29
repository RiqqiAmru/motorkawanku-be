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
                    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
                        <div class="items-start justify-between md:flex">
                            <div class="max-w-lg">
                                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-bold sm:text-2xl">Users
                                </h3>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <x-primary-button x-data=''
                                    x-on:click.prevent="$dispatch('open-modal',{name:'add-new-user'})">{{ __('Tambah User') }}</x-primary-button>
                            </div>
                        </div>
                        <div class="mt-12 relative h-max overflow-auto">
                            <table class="w-full table-auto text-sm text-left table" id="tableUsers">
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
                                    @foreach ($users as $u)
                                        <tr>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $u['name'] }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $u['email'] }}</td>
                                            <td class="pr-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-3 py-2 rounded-full font-semibold text-xs {{ $u['role'] === 'admin' ? 'text-green-600 bg-green-50' : 'text-blue-600 bg-blue-50' }}">{{ $u['role'] }}
                                                    @if ($u['role'] === 'user' && $u['kawasan_id'] !== '')
                                                        /
                                                        {{ $kawasan[$u['kawasan_id']] }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="pr-6 py-4 whitespace-nowrap">{{ $u['last_activity'] }}
                                            </td>
                                            <td class="text-right whitespace-nowrap">
                                                <x-secondary-button x-data=''
                                                    x-on:click.prevent="$dispatch('open-modal',{name:'edit-user',id:{{ $u }}})">
                                                    edit
                                                </x-secondary-button>
                                                @if ($u['role'] == 'user')
                                                    <x-danger-button x-data=''
                                                        x-on:click.prevent="$dispatch('open-modal', {name:'confirm-user-deletion', id :'{{ $u['id_user'] }}',email:'{{ $u['email'] }}'})">
                                                        {{ __('hapus') }}
                                                    </x-danger-button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
        /* Apply custom styles when dark mode is enabled */
        .dataTables_length select {
            background-color: red;
            /* Dark background for the dropdown */
            color: #fff;
            /* White text color */
            border: 1px solid #444;
            /* Dark border */
            background-image: none;
        }

        .dataTables_length select:focus {
            outline: none;
            /* Remove outline on focus */
            border-color: #666;
            /* Lighter border color on focus */
        }

        /* Optional: Add custom hover effect for dark mode */
        .dataTables_length select:hover {
            background-color: #444;
            /* Darker background on hover */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#tableUsers').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: true, // Enable sorting
                info: true, // Show table info
            });
        });
    </script> --}}



    @include('users.partials.modal-delete-user')
    @include('users.partials.modal-add-user')
    @include('users.partials.modal-edit-user')
    @include('components.alert')

</x-app-layout>

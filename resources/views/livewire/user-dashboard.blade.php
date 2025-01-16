<div>

    {{-- tabel investasi --}}
    <div>
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Data Investasi {{ $kawasan }} Tahun <span>{{ $tahun }}</span>
        </h3>

        {{-- tabel investasi --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table
                class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900 table"
                id="tableDashboard">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Kawasan
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                            RT/RW
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Kriteria
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                            Kegiatan
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Volume
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Sumber
                            Anggaran</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white"> Anggaran
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                            Penginput
                        </th>
                        <th></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    {{-- jika investasi kosong --}}
                    @if ($allInvestasi == null)
                    @else
                        {{-- ada investasi --}}
                        @foreach ($allInvestasi as $item)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ $item->kawasan }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $item->rtrw }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    <div class="relative">
                                        <span class="peer"
                                            aria-describedby="tooltipExample">{{ $item->idkriteria }}</span>
                                        <div id="tooltipExample"
                                            class="absolute -top-9 left-1/2 -translate-x-1/2 z-10 whitespace-nowrap rounded bg-neutral-950 px-2 py-1 text-center text-sm text-white opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 dark:bg-white dark:text-neutral-900"
                                            role="tooltip">Tooltip top</div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap text-wrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $item->kegiatan }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $item->volume }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $item->sumberAnggaran }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ Number::currency($item->anggaran, 'IDR', 'id') }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $item->name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 text center">
                                    <span
                                        class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                                        {{-- delete --}}
                                        <button
                                            class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                                            x-on:click.prevent="$dispatch('open-modal', {name:'confirm-investasi-deletion', id :'{{ $item->id_investasi }}'}) "
                                            title="Delete Investasi">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>



    {{-- modal confirm delete investasi --}}
    <x-modal name="confirm-investasi-deletion" focusable x-data="{
        init() {
            // Mendengarkan event dari Livewire
            Livewire.on('close', () => {
                $dispatch('close')
                console.log('ok')
            });
        }">
        <form wire:submit="destroy(id);$dispatch('close');" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('apakah kamu yakin menghapus Investasi ') }}<span x-text='id'></span>
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Data Investasi yang dihapus tidak dapat di kembalikan') }}
            </p>
            {{-- <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
    
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}" />
    
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div> --}}

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Investasi') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>



    @include('components.alert')

    <!-- DataTables CSS -->
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
            $('#tableDashboard').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: true, // Enable sorting
                info: true, // Show table info
            });
        });
    </script>

</div>

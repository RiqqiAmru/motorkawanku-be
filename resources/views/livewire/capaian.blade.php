<div>
    {{-- breadcumb --}}
    <nav aria-label="Breadcrumb">
        <ol class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-300">
            <li>
                <a href="#" class="block transition hover:text-gray-700 dark:hover:text-gray-200">
                    <span class="sr-only"> Home </span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
            </li>

            <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </li>

            <li>
                <select wire:model.live="idKawasanTerpilih"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="0">Kota Pekalongan</option>
                    @if ($kawasan)
                        @foreach ($kawasan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->kawasan }}</option>
                        @endforeach
                    @endif
                </select>
            </li>
        </ol>
    </nav>

    {{-- tabel --}}


    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-4">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Wilayah / RT</th>
                    @for ($i = 2023; $i <= $tahun; $i++)
                        <th colspan="3"
                            class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white border-l-2">
                            {{ $i == 2023 ? 'Baseline' : $i }}

                        </th>
                    @endfor
                </tr>
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white"></th>
                    @for ($i = 2023; $i <= $tahun; $i++)
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white border-l-2">
                            Nilai Kumuh
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white border-l-2">
                            tingkat Kumuh
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white border-l-2">
                            luasan
                        </th>
                    @endfor
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                @if ($namaKawasan)
                    <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                            {{ $namaKawasan['kawasan'] }}
                        </td>
                        @foreach ($kumuhKawasan as $item)
                            <td title="total Nilai"
                                class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ $item->totalNilai }}</td>
                            <td title="tingkat kekumuhan"
                                class="whitespace-nowrap px-4 py-2 text-center  {{ $item ? $item?->getWarnaAttribute()[1] : '' }}">
                                {{ $item ? $item->getWarnaAttribute()[0] : '' }}
                            </td>
                            <td title="luasan"
                                class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-r-2">
                                @if ($item->tahun == \Carbon\Carbon::now()->year)
                                    {{ Number::format($luasVerifikasiyangSudahBerkurang ?: 0, 2) }}
                                @else
                                    {{ Number::format($item->luasVerifikasi ?: 0, 2) }}
                                @endif
                                Ha
                            </td>
                        @endforeach
                    </tr>
                @else
                    <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                            {{ 'Kota Pekalongan' }}
                        </td>
                        @foreach ($kumuhKawasan as $item)
                            <td title="total Nilai"
                                class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ $item['totalNilai'] }}</td>
                            <td title="tingkat kekumuhan"
                                class="whitespace-nowrap px-4 py-2 text-center  {{ $item['tingkatKekumuhan'][1] }}">
                                {{ $item['tingkatKekumuhan'][0] }}
                            </td>
                            <td title="luasan"
                                class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-r-2">
                                {{ Number::format($item['totalLuasVerifikasi'] ?: 0, 2) }}
                                Ha
                            </td>
                        @endforeach
                    </tr>
                @endif
                <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                    </td>
                </tr>
                @if ($kumuhRT)
                    @foreach ($kumuhRT as $item)
                        <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                {{ $daftarRT[$item->first()->rt ? $item->first()->rt : $item->first()->kawasan] }}
                            </td>
                            @foreach ($item as $k)
                                <td title="total Nilai"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $k->totalNilai }}</td>
                                <td title="tingkat kekumuhan"
                                    class="whitespace-nowrap px-4 py-2 text-center  {{ $k ? $k?->getWarnaAttribute()[1] : '' }}">
                                    {{ $k ? $k->getWarnaAttribute()[0] : '' }}
                                </td>

                                <td title="luasan"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-r-2">

                                    {{ Number::format($k->tingkatKekumuhan == 'TK' ? 0 : ($k->luasVerifikasi ?: 0), 2) }}
                                    Ha
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>


</div>

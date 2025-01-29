<div x-data="{
    kawasanTerkunci: ''
}">
    {{-- preview --}}
    <template x-if="$wire.preview" class="pt-4">

        <div id="kumuh-awal-akhir " class="pt-4">
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
                            <option value="">Pilih Wilayah</option>
                            @if ($kawasan)
                                @foreach ($kawasan as $item)
                                    <option value="{{ $item->id_kawasan }}">
                                        {{ $item->kawasan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </li>

                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li>

                    <li>
                        <select wire:model.live="idRTTerpilih" wire:key="idKawasanTerpilih"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="0">Pilih RT/RW</option>
                            @if ($rt)
                                @foreach ($rt as $item)
                                    <option value="{{ $item['id_rtrw'] }}">{{ $item['rtrw'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </li>
                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <span>{{ $tahun }}</span>
                    </li>
                    <li>
                        <span
                            class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            {{-- preview --}}
                            <button
                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                x-on:click="$wire.swapPreview()" title="Preview">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye-off">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                        </span>
                    </li>
                </ol>
            </nav>
            {{-- tabel kumuh awal akhir --}}
            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                <table
                    class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900 table">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th rowspan="2"
                                class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Aspek/Kriteria</th>
                            <th colspan="3"
                                class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Kumuh Awal
                            </th>
                            <th colspan="2" class="border-l-2"> Investasi</th>
                            <th colspan="3" class="border-l-2"
                                class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Kumuh Akhir
                            </th>
                        </tr>
                        <tr>
                            <th class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Vol</th>
                            <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Prosen
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Nilai
                            </th>
                            <th class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white border-l-2">
                                Kegiatan</th>
                            <th class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white ">
                                volume</th>

                            <th class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white border-l-2">
                                Vol</th>
                            <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Prosen
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Nilai
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        {{-- 1 --}}
                        <tr>
                            <td class="whitespace-nowrap text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button title="a. Ketidakteraturan Bangunan">1a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1av'} ?: 0 }} Unit</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k1a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k1a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v1a'])
                                    <span>{{ $kumuhAkhir['v1a'] }} Unit</span>
                                @endisset
                            </td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['1av']) ? $kumuhAkhir['1av'] : 0 }} Unit
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['1ap'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['1an']) ? $kumuhAkhir['1an'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button title="b. Kepadatan Bangunan">1b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1bv'} ?: 0 }} Ha</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k1b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k1b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v1b'])
                                    <span>{{ $kumuhAkhir['v1b'] }} Ha</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['1bv']) ? $kumuhAkhir['1bv'] : 0 }}Ha
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['1bp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['1bn']) ? $kumuhAkhir['1bn'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button title="c. Ketidaksesuaian dengan Persy Teknis Bangunan">1c</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1cv'} ?: 0 }} Unit</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1cp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1cn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k1c']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k1c'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v1c'])
                                    <span>{{ $kumuhAkhir['v1c'] }} Unit</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['1cv']) ? $kumuhAkhir['1cv'] : 0 }} Unit
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['1cp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['1cn']) ? $kumuhAkhir['1cn'] : 0 }}</td>
                        </tr>
                        <tr class=" ">
                            <td colspan="2"
                                class="whitespace-nowrap px-4 text-wrap  py-2 text-gray-700 font-semibold dark:text-gray-200 ">
                                <button title="1.Kondisi Bangunan Gedung">1r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['1r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 2 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                <button title="a. Cakupan Pelayanan Jalan Lingkungan">2a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2av'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k2a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k2a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v2a'])
                                    <span>{{ $kumuhAkhir['v2a'] }} Meter</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['2av']) ? $kumuhAkhir['2av'] : 0 }} Meter
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['2ap'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['2an']) ? $kumuhAkhir['2an'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                <button title="b. Kualitas Permukaan Jalan lingkungan"> 2b</button>

                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2bv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k2b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k2b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v2b'])
                                    <span>{{ $kumuhAkhir['v2b'] }} Meter</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['2bv']) ? $kumuhAkhir['2bv'] : 0 }} Meter
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['2bp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['2bn']) ? $kumuhAkhir['2bn'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td colspan="2"
                                class="whitespace-nowrap  text-wrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button 2.Kondisi Jalan Lingkungan>2r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['2r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 3 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button title="a. Ketersediaan Akses Aman Air Minum">3a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k3a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k3a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v3a'])
                                    <span>{{ $kumuhAkhir['v3a'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['3av']) ? $kumuhAkhir['1av'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['3ap'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['3an']) ? $kumuhAkhir['3an'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                <button title="b. Tidak terpenuhinya Kebutuhan Air Minum">3b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k3b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k3b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v3b'])
                                    <span>{{ $kumuhAkhir['v3b'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['3bv']) ? $kumuhAkhir['3bv'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['3bp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['3bn']) ? $kumuhAkhir['3bn'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                class="whitespace-nowrap px-4  text-wrap py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button title="3.Kondisi Penyediaan Air Minum">3r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['3r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 4 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap  text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                <button title="a. Ketidakmampuan Mengalirkan Limpasan Air">4a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::format($this->kumuhAwal->{'4av'}, 2) : 0 }} Ha</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k4a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k4a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v4a'])
                                    <span>{{ $kumuhAkhir['v4a'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4av'] * 100, 2) : 0 }} Ha</td>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4ap'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['4an']) ? $kumuhAkhir['4an'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td
                                class="whitespace-nowrap text-wrap  px-4 py-2 font-medium text-gray-900 dark:text-white">
                                <button title="b. Ketidaktersediaan Drainase">4b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4bv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k4b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k4b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v4b'])
                                    <span>{{ $kumuhAkhir['v4b'] }} Meter</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['4bv']) ? $kumuhAkhir['4bv'] : 0 }}Meter
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4bp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['4bn']) ? $kumuhAkhir['4bn'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td
                                class="whitespace-nowrap  text-wrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                <button title="c. Kualitas Konstruksi Drainase">4c</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4cv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4cp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4cn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k4c']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k4c'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v4c'])
                                    <span>{{ $kumuhAkhir['v4c'] }} Meter</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['4cv']) ? $kumuhAkhir['4cv'] : 0 }} Meter
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4cp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['4cn']) ? $kumuhAkhir['4cn'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td colspan="2"
                                class="whitespace-nowrap  text-wrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button title="4.Kondisi Drainase Lingkungan">4r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 5 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button
                                    title="a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis">5a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k5a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k5a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v5a'])
                                    <span>{{ $kumuhAkhir['v5a'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['5av']) ? $kumuhAkhir['5av'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['5ap'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['5an']) ? $kumuhAkhir['5an'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button
                                    title="b. Prasarana dan Sarana Pengelolaan Air Limbah Tidak Sesuai dengan Persyaratan
                                Teknis">5b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k5b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k5b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v5b'])
                                    <span>{{ $kumuhAkhir['v5b'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['5bv']) ? $kumuhAkhir['5bv'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['5bp'] * 100, 2) : 0 }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['5bn']) ? $kumuhAkhir['5bn'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                class="whitespace-nowrap  text-wrap  px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button title="5. Kondisi Pengelolaan Air Limbah">5r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['5r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 6 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button
                                    title="a. Prasarana dan Sarana Persampahan Tidak Sesuai dengan persyaratan Teknis">6a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k6a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k6a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v6a'])
                                    <span>{{ $kumuhAkhir['v6a'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['6av']) ? $kumuhAkhir['6av'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['6ap'] * 100, 2) : 0 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['6an']) ? $kumuhAkhir['6an'] : 0 }}</td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button
                                    title="b. Sistem Pengelolaan Persampahan yang tidak sesuai Standar Teknis">6b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k6b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k6b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v6b'])
                                    <span>{{ $kumuhAkhir['v6b'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['6bv']) ? $kumuhAkhir['6bv'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['6bp'] * 100, 2) : 0 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['6bn']) ? $kumuhAkhir['6bn'] : 0 }}</td>
                        </tr>
                        <tr cl class="bg-gray-50 dark:bg-gray-800/50">
                            <td colspan="2"
                                class="whitespace-nowrap px-4  text-wrap py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button title="6. Kondisi Pengelolaan Persampahan">6r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['6r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 7 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                <button title="a. Ketidaktersediaan Prasarana Proteksi Kebakaran">7a</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7an'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k7a']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k7a'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v7a'])
                                    <span>{{ $kumuhAkhir['v7a'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['7av']) ? $kumuhAkhir['7av'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['7ap'] * 100, 2) : 0 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['7an']) ? $kumuhAkhir['7an'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-4  text-wrap py-2  text-gray-900 dark:text-white">
                                <button title="b. Ketidaktersediaan Sarana Proteksi Kebakaran">7b</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7bn'} ?: 0 }}</td>
                            {{-- investasi --}}
                            <td
                                class="whitespace-nowrap  text-wrap text-center px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                @if (isset($kumuhAkhir['k7b']))
                                    <span class="text-wrap">{{ $kumuhAkhir['k7b'] }}</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 ">
                                @isset($kumuhAkhir['v7b'])
                                    <span>{{ $kumuhAkhir['v7b'] }} KK</span>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                {{ isset($kumuhAkhir['7bv']) ? $kumuhAkhir['7bv'] : 0 }} KK
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['7bp'] * 100, 2) : 0 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ isset($kumuhAkhir['7bn']) ? $kumuhAkhir['7bn'] : 0 }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                class="whitespace-nowrap text-wrap  px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                <button title="7. Kondisi Proteksi Kebakaran">7r</button>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['7r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td class="whitespace-nowrap text-wrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                            </td>
                            <td colspan="2" title="tingkat kekumuhan"
                                class="whitespace-nowrap px-4 py-2 text-center  {{ $kumuhAwal ? $kumuhAwal?->getWarnaAttribute()[1] : '' }}">
                                {{ $kumuhAwal ? $kumuhAwal->getWarnaAttribute()[0] : '' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="total nilai">
                                {{ $kumuhAwal ? $kumuhAwal->totalNilai : 0 }}
                            </td>
                            <td colspan="2" class="border-l-2"></td>

                            <td colspan="2" title="tingkat kekumuhan"
                                class="border-l-2 whitespace-nowrap px-4 py-2 text-center {{ isset($kumuhAkhir) ? $kumuhAkhir['ket'][1] : '' }}">
                                {{ isset($kumuhAkhir) ? $kumuhAkhir['ket'][0] : '' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="total nilai">
                                {{ isset($kumuhAkhir) ? $kumuhAkhir['totalNilai'] : '' }}

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                class="whitespace-nowrap text-wrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                            </td>

                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="rata rata kekumuhan sektoral">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal->rataRataKumuhSektoral * 100, 2) : 0 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="kontribusi penanganan">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal->kontribusiPenanganan * 100, 2) : 0 }}
                            </td>
                            <td colspan="2" class="border-l-2"></td>

                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="rata rata kekumuhan sektoral">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['ratarataKekumuhan'] * 100, 2) : 0 }}
                            </td>

                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white"
                                title="kontribusi penanganan">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['kontribusiPenanganan'] * 100, 2) : 0 }}
                            </td>

                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-center mt-4">
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-red-600 bg-red-50">60 - 80 KUMUH
                    BERAT</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-orange-600 bg-orange-50">38 - 59
                    KUMUH
                    SEDANG</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-yellow-600 bg-yellow-50">16 - 37
                    KUMUH
                    RINGAN</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-green-600 bg-green-50">0 - 15
                    TIDAK KUMUH</span>
            </div>
        </div>
    </template>



    {{-- tabel investasi --}}
    <template x-if="$wire.preview==false">
        <div>
            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                Data Investasi Tahun <span>{{ $tahun }}</span>
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
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 text center">
                                        <span
                                            class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                                            {{-- preview --}}
                                            <button
                                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                                x-on:click="$wire.swapPreview({{ $item->id_kawasan }}, {{ $item->id_rtrw }})"
                                                title="Preview">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                            @if ($item->locked == 0)
                                                {{-- lock --}}
                                                <button
                                                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                                    x-on:click.prevent="$dispatch('open-modal', {name:'confirm-investasi', id :'{{ $item->id_kawasan }}', email:'{{ $item->kawasan }}'}) "
                                                    title="Kunci Investasi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-lock">
                                                        <rect x="3" y="11" width="18" height="11"
                                                            rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </svg>
                                                </button>

                                                {{-- delete --}}
                                                <button
                                                    class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                                                    x-on:click.prevent="$dispatch('open-modal', {name:'confirm-investasi-deletion', id :'{{ $item->id_investasi }}'}) "
                                                    title="Delete Investasi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            @elseif ($item->locked == 1)
                                                {{-- unlock --}}
                                                <button
                                                    class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:text-gray-200 dark:hover:bg-gray-800"
                                                    x-on:click.prevent="$dispatch('open-modal', {name:'confirm-investasi-unlock', id :'{{ $item->id_kawasan }}', email:'{{ $item->kawasan }}'}) "
                                                    title="Unlock">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-unlock">
                                                        <rect x="3" y="11" width="18" height="11"
                                                            rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </template>



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

    {{-- modal confirm  investasi --}}
    <x-modal name="confirm-investasi" focusable x-data="{
        init() {
            // Mendengarkan event dari Livewire
            Livewire.on('close', () => {
                $dispatch('close')
                console.log('ok')
            });
        }">
        <form wire:submit="lock(id,email);$dispatch('close'); " class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('apakah kamu yakin Kunci Investasi ') }}<span x-text='id'></span>
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Dengan menekan tombol kunci maka akan mengunci seluruh investasi ') }} <span
                    x-text="email"></span>
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Harap Lihat Preview terlebih dahulu untuk melihat hasil kumuh akhir investasi') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Kunci Investasi') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    {{-- unlock --}}
    <x-modal name="confirm-investasi-unlock" focusable x-data="{
        init() {
            // Mendengarkan event dari Livewire
            Livewire.on('close', () => {
                $dispatch('close')
                console.log('ok')
            });
        }">
        <form wire:submit="unlock(id,email);$dispatch('close'); " class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('apakah kamu yakin Membuka Kunci Investasi ') }}<span x-text='id'></span>
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('tindakan ini akan membuka semua kunci dari wilayah ') }} <span x-text="email"></span>
                {{ __(' dan menghapus kumuh akhir yang sudah terinput ') }}

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Buka Kunci Investasi') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    @include('components.alert')

    <!-- DataTables CSS -->
    {{-- <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">

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
    </script> --}}

</div>

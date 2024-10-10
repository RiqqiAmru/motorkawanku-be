<div class='py-6 px-6'>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:gap-8 ">
        <div
            class="flex flex-col min-h-32   bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-2 py-2 gap-2">
            <div class="text-center">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Motor Kawanku</h1>
                <h6 class="font-light text-xs text-gray-800 dark:text-gray-200 leading-tight">Cek Kawasan Kumuh Kota
                    Pekalongan</h6>
            </div>
            <div wire:ignore>
                <div class="h-64 bg-gray-200 shadow-sm sm:rounded-lg border-black" id="map"></div>
            </div>
            <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700">
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class=" text-gray-900 dark:text-white">Kelurahan</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select wire:model.live="idKawasanTerpilih"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Wilayah</option>
                                @foreach ($kawasan as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kawasan }}</option>
                                @endforeach
                            </select>
                            {{ $header?->wilayah }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900 dark:text-white">Wilayah RT/RW</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select wire:model.live="idRTTerpilih" wire:key="idKawasanTerpilih"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih RT/RW</option>
                                @if ($daftarRT)
                                    @foreach ($daftarRT as $item)
                                        <option value="{{ $item->id }}">{{ $item->rtrw }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900 dark:text-white">Tahun</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select wire:model.live="tahun" wire:key="idKawasanTerpilih"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for ($i = 2020; $i <= now()->year; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Luas Verifikasi </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($header?->luasVerifikasi ?: 0, 2) }} Ha
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Bangunan </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($header?->jumlahBangunan ?: 0) }} Meter
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Penduduk </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($header?->jumlahPenduduk ?: 0) }} Jiwa
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah KK </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($header?->jumlahKK ?: 0) }} KK</dd>
                    </div>
                </dl>
            </div>


        </div>
        <div x-data="{ show: 'kumuh' }"
            class="flex flex-col gap-2 p-2   md:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <div>
                <div class=" block">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex gap-6">
                            <a href="#" wire:click="showTab('kumuh')"
                                class="shrink-0 border {{ $show == 'kumuh' ? 'rounded-t-lg border-gray-300 border-b-white text-sky-600 dark:border-gray-600 dark:border-b-gray-950 dark:text-sky-300' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}  p-3 text-sm font-medium ">
                                Kumuh
                            </a>
                            <a href="#" wire:click="showTab('investasi')"
                                class="shrink-0 border {{ $show == 'investasi' ? 'rounded-t-lg border-gray-300 border-b-white text-sky-600 dark:border-gray-600 dark:border-b-gray-950 dark:text-sky-300' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}  p-3 text-sm font-medium ">
                                Investasi
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <div id="kumuh-awal-akhir " class="{{ $show == 'kumuh' ? '' : 'hidden' }}">
                <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                    <table
                        class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th rowspan="2"
                                    class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                    Aspek/Kriteria</th>
                                <th colspan="3"
                                    class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                    Kumuh Awal
                                </th>
                                <th colspan="3"
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
                                <th class=" whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
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
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Ketidakteraturan Bangunan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1av'} ?: 0 }} Unit</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'1av'} ?: 0 }} Unit
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'1ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'1an'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Kepadatan Bangunan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1bv'} ?: 0 }} Ha</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'1bv'} ?: 0 }} Ha
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'1bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'1bn'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    c. Ketidaksesuaian dengan Persy Teknis Bangunan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1cv'} ?: 0 }} Unit</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1cp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'1cn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'1cv'} ?: 0 }} Unit
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'1cp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'1cn'} ?: 0 }}</td>
                            </tr>
                            <tr class=" ">
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200 ">
                                    1.
                                    Kondisi Bangunan Gedung</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'1r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 2 --}}
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Cakupan Pelayanan Jalan Lingkungan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'2av'} ?: 0 }} Meter</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'2an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'2av'} ?: 0 }} Meter
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'2ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'2an'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Kualitas Permukaan Jalan lingkungan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'2bv'} ?: 0 }} Meter</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'2bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'2bv'} ?: 0 }} Meter
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'2bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'2bn'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    2.
                                    Kondisi Jalan Lingkungan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'2r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 3 --}}
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Ketersediaan Akses Aman Air Minum
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'3av'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'3an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'3av'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'3ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'3an'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Tidak terpenuhinya Kebutuhan Air Minum
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'3bv'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'3bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'3bv'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'3bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'3bn'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    3.
                                    Kondisi Penyediaan Air Minum
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'3r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 4 --}}
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Ketidakmampuan Mengalirkan Limpasan Air
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4av'} ?: 0 }} Ha</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'4av'} ?: 0 }} Ha
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'4ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'4an'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    b. Ketidaktersediaan Drainase
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4bv'} ?: 0 }} Meter</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'4bv'} ?: 0 }} Meter
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'4bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'4bn'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    c. Kualitas Konstruksi Drainase
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4cv'} ?: 0 }} Meter</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4cp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'4cn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'4cv'} ?: 0 }} Meter
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'4cp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'4cn'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    4.
                                    Kondisi Drainase Lingkungan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'4r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 5 --}}
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'5av'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'5an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'5av'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'5ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'5an'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Prasarana dan Sarana Pengelolaan Air Limbah Tidak Sesuai dengan Persyaratan
                                    Teknis
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'5bv'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'5bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'5bv'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'5bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'5bn'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    5. Kondisi Pengelolaan Air Limbah
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'5r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 6 --}}
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Prasarana dan Sarana Persampahan Tidak Sesuai dengan persyaratan Teknis
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'6av'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'6an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'6av'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'6ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'6an'} ?: 0 }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Sistem Pengelolaan Persampahan yang tidak sesuai Standar Teknis
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'6bv'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'6bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'6bv'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'6bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'6bn'} ?: 0 }}</td>
                            </tr>
                            <tr cl class="bg-gray-50 dark:bg-gray-800/50">
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    6. Kondisi Pengelolaan Persampahan
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'6r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                            {{-- 7 --}}
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    a. Ketidaktersediaan Prasarana Proteksi Kebakaran
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'7av'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7ap'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'7an'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'7av'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'7ap'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'7an'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    b. Ketidaktersediaan Sarana Proteksi Kebakaran
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'7bv'} ?: 0 }} KK</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7bp'} * 100, 2) : 0 }} </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAwal?->{'7bn'} ?: 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $kumuhAkhir?->{'7bv'} ?: 0 }} KK
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'7bp'} * 100, 2) : 0 }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                    {{ $kumuhAkhir?->{'7bn'} ?: 0 }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold dark:text-gray-200">
                                    7. Kondisi Proteksi Kebakaran
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7r'} * 100, 2) : 0 }} </td>
                                <td></td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir?->{'7r'} * 100, 2) : 0 }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            @php
                                $tingkatKekumuhan = '';
                            @endphp
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">Tingkat
                                    Kekumuhan / Total Nilai
                                </td>
                                <td colspan="2" class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">

                                </td>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAwal ? $kumuhAwal->totalNilai : 0 }}
                                </td>
                                <td colspan="2"
                                    class="border-l-2 whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">KUMUH
                                    BERAT
                                </td>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAkhir ? $kumuhAkhir->totalNilai : 0 }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                    Rata-Rata Kekumuhan Sektoral / Kontribusi Penanganan
                                </td>

                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal->rataRataKumuhSektoral * 100, 2) : 0 }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAwal ? Number::percentage($kumuhAwal->kontribusiPenanganan * 100, 2) : 0 }}
                                </td>
                                <td class="border-l-2"></td>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir->rataRataKumuhSektoral * 100, 2) : 0 }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                    {{ $kumuhAkhir ? Number::percentage($kumuhAkhir->kontribusiPenanganan * 100, 2) : 0 }}
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
            <div id="tab-investasi" class="{{ $show == 'investasi' ? '' : 'hidden' }}">
                <h4>investasi</h4>
            </div>
        </div>
    </div>
</div>

{{-- <script wire:key="idKawasanTerpilih">
    console.log('@json($coordinate)');
</script> --}}

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var map = L.map("map").setView([-6.8908, 109.6756], 13);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
</script>

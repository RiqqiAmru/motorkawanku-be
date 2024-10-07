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
                        <dt class="font-medium text-gray-900 dark:text-white">Kelurahan</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select wire:model.live="idKawasanTerpilih"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Wilayah</option>
                                @foreach ($kawasan as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kawasan }}</option>
                                @endforeach
                            </select>
                            {{ $kawasanTerpilih?->wilayah }}
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
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="user">2024</option>
                            </select>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Luas Verifikasi </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($kawasanTerpilih?->luasVerifikasi ?: 0, 2) }} Ha
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Bangunan </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($kawasanTerpilih?->jumlahBangunan ?: 0) }} Unit
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Penduduk </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($kawasanTerpilih?->jumlahPenduduk ?: 0) }} Jiwa
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah KK </dt>
                        <dd class="text-gray-700  dark:text-gray-200">
                            {{ Number::format($kawasanTerpilih?->jumlahKK ?: 0) }} KK</dd>
                    </div>
                </dl>
            </div>


        </div>
        <div
            class="flex flex-col gap-2 p-2   md:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <div>
                <div class="sm:hidden">
                    <label for="Tab" class="sr-only">Tab</label>

                    <select id="Tab"
                        class="w-full rounded-md border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <option select>Kumuh</option>
                        <option>Investasi</option>
                    </select>
                </div>

                <div class="hidden sm:block">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex gap-6">

                            <a href="#"
                                class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                Kumuh
                            </a>

                            <a href="#"
                                class="shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600 dark:border-gray-600 dark:border-b-gray-950 dark:text-sky-300">
                                Investasi
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

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

                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                a. Ketidakteraturan Bangunan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">50 Unit</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">0.98% </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">5</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">50 Unit
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">0.98% </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">5</td>
                        </tr>
                        <tr class="bg-teal-200 ">
                            <td colspan="2" class="whitespace-nowrap px-4 py-2 text-gray-700 font-semibold ">1.
                                Kondisi Bangunan Gedung</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">0.98% </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">0.98% </td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">Tingkat
                                Kekumuhan / Total Nilai
                            </td>
                            <td colspan="2" class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">KUMUH
                                BERAT
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80
                            </td>
                            <td colspan="2"
                                class="border-l-2 whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">KUMUH
                                BERAT
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Rata-Rata Kekumuhan Sektoral / Kontribusi Penanganan
                            </td>

                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80</td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80</td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80</td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">80</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-center mt-4">
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-red-600 bg-red-50">60 - 80 KUMUH
                    BERAT</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-orange-600 bg-orange-50">38 - 59 KUMUH
                    SEDANG</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-yellow-600 bg-yellow-50">16 - 37 KUMUH
                    RINGAN</span>
                <span class="px-3 py-2 rounded-full font-semibold text-xs text-green-600 bg-green-50">0 - 15
                    TIDAK KUMUH</span>
            </div>
        </div>
    </div>
</div>
<script wire:key="idKawasanTerpilih">
    console.log('@json($coordinate)');
</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var map = L.map("map").setView([-6.8908, 109.6756], 13);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
</script>

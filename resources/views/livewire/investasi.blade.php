<div>
    <div class="flex justify-between">
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
                    @if ($user->role == 'admin')
                        <select wire:model.live="idKawasanTerpilih"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Pilih Wilayah</option>
                            @foreach ($kawasan as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->kawasan }}</option>
                            @endforeach
                        </select>
                    @else
                        <a href="#" class="block transition hover:text-gray-700 dark:hover:text-gray-200">
                            {{ $kawasan['kawasan'] }}
                        </a>
                    @endif
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
                                <option value="{{ $item['id'] }}">{{ $item['rtrw'] }}</option>
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
            </ol>
        </nav>
        {{-- @if ($user->role == 'admin')
            <template x-if="$wire.idKawasanTerpilih  && $wire.idRTTerpilih == null   ">
                <template x-if="$wire.locked == false">
                    <x-primary-button x-data=''
                        wire:confirm="**Apakah
                Anda Yakin ingin mengunci data investasi ?** \n \n dengan mengunci data anda tidak dapat mengedit /
                merubah lagi data investasi, hubungi admin bila ada kesalahan"
                        wire:click="lock">{{ __('Kunci Investasi') }}</x-primary-button>
                </template>
            </template>
        @endif --}}
        <template x-if="$wire.locked == true">
            <div class="flex items-center gap-2">
                <span>Locked</span>
                <label for="AcceptConditions"
                    class="relative inline-block h-8 w-14 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-violet-500">
                    <input type="checkbox" id="AcceptConditions" class="peer sr-only" wire:model.live="preview" />
                    <span
                        class="absolute inset-y-0 start-0 m-1 size-6 rounded-full bg-white transition-all peer-checked:start-6"></span>
                </label>

            </div>
        </template>
    </div>

    {{-- investasi --}}
    {{-- @php
        dump($kawasan, $idKawasanTerpilih, $investasi);
    @endphp --}}
    <template x-if="$wire.preview ==false">
        <div class="pt-4" id="tab-investasi" x-data="{
            investasi: [{
                    aspek: '1. Kondisi Bangunan Gedung',
                    kriteria: 'a. Ketidakteraturan Bangunan',
                    kriteriaSpan: 1,
                    aspekSpan: 3,
                    satuan: 'Unit',
                    id: '1a',
                },
                {
                    aspek: '1',
                    satuan: 'Ha',
                    kriteriaSpan: 1,
                    kriteria: 'b. Kepadatan Bangunan',
                    id: '1b',
                },
                {
                    id: '1c',
                    aspek: '1',
                    kriteriaSpan: 1,
                    satuan: 'Unit',
                    kriteria: 'c. Ketidaksesuaian Dengan Persy Teknis Bangunan',
                },
                {
                    aspek: '2. Kondisi Jalan Lingkungan',
                    kriteria: 'a. Cakupan Pelayanan Jalan Lingkungan',
                    kriteriaSpan: 1,
                    satuan: 'Meter',
                    aspekSpan: 2,
                    id: '2a',
                },
                {
                    kriteriaSpan: 1,
                    aspek: '2',
                    kriteria: 'b. Kualitas Permukaan Jalan Lingkungan',
                    satuan: 'Meter',
                    id: '2b',
                },
                {
                    kriteriaSpan: 1,
                    aspek: '3. Kondisi Penyediaan Air Minum',
                    satuan: 'KK',
                    kriteria: 'a. Ketersediaan Akses Aman Air Minum',
                    aspekSpan: 2,
                    id: '3a',
                },
                {
                    kriteriaSpan: 1,
                    aspek: '3',
                    satuan: 'KK',
                    kriteria: 'b. Tidak Terpenuhinya Kebutuhan Air Minum',
                    id: '3b',
                },
                {
                    kriteriaSpan: 1,
                    satuan: 'Ha',
                    aspek: '4. Kondisi Drainase Lingkungan',
                    kriteria: 'a. Ketidakmampuan Mengalirkan Limpasan Air',
                    aspekSpan: 3,
                    id: '4a',
                },
                {
                    kriteriaSpan: 1,
                    aspek: '4',
                    satuan: 'Meter',
                    kriteria: 'b. Ketidaktersediaan Drainase',
                    id: '4b',
                },
                {
                    kriteriaSpan: 1,
                    aspek: '4',
                    satuan: 'Meter',
                    kriteria: 'c. Kualitas Konstruksi Drainase',
                    id: '4c',
                },
                {
                    kriteriaSpan: 1,
                    satuan: 'KK',
                    aspek: '5. Kondisi Pengelolaan Air Limbah',
                    kriteria: 'a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis',
                    aspekSpan: 2,
                    id: '5a',
                },
                {
                    kriteriaSpan: 1,
                    satuan: 'KK',
                    aspek: '5',
                    kriteria: 'b. Prasarana Dan Sarana Pengelolaan Air Limbah Tidak Sesuai Dengan Persyaratan Teknis',
                    id: '5b',
                },
                {
                    aspek: '6. Kondisi Pengelolaan Persampahan',
                    satuan: 'KK',
                    kriteriaSpan: 1,
                    aspekSpan: 2,
                    kriteria: 'a. Prasarana Dan Sarana Persampahan Tidak Sesuai Dengan Persyaratan Teknis',
                    id: '6a',
                },
                {
                    kriteriaSpan: 1,
                    satuan: 'KK',
                    aspek: '6',
                    kriteria: 'b. Sistem Pengelolaan Persampahan Yang Tidak Sesuai Standar Teknis',
                    id: '6b',
                },
                {
                    kriteriaSpan: 1,
                    aspekSpan: 2,
                    satuan: 'Unit',
                    aspek: '7. Kondisi Proteksi Kebakaran',
                    kriteria: 'a. Ketidaktersediaan Prasarana Proteksi Kebakaran',
                    id: '7a',
                },
                {
                    kriteriaSpan: 1,
                    satuan: 'Unit',
                    aspek: '7',
                    kriteria: 'b. Ketidaktersediaan Sarana Proteksi Kebakaran',
                    id: '7b',
                },
            ],
            init() {
                // Mendengarkan event dari Livewire
                this.handleInvestasiChange();
                Livewire.on('updated-investasi', () => {
                    this.handleInvestasiChange();
                    this.$dispatch('close')
                });
        
            },
            handleInvestasiChange() {
                let data = [{
                        aspek: '1. Kondisi Bangunan Gedung',
                        kriteria: 'a. Ketidakteraturan Bangunan',
                        kriteriaSpan: 1,
                        aspekSpan: 3,
                        satuan: 'Unit',
                        idKriteria: '1a',
                    },
                    {
                        aspek: '1',
                        satuan: 'Ha',
                        kriteriaSpan: 1,
                        kriteria: 'b. Kepadatan Bangunan',
                        idKriteria: '1b',
                    },
                    {
                        idKriteria: '1c',
                        aspek: '1',
                        kriteriaSpan: 1,
                        satuan: 'Unit',
                        kriteria: 'c. Ketidaksesuaian Dengan Persy Teknis Bangunan',
                    },
                    {
                        aspek: '2. Kondisi Jalan Lingkungan',
                        kriteria: 'a. Cakupan Pelayanan Jalan Lingkungan',
                        kriteriaSpan: 1,
                        satuan: 'Meter',
                        aspekSpan: 2,
                        idKriteria: '2a',
                    },
                    {
                        kriteriaSpan: 1,
                        aspek: '2',
                        kriteria: 'b. Kualitas Permukaan Jalan Lingkungan',
                        satuan: 'Meter',
                        idKriteria: '2b',
                    },
                    {
                        kriteriaSpan: 1,
                        aspek: '3. Kondisi Penyediaan Air Minum',
                        satuan: 'KK',
                        kriteria: 'a. Ketersediaan Akses Aman Air Minum',
                        aspekSpan: 2,
                        idKriteria: '3a',
                    },
                    {
                        kriteriaSpan: 1,
                        aspek: '3',
                        satuan: 'KK',
                        kriteria: 'b. Tidak Terpenuhinya Kebutuhan Air Minum',
                        idKriteria: '3b',
                    },
                    {
                        kriteriaSpan: 1,
                        satuan: 'Ha',
                        aspek: '4. Kondisi Drainase Lingkungan',
                        kriteria: 'a. Ketidakmampuan Mengalirkan Limpasan Air',
                        aspekSpan: 3,
                        idKriteria: '4a',
                    },
                    {
                        kriteriaSpan: 1,
                        aspek: '4',
                        satuan: 'Meter',
                        kriteria: 'b. Ketidaktersediaan Drainase',
                        idKriteria: '4b',
                    },
                    {
                        kriteriaSpan: 1,
                        aspek: '4',
                        satuan: 'Meter',
                        kriteria: 'c. Kualitas Konstruksi Drainase',
                        idKriteria: '4c',
                    },
                    {
                        kriteriaSpan: 1,
                        satuan: 'KK',
                        aspek: '5. Kondisi Pengelolaan Air Limbah',
                        kriteria: 'a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis',
                        aspekSpan: 2,
                        idKriteria: '5a',
                    },
                    {
                        kriteriaSpan: 1,
                        satuan: 'KK',
                        aspek: '5',
                        kriteria: 'b. Prasarana Dan Sarana Pengelolaan Air Limbah Tidak Sesuai Dengan Persyaratan Teknis',
                        idKriteria: '5b',
                    },
                    {
                        aspek: '6. Kondisi Pengelolaan Persampahan',
                        satuan: 'KK',
                        kriteriaSpan: 1,
                        aspekSpan: 2,
                        kriteria: 'a. Prasarana Dan Sarana Persampahan Tidak Sesuai Dengan Persyaratan Teknis',
                        idKriteria: '6a',
                    },
                    {
                        kriteriaSpan: 1,
                        satuan: 'KK',
                        aspek: '6',
                        kriteria: 'b. Sistem Pengelolaan Persampahan Yang Tidak Sesuai Standar Teknis',
                        idKriteria: '6b',
                    },
                    {
                        kriteriaSpan: 1,
                        aspekSpan: 2,
                        satuan: 'Unit',
                        aspek: '7. Kondisi Proteksi Kebakaran',
                        kriteria: 'a. Ketidaktersediaan Prasarana Proteksi Kebakaran',
                        idKriteria: '7a',
                    },
                    {
                        kriteriaSpan: 1,
                        satuan: 'Unit',
                        aspek: '7',
                        kriteria: 'b. Ketidaktersediaan Sarana Proteksi Kebakaran',
                        idKriteria: '7b',
                    },
                ]
                if ($wire.investasi) {
                    $wire.investasi.forEach((inv) => {
                        const index = data.findIndex((d) => d.idKriteria === inv.idkriteria);
                        if (index !== -1) {
                            if (!data[index].kegiatan) {
                                data[index] = { ...inv, ...data[index] };
                            } else {
                                // menambahkan rowspan di data sebelumnya
                                if (!data[index].aspekSpan) {
                                    const indexAspek = data.findIndex(
                                        (d) => d.idKriteria[0] === inv.idkriteria[0]
                                    );
                                    data[indexAspek].aspekSpan = data[indexAspek].aspekSpan + 1;
                                } else {
                                    data[index].aspekSpan = data[index].aspekSpan + 1;
                                }
                                data[index].kriteriaSpan = data[index].kriteriaSpan + 1;
                                let satuan = data[index].satuan;
                                data.splice(index + 1, 0, { ...inv, satuan });
                            }
                        }
                    });
                }
                this.investasi = data;
            }
        }">
            <div class="overflow-x-auto">
                <table
                    class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                INFRASTRUKTUR</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                KRITERIA
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                KEGIATAN</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                VOLUME
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                SUMBER
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                ANGGARAN
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="item in investasi">
                            <tr>
                                <template x-if="item.aspekSpan">
                                    <td x-bind:rowspan="item.aspekSpan" x-text="item.aspek"
                                        class="whitespace-nowrap px-4 py-2 text-wrap font-medium text-gray-900 dark:text-white">
                                    </td>
                                </template>
                                <template x-if="item.kriteriaSpan">
                                    <td x-bind:rowspan="item.kriteriaSpan"
                                        class="whitespace-nowrap px-4 py-2 text-wrap font-medium text-gray-900 dark:text-white">
                                        <span x-text="item.kriteria"></span>

                                        {{-- button tambah --}}
                                        <template x-if="$wire.locked == false">
                                            <template
                                                x-if="$wire.tahun == new Date().getFullYear() && $wire.idRTTerpilih ">
                                                <x-primary-button x-data=''
                                                    x-on:click.prevent="$dispatch('open-modal',{name:'add-new-investasi',idKriteria :item.idKriteria})">{{ __('Tambah') }}</x-primary-button>
                                            </template>
                                        </template>
                                    </td>
                                </template>
                                <template x-if="item.kegiatan == undefined">
                                    <td colspan="4"
                                        class=" text-center whitespace-nowrap px-4 py-2 text-gray-400 dark:text-gray-200 italic">
                                        Tidak ada Pembangunan Investasi</td>
                                </template>
                                <template x-if="item.kegiatan != undefined">
                                    <td
                                        class="whitespace-nowrap text-wrap px-4 py-2  font-medium text-gray-900 dark:text-white">

                                        <span x-text="item.kegiatan"></span>
                                    </td>
                                </template>
                                <template x-if="item.kegiatan != undefined">
                                    <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-900 dark:text-white">
                                        <span x-text="item.volume"></span> <span x-text="item.satuan"></span>
                                    </td>
                                </template>
                                <template x-if="item.kegiatan != undefined">
                                    <td x-text="item.sumberAnggaran"
                                        class="whitespace-nowrap px-4 py-2  font-medium text-gray-900 dark:text-white">
                                    </td>
                                </template>
                                <template x-if="item.kegiatan != undefined">
                                    <td x-text="item.anggaran"
                                        class="whitespace-nowrap px-4 py-2  font-medium text-gray-900 dark:text-white">
                                    </td>
                                </template>
                                <template x-if="$wire.idRTTerpilih && item.kegiatan !=undefined && item.locked !=1">
                                    <td>
                                        <x-danger-button x-data="" aria-describedby="hapus data"
                                            wire:click="delete(item.id)"
                                            wire:confirm="Apakah Kamu yakin ingin menghapus data investasi">
                                            <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                            <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17"
                                                    stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </x-danger-button>
                                    </td>
                                </template>
                            </tr>
                        </template>

                    </tbody>
                </table>
            </div>
        </div>
    </template>

    {{-- preview kumuh akhir --}}
    <template x-if="$wire.preview" class="pt-4">


        <div id="kumuh-awal-akhir ">
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
                            <td class="whitespace-nowrap text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                a. Ketidakteraturan Bangunan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1av'} ?: 0 }} Unit</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1an'} ?: 0 }}</td>
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
                                b. Kepadatan Bangunan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1bv'} ?: 0 }} Ha</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1bn'} ?: 0 }}</td>
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
                                c. Ketidaksesuaian dengan Persy Teknis Bangunan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1cv'} ?: 0 }} Unit</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1cp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'1cn'} ?: 0 }}</td>
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
                                1.
                                Kondisi Bangunan Gedung</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'1r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['1r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 2 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                a. Cakupan Pelayanan Jalan Lingkungan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2av'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2an'} ?: 0 }}</td>
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
                                b. Kualitas Permukaan Jalan lingkungan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2bv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'2bn'} ?: 0 }}</td>
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
                                2.
                                Kondisi Jalan Lingkungan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'2r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['2r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 3 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                a. Ketersediaan Akses Aman Air Minum
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3an'} ?: 0 }}</td>
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
                                b. Tidak terpenuhinya Kebutuhan Air Minum
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'3bn'} ?: 0 }}</td>
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
                                3.
                                Kondisi Penyediaan Air Minum
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'3r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['3r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 4 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap  text-wrap  px-4 py-2  text-gray-900 dark:text-white">
                                a. Ketidakmampuan Mengalirkan Limpasan Air
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::format($this->kumuhAwal->{'4av'}, 2) : 0 }} Ha</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4an'} ?: 0 }}</td>
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
                                b. Ketidaktersediaan Drainase
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4bv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4bn'} ?: 0 }}</td>
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
                                c. Kualitas Konstruksi Drainase
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4cv'} ?: 0 }} Meter</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4cp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'4cn'} ?: 0 }}</td>
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
                                4.
                                Kondisi Drainase Lingkungan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'4r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['4r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 5 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'5an'} ?: 0 }}</td>
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
                                5. Kondisi Pengelolaan Air Limbah
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'5r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['5r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 6 --}}
                        <tr class="bg-gray-50 dark:bg-gray-800/50">
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                a. Prasarana dan Sarana Persampahan Tidak Sesuai dengan persyaratan Teknis
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6an'} ?: 0 }}</td>
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
                                b. Sistem Pengelolaan Persampahan yang tidak sesuai Standar Teknis
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'6bn'} ?: 0 }}</td>
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
                                6. Kondisi Pengelolaan Persampahan
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'6r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['6r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                        {{-- 7 --}}
                        <tr>
                            <td class="whitespace-nowrap  text-wrap px-4 py-2  text-gray-900 dark:text-white">
                                a. Ketidaktersediaan Prasarana Proteksi Kebakaran
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7av'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7ap'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7an'} ?: 0 }}</td>
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
                                b. Ketidaktersediaan Sarana Proteksi Kebakaran
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7bv'} ?: 0 }} KK</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7bp'} * 100, 2) : 0 }} </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">
                                {{ $kumuhAwal?->{'7bn'} ?: 0 }}</td>
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
                                7. Kondisi Proteksi Kebakaran
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ $kumuhAwal ? Number::percentage($kumuhAwal?->{'7r'} * 100, 2) : 0 }} </td>
                            <td></td>
                            <td class="border-l-2"></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 bg-orange-300 ">
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['7r'] * 100, 2) : 0 }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-bold text-gray-900 dark:text-white">
                                Tingkat
                                Kekumuhan / Total Nilai
                            </td>
                            <td colspan="2"
                                class="whitespace-nowrap px-4 py-2 text-center  {{ $kumuhAwal ? $kumuhAwal?->getWarnaAttribute()[1] : '' }}">
                                {{ $kumuhAwal ? $kumuhAwal->getWarnaAttribute()[0] : '' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                {{ $kumuhAwal ? $kumuhAwal->totalNilai : 0 }}
                            </td>
                            <td colspan="2"
                                class="border-l-2 whitespace-nowrap px-4 py-2 text-center {{ isset($kumuhAkhir) ? $kumuhAkhir['ket'][1] : '' }}">
                                {{ isset($kumuhAkhir) ? $kumuhAkhir['ket'][0] : '' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
                                {{ isset($kumuhAkhir) ? $kumuhAkhir['totalNilai'] : '' }}

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
                                {{ isset($kumuhAkhir) ? Number::percentage($kumuhAkhir['ratarataKekumuhan'] * 100, 2) : 0 }}
                            </td>

                            </td>
                            <td class="whitespace-nowrap px-4 py-2  text-gray-900 dark:text-white">
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


    @include('livewire.partials.modal-add-investasi')
    @include('components.alert')

</div>

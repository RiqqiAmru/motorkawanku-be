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
        <template x-if="$wire.idKawasanTerpilih  && $wire.idRTTerpilih == null ">
            <template x-if="$wire.locked == false">
                <x-primary-button x-data=''
                    wire:confirm="**Apakah
                Anda Yakin ingin mengunci data investasi ?** \n \n dengan mengunci data anda tidak dapat mengedit /
                merubah lagi data investasi, hubungi admin bila ada kesalahan"
                    wire:click="lock">{{ __('Kunci Investasi') }}</x-primary-button>
            </template>
        </template>
        <template x-if="$wire.locked == true">
            <span>Locked</span>
        </template>
    </div>

    {{-- investasi --}}
    {{-- @php
        dump($kawasan, $idKawasanTerpilih, $investasi);
    @endphp --}}
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
            this.investasi = data;
        }
    }">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
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
                                        <template x-if="$wire.tahun == new Date().getFullYear() && $wire.idRTTerpilih">
                                            <x-primary-button x-data=''
                                                x-on:click.prevent="$dispatch('open-modal',{name:'add-new-investasi',idKriteria :item.id})">{{ __('Tambah') }}</x-primary-button>
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
                                <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-900 dark:text-white">

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
                            <template x-if="$wire.idRTTerpilih && item.kegiatan !=undefined && item.locked !=2">
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
    @include('livewire.partials.modal-add-investasi')
    @include('components.alert')

</div>

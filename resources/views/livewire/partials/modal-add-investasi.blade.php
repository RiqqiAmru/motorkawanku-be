<x-modal name="add-new-investasi" :show="$errors->addNewUser->isNotEmpty()" maxWidth='lg' focusable>
    <form wire:submit="save; $dispatch('close');" method="post" class="p-6" x-data="{
        'kegiatanInvestasi': [{
                'kriteria': ['1a'],
                'kegiatan': ['Jalan Aspal Hotmix', 'Jalan Beton', 'Jalan Buras (Leburan Aspal)', 'Jalan Kayu/Titian/Jerambah Kayu', 'Jalan Lapen (Lapisan Penetrasi)', 'Jalan Makadam', 'Jalan Paving Block', 'Jalan Sirtu', 'Jalan Tanah', 'Jalan Telford', 'Pedestrian/Jalur Pejalan Kaki', 'Penataan Rumah Deret/Rumah Susun'],
                'satuan': 'Unit'
            },
            { 'kriteria': ['1b'], 'kegiatan': ['Penataan Rumah Deret/Rumah Susun'], 'satuan': 'Ha' }, {
                'kriteria': ['1c'],
                'kegiatan': ['Penataan Rumah Deret/Rumah Susun', 'Rehab/perbaikan Rumah Tidak Layak Huni (Aladin)'],
                'satuan': 'Unit'
            }, {
                'kriteria': ['2a', '2b'],
                'kegiatan': ['Jalan Aspal Hotmix', 'Jalan Beton', 'Jalan Buras (Leburan Aspal)', 'Jalan Kayu/Titian/Jerambah Kayu', 'Jalan Lapen (Lapisan Penetrasi)', 'Jalan Makadam', 'Jalan Paving Block', 'Jalan Sirtu', 'Jalan Tanah', 'Jalan Telford', 'Jembatan Besi', 'Jembatan Beton/Batu/Box Culvert', 'Jembatan Gantung', 'Jembatan Kayu', 'Jembatan Komposit', 'Jembatan Pelimpas', 'Pedestrian/Jalur Pejalan Kaki'],
                'satuan': 'Meter'
            }, {
                'kriteria': ['3a', '3b'],
                'kegiatan': ['Bak Pembagi', 'Hidran Umum ( HU )/Kran Umum (KU)', 'Instalasi Pengolahan Air Limbah (IPAL) Setempat/Terpusat', 'Instalasi Pengolahan Air Sederhana (IPAS)', 'Pelindung Mata Air ( PMA )', 'Penampung Air Hujan ( PAH )', 'Penangkap Air Permukaan ( PAP ) (Broncaptering/bakpengumpul)', 'Perpipaan', 'Sambungan Rumah', 'Septictank Komunal', 'Sumur Bor', 'Sumur Bor Dalam (SBD) / Sumur Arteris', 'Sumur Gali', 'Sumur Pompa Tangan ( SPT )'],
                'satuan': 'KK'
            }, {
                'kriteria': ['4a'],
                'kegiatan': ['Drainase Lingkungan', 'Gorong-gorong', 'Kolam Resapan', 'Normalisasi Saluran', 'Pintu Air', 'Pompa Air & Rumah Pompa', 'Resapan Biopori', 'Saluran Pembuangan Limbah rumah tangga, industri, sarana komersial,sarana umum (Grey Water)', 'Sumur Resapan Air Hujan', 'Tanggul Pengendali Banjir'],
                'satuan': 'Ha'
            }, {
                'kriteria': ['4b'],
                'kegiatan': ['Drainase Lingkungan', 'Gorong-gorong', 'Normalisasi Saluran', 'Saluran Pembuangan Limbah rumah tangga, industri, sarana komersial,sarana umum (Grey Water)', 'Sumur Resapan Air Hujan'],
                'satuan': 'Meter'
            }, {
                'kriteria': ['4c'],
                'kegiatan': ['Drainase Lingkungan', 'Gorong-gorong', 'Normalisasi Saluran', 'Penutup Saluran/Parit (Plat beton,dll)', 'Saluran Pembuangan Limbah rumah tangga, industri, sarana komersial,sarana umum (Grey Water)'],
                'satuan': 'Meter'
            }, {
                'kriteria': ['5a', '5b'],
                'kegiatan': ['Closet Leher Angsa', 'Instalasi Pengolahan Air Limbah (IPAL) Setempat/Terpusat', 'Jamban (closet+bak air+septictank+resapan)', 'Jaringan Perpipaan Pembuangan Air Limbah (Black Water)', 'Jaringan Perpipaan Pembuangan Air Limbah (Black Water)', 'MCK Mandi + Cuci + Kakus', 'Septictank Komunal'],
                'satuan': 'KK'
            }, {
                'kriteria': ['6a'],
                'kegiatan': ['Bak sampah 3R', 'Bangunan Pengolahan Sampah/TPS 3R', 'Gerobak/Motor Sampah', 'Komposter Sampah/TPS 3R (Peralatan Pengolahan)', 'Mobil Sampah', 'Tempat  Pengolahan  Sampah  Terpadu (TPST)', 'Tempat Pembuangan Sampah Sementara (TPS) 3R'],
                'satuan': 'KK'
            }, { 'kriteria': ['6b'], 'kegiatan': ['Gerobak/Motor Sampah', 'Mobil Sampah'], 'satuan': 'KK' },
            {
                'kriteria': ['7a'],
                'kegiatan': ['Jalan Aspal Hotmix', 'Jalan Beton', 'Jalan Buras (Leburan Aspal)', 'Jalan Kayu/Titian/Jerambah Kayu', 'Jalan Lapen (Lapisan Penetrasi)', 'Jalan Makadam', 'Jalan Paving Block', 'Jalan Sirtu', 'Jalan Tanah', 'Jalan Telford', 'Jaringan Perpipaan Proteksi Kebakaran', 'Jembatan Besi', 'Jembatan Beton/Batu/Box Culvert', 'Jembatan Kayu', 'Jembatan Pelimpas', 'Penyediaan Pasokan Air (Kolam penampungan air, Sumur Dalam/Hidran)'],
                'satuan': 'Unit'
            }, {
                'kriteria': ['7b'],
                'kegiatan': ['Alat Pemadam Api Ringan (APAR)', 'Mobil Pemadam Kebakaran', 'Motor Pemadam Kebakaran'],
                'satuan': 'Unit'
            }
        ],
        keg: '',
    }"
        x-on:open-modal.window="
        if ($event.detail.name === 'add-new-investasi') {
        keg = kegiatanInvestasi.find((a) =>
          a.kriteria.find((k) => k === idKriteria)
        );
        $wire.set('form.idKriteria',idKriteria)
        console.log(idKriteria);
    }
        ">
        @csrf
        @method('post')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-item='idKriteria'>
            {{ __('Tambah Investasi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('tambah investasi pembangunan wilayah') }}
        </p>

        <div class="mt-6  flex  items-center align-middle gap-2">
            <x-input-label for="kegiatan" value="{{ __('Kegiatan') }}" />
            <select wire:model="form.kegiatan" name="kegiatan" id="kegiatan" required
                class="border-gray-300  dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full overflow-hidden">
                <option value="">{{ __(' pilih kegiatan') }}</option>
                <template x-if="keg.kegiatan" class="text-wrap">
                    <template x-for="(item,index) in keg.kegiatan">
                        <option :value="item" x-text="item"></option>
                    </template>
                </template>
            </select>

        </div>

        <div class="mt-6  flex items-center align-middle gap-2">
            <x-input-label for="sumberAnggaran" value="{{ __('Sumber Anggaran') }}" />
            <select name="sumberAnggaran" id="sumberAnggaran" required wire:model="form.sumberAnggaran"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{ __('pilih Sumber Anggaran') }}</option>
                <option value="APBD">APBD</option>
                <option value="DAK">DAK</option>
                <option value="APBD Provinsi">APBD Provinsi</option>
                <option value="APBN">APBN</option>
                <option value="CSR">CSR</option>
                <option value="Dana Desa">Dana Desa</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mt-6 flex items-center align-middle gap-2 divide-x-2">
            <div class="flex items-center align-middle gap-2">
                <x-input-label for="volume" value="{{ __('Volume ') }}" class="sr-only" />
                <x-text-input id="volume" name="volume" type="number" class="mt-1 block w-full" min="0"
                    required :value="old('volume')" placeholder="{{ __('volume') }}" wire:model="form.volume" />
                <x-input-error :messages="$errors->addNewUser->get('volume')" class="mt-2" />
                <span x-text="keg.satuan">Unit</span>
            </div>
            <div class="p-2 flex items-center align-middle gap-2">
                <span>Rp</span>
                <x-input-label for="anggaran" value="{{ __('anggaran') }}" class="sr-only basis-0" />
                <x-text-input id="anggaran" name="anggaran" type="number" class="mt-1 block w-full " min="0"
                    required placeholder="{{ __('anggaran') }}" :value="old('anggaran')" wire:model="form.anggaran" />
                <x-input-error :messages="$errors->addNewUser->get('anggaran')" class="mt-2" />
            </div>
        </div>



        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" dusk='btn-add-investasi'>
                {{ __('add investasi') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

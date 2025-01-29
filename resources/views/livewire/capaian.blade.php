<div>
    <!-- use version 0.20.3 -->
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
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
        </ol>
    </nav>
    @if ($namaKawasan)
        {{-- button export --}}
        <div class="flex justify-end gap-2 mt-4">
            <button wire:click="export"
                class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600">Export
                Excel</button>
        </div>
    @endif
    {{-- tabel --}}


    <div class="overflow-x-auto rounded-lg border border-gray-200 mt-4">
        <table id="capaianTable"
            class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
            @if ($namaKawasan)
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th colspan="7">Data Capaian Kawasan Kumuh Wilayah {{ $namaKawasan['kawasan'] }} Tahun
                            {{ $tahun }}
                            <span></span>
                        </th>
                    </tr>
                    <tr></tr>
                </thead>
            @endif
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Wilayah / RT
                        <span></span>
                    </th>
                    @for ($i = 2019; $i <= $tahun; $i++)
                        <th colspan="2"
                            class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white border-l-2">
                            {{ $i == 2019 ? 'Baseline' : $i }}
                            <span></span>
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
                        @endforeach
                    </tr>
                @endif
                <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                    </td>
                </tr>
                @if ($kumuhRT && !empty($kumuhRT))
                    @foreach ($kumuhRT as $key => $item)
                        <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                {{ $daftarRT[$key] }}
                            </td>
                            @foreach ($item as $k)
                                <td title="total Nilai"
                                    class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 border-l-2">
                                    {{ $k->totalNilai }}</td>
                                <td title="tingkat kekumuhan"
                                    class="whitespace-nowrap px-4 py-2 text-center  {{ $k ? $k?->getWarnaAttribute()[1] : '' }}">
                                    {{ $k ? $k->getWarnaAttribute()[0] : '' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('capaianTable');
            const headers = table.querySelectorAll('th');
            let sortDirection = {}; // Menyimpan status urutan ASC/DESC per tahun
            let arrows = {}; // Untuk menyimpan arah panah pada header
            headers.forEach((header, index) => {
                const arrow = document.createElement('span');
                arrow.style.marginLeft = '10px';
                header.appendChild(arrow);

                header.addEventListener('click', function() {
                    const year = header.innerText.trim().replace(
                        /\s*[\u2190\u2191\u2192\u2193]\s*$/, ''
                    ); // Mendapatkan tahun dari header
                    const columnIndex = index; // Menyimpan indeks kolom yang diklik
                    if (!sortDirection[year]) {
                        sortDirection[year] = 'asc'; // Set default asc
                    } else {
                        sortDirection[year] = sortDirection[year] === 'asc' ? 'desc' : 'asc';
                    }

                    // Perbarui arah panah
                    updateArrow(header, sortDirection[year]);

                    // Menyortir baris berdasarkan tahun dan arah
                    sortTable(columnIndex, sortDirection[year]);
                });
            });

            function updateArrow(header, direction) {
                // hapus arrow untuk semua header
                headers.forEach(header => {
                    const arrow = header.querySelector('span');
                    if (arrow) {
                        arrow.textContent = '';
                    }
                });
                const arrow = header.querySelector('span');
                if (direction === 'asc') {
                    arrow.textContent = '↑'; // Panah naik
                } else {
                    arrow.textContent = '↓'; // Panah turun
                }
            }

            function sortTable(colIndex, direction) {
                const rows = Array.from(table.querySelectorAll('tbody tr')).slice(
                    2); // Mulai dari baris ke-3 (index 2)
                const isAscending = direction === 'asc';
                if (colIndex != 0) {
                    colIndex = colIndex * 2 - 1; // Karena setiap tahun memiliki 2 kolom
                }
                rows.sort((rowA, rowB) => {
                    const cellA = rowA.cells[colIndex].innerText.trim();
                    const cellB = rowB.cells[colIndex].innerText.trim();

                    // Bandingkan berdasarkan angka atau teks
                    if (isNaN(cellA) || isNaN(cellB)) {
                        return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                    } else {
                        return isAscending ? parseFloat(cellA) - parseFloat(cellB) : parseFloat(cellB) -
                            parseFloat(cellA);
                    }
                });

                // Menyusun ulang baris pada tabel
                rows.forEach(row => table.querySelector('tbody').appendChild(row));
            }

        });
    </script>
</div>

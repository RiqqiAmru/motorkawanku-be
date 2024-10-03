<div class='py-6 px-6'>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:gap-8 ">
        <div
            class="flex flex-col min-h-32   bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-2 py-2 gap-2">
            <div class="text-center">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Motor Kawanku</h1>
                <h6 class="font-light text-xs text-gray-800 dark:text-gray-200 leading-tight">Cek Kawasan Kumuh Kota
                    Pekalongan</h6>
            </div>
            <div class="h-64 bg-black shadow-sm sm:rounded-lg border-black"></div>
            <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700">
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900 dark:text-white">Kelurahan</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="0">Pilih Wilayah</option>
                                <option value="user">Kandang Panjang
                                </option>
                            </select>
                            Pekalongan Selatan
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900 dark:text-white">Wilayah RT/RW</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="0">Pilih RT/RW</option>
                                <option value="user">Kandang Panjang
                                </option>
                            </select>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900 dark:text-white">Tahun</dt>
                        <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="0">Pilih Tahun</option>
                                <option value="user">Kandang Panjang
                                </option>
                            </select>
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Luas Verifikasi (Ha)</dt>
                        <dd class="text-gray-700  dark:text-gray-200">Mr</dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Bangunan (Unit)</dt>
                        <dd class="text-gray-700  dark:text-gray-200">Mr</dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah Penduduk (Jiwa)</dt>
                        <dd class="text-gray-700  dark:text-gray-200">Mr</dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium sm:col-span-2 text-gray-900 dark:text-white">Jumlah KK (KK)</dt>
                        <dd class="text-gray-700  dark:text-gray-200">Mr</dd>
                    </div>
                </dl>
            </div>


        </div>
        <div
            class="flex flex-col gap-2 p-2   md:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

            <div>
                <div class="sm:hidden">
                    <label for="Tab" class="sr-only">Tab</label>

                    <select id="Tab"
                        class="w-full rounded-md border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <option>Settings</option>
                        <option>Messages</option>
                        <option>Archive</option>
                        <option select>Notifications</option>
                    </select>
                </div>

                <div class="hidden sm:block">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex gap-6">
                            <a href="#"
                                class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                Settings
                            </a>

                            <a href="#"
                                class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                Messages
                            </a>

                            <a href="#"
                                class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                Archive
                            </a>

                            <a href="#"
                                class="shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sky-600 dark:border-gray-600 dark:border-b-gray-950 dark:text-sky-300">
                                Notifications
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
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                Date of Birth
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Role</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                Salary
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                John Doe
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">24/05/1995</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">Web Developer</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">$120,000</td>
                        </tr>

                        <tr class="*:whitespace-nowrap *:px-4 *:py-2">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                Jane Doe
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">04/11/1980</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">Web Designer</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">$100,000</td>
                        </tr>

                        <tr class="*:whitespace-nowrap *:px-4 *:py-2">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                Gary Barlow
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">24/05/1995</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">Singer</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">$20,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

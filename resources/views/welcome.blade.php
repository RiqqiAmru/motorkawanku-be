<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Motor Kawanku</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-fixed object-cover "
    style="background-position:center; background-size: cover; background-image:url(/pekalongan.jpg)">
    <div class=" text-black/50  dark:text-white/50">
        <div
            class="relative min-h-screen  flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl min-h-screen flex flex-col justify-between px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 mt-10">
                    <div class="flex lg:justify-start ">
                        <img src="/kotaPekalongan.png" alt="logo kota pekalongan" class="h-24">
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:ring-2 hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>

                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="mt-6">

                    <div class="pb-12 text-center md:pb-16">
                        <div class="flex justify-center my-4">
                            <img src="/logo.png" alt="logo motorkawanku" class="h-24 drop-shadow-sm">
                        </div>
                        <h1 class="mb-6 drop-shadow-lg my-4 text-5xl font-extrabold text-red-600  md:text-9xl ">Motor
                            <span class="underline decoration-sky-500 text-white">Kawanku</span>
                        </h1>
                        <div class="mx-auto max-w-3xl bg-slate-200/15 rounded-full p-2">
                            <p class="mb-8 text-lg text-white drop-shadow-md ">E-Monitoring
                                Kawasan
                                Permukiman
                                Kumuh Kota Pekalongan</p>
                            <x-primary-button><a href="/guest" target="_blank"
                                    rel="noopener noreferrer">Lihat</a></x-primary-button>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center font-bold  shadow-lg drop-shadow-lg text-white">
                    <p> Dinas Perumahan Rakyat dan Kawasan Permukiman Kota Pekalongan &copy
                        {{ date_format(Date::now(), 'Y') }}
                    </p>
                </footer>

            </div>
        </div>
    </div>



</body>

</html>

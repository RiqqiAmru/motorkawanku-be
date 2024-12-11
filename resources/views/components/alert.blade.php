@props(['title' => null, 'type' => null])

<div class="fixed top-5 right-5 x-50" x-data="{ show: false, message: '', title: '' }" x-init="if (@js(session('success'))) {
    message = @js(session('success'));
    title = 'Chages Saved'
    show = true;
} else if (@js(session('error'))) {
    message = @js(session('error'));
    title = 'Error'
    show = true;
} else if (@js(session('info'))) {
    message = @js(session('info'));
    title = 'Info'
    show = true;
}
setTimeout(() => show = false, 5000)" x-show="show"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4">
    <div role="alert" dusk="alert-toast"
        class="shadow-lg rounded-xl border border-gray-100 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
        <div class="flex items-start gap-4">
            @if (session('success'))
                <span class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            @elseif(session('error'))
                <span class="text-red-600 dark:text-white">
                    <svg width="24px" height="24px" viewBox="0 0 512.00 512.00" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                        stroke="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>error</title>
                            <g id="Page-1" stroke-width="0.00512" fill="none" fill-rule="evenodd">
                                <g id="add" fill="#ff0000" transform="translate(42.666667, 42.666667)">
                                    <path
                                        d="M213.333333,3.55271368e-14 C331.136,3.55271368e-14 426.666667,95.5306667 426.666667,213.333333 C426.666667,331.136 331.136,426.666667 213.333333,426.666667 C95.5306667,426.666667 3.55271368e-14,331.136 3.55271368e-14,213.333333 C3.55271368e-14,95.5306667 95.5306667,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C119.232,42.6666667 42.6666667,119.232 42.6666667,213.333333 C42.6666667,307.434667 119.232,384 213.333333,384 C307.434667,384 384,307.434667 384,213.333333 C384,119.232 307.434667,42.6666667 213.333333,42.6666667 Z M262.250667,134.250667 L292.416,164.416 L243.498667,213.333333 L292.416,262.250667 L262.250667,292.416 L213.333333,243.498667 L164.416,292.416 L134.250667,262.250667 L183.168,213.333333 L134.250667,164.416 L164.416,134.250667 L213.333333,183.168 L262.250667,134.250667 Z"
                                        id="error"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
            @elseif(session('info'))
                <span class="text-blue-600 dark:text-white">
                    <svg width="24px" height="24px" viewBox="0 0 512 512" version="1.1" stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>alarm</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="add" fill="#0000ff" transform="translate(42.666667, 42.666667)">
                                    <path
                                        d="M213.333333,3.55271368e-14 C330.943502,3.55271368e-14 426.666667,95.7231591 426.666667,213.333333 C426.666667,330.943502 330.943502,426.666667 213.333333,426.666667 C95.7231591,426.666667 3.55271368e-14,330.943502 3.55271368e-14,213.333333 C3.55271368e-14,95.7231591 95.7231591,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C118.87459,42.6666667 42.6666667,118.87459 42.6666667,213.333333 C42.6666667,307.792077 118.87459,384 213.333333,384 C307.792077,384 384,307.792077 384,213.333333 C384,118.87459 307.792077,42.6666667 213.333333,42.6666667 Z M213.333333,272.042667 C228.571429,272.042667 240,283.306667 240,298.666667 C240,314.026667 228.571429,325.290667 213.333333,325.290667 C197.748918,325.290667 186.666667,314.026667 186.666667,298.325333 C186.666667,283.306667 198.095238,272.042667 213.333333,272.042667 Z M234.666667,85.3333333 L234.666667,234.666667 L192,234.666667 L192,85.3333333 L234.666667,85.3333333 Z"
                                        id="Combined-Shape"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
            @endif

            <div class="flex-1">
                <strong class="block font-medium text-gray-900 dark:text-white" x-text="title"> </strong>

                <p class="mt-1 text-sm text-gray-700 dark:text-gray-200" x-text="message"> </p>
            </div>

            <button @click="show=false"
                class="text-gray-500 transition hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-500">
                <span class="sr-only">Dismiss popup</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

</div>

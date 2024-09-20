@props(['title' => null, 'type' => null])

<div class="fixed top-5 right-5 x-50" x-data="{ show: false, message: '' }" x-init="if (@js(session('success'))) {
    message = @js(session('success'));
    show = true;
} else if (@js(session('error'))) {
    message = @js(session('error'));
    show = true;
}
setTimeout(() => show = false, 5000)" x-show="show"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4">
    <div role="alert"
        class="shadow-lg rounded-xl border border-gray-100 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
        <div class="flex items-start gap-4">
            <span class="text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>

            <div class="flex-1">
                <strong class="block font-medium text-gray-900 dark:text-white"> Changes saved </strong>

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

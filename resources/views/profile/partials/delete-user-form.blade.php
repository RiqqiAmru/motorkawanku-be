<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ketika akunmu di hapus, semua resource dan data akan dihapus secara permanen') }}
        </p>
    </header>

    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', {name:'confirm-user-deletion',id:1})">{{ __('Delete Account') }}
    </x-danger-button>

    @include('profile.partials.modal-delete-user')

</section>

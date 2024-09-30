<x-modal name="edit-user" :show="$errors->addNewUser->isNotEmpty()" maxWidth='lg' focusable>
    <form method="post" :action="'/users/' + id.id" class="p-6" x-data="{}">
        @csrf
        @method('patch')
        <input type="hidden" name="id" id="id" x-model='id.id'>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit User') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Edit user terdaftar di aplikasi') }}
        </p>
        <div class="mt-6 ">
            <x-input-label for="nama" value="{{ __('nama') }}" class="sr-only" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" required
                x-model='id.name' :value="old('nama')" placeholder="{{ __('nama') }}" />
            <x-input-error :messages="$errors->addNewUser->get('nama')" class="mt-2" />
        </div>

        <div class="mt-6 ">
            <x-input-label for="email" value="{{ __('email') }}" class="sr-only basis-0" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full " required
                placeholder="{{ __('email') }}" :value="old('email')" x-model='id.email' />
            <x-input-error :messages="$errors->addNewUser->get('email')" class="mt-2" />

        </div>
        <div class="mt-6 flex">
            <x-input-label for="role" value="{{ __('Role') }}"
                class="inline-flex items-center px-4 py-2 font-semibold text-2xl" />
            <select name="role" id="role" x-model='id.role'
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="user" @if (old('role') == 'user') selected @endif>User
                </option>
                <option value="admin" @if (old('role') == 'admin') selected @endif>Admin</option>
            </select>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('edit user') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

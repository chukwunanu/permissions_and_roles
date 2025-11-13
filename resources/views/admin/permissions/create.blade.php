<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Permission') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex mb-3">
                <a href="{{ route('admin.permissions.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Back</a>
            </div>
            <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-900">Permission</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-gray-100 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                    <input id="name" type="text" name="name" placeholder="can edit" class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm" />
                                </div>

                                <div class="mt-2 text-sm text-red-600">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-end gap-x-6">
                            <x-secondary-button>Cancel</x-secondary-button>
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

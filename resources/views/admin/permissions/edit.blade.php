<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-900">Edit Permission</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-gray-100 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                    <input id="name" type="text" name="name" class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm" value="{{ $permission->name }}" />
                                </div>

                                <div class="mt-2 text-sm text-red-600">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-end gap-x-2">
                            <x-cancel-button>Cancel</x-cancel-button>
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>

                    <div class="mt-6 p-2">
                        <h2>Role(s)</h2>
                        <div>
                            @if ($permission->roles)
                            <ul class="list-disc list-inside">
                                @foreach($permission->roles as $permission_role)
                                <form action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit" class="font-medium text-red-600 hover:underline">{{ $permission_role->name }}</x-danger-button>
                                </form>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="max-w-xl">
                            <form action="{{ route('admin.permissions.roles', $permission->id) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="sm:col-span-4">
                                    <label for="role" class="block text-sm font-medium text-gray-900">Roles</label>
                                    <div class="mt-2">
                                        <select id="role" name="role" multiple class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-2 text-sm text-red-600">
                                        @error('role')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 flex items-center justify-end gap-x-2">
                                    <x-primary-button>Update</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="mb-4">
                <h3 class="text-lg font-bold">User Information</h3>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Roles:</strong> {{ implode(', ', $user->roles->pluck('name')->toArray()) }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-700">
                    Edit User
                </a>
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-700">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

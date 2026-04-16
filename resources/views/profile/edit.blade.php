<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl font-bold mb-6">Profile Settings</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Avatar</label>
                <input type="file" name="avatar" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm w-full p-2 border">
            </div>

            @if(auth()->user()->avatar)
    <div class="mb-4">
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border border-gray-300">
    </div>
@endif

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Update Profile
            </button>
        </form>
    </div>
</x-app-layout>
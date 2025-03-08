@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight mb-8 text-gray-900 dark:text-gray-100">Edit Member</h2>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Field: Name -->
                    <div class="space-y-4">
                        <label for="name" class="block text-base font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            value="{{ isset($user) ? $user->name : $admin->name }}" placeholder="Enter member name">
                    </div>

                    <!-- Field: Username -->
                    <div class="space-y-4">
                        <label for="username" class="block text-base font-medium text-gray-700 dark:text-gray-300">Username</label>
                        <input type="text" name="username" id="username"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            value="{{ isset($user) ? $user->username : $admin->username }}" placeholder="Enter username">
                    </div>

                    <!-- Field: Mobile -->
                    <div class="space-y-4">
                        <label for="mobile" class="block text-base font-medium text-gray-700 dark:text-gray-300">Mobile</label>
                        <input type="text" name="mobile" id="mobile"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            value="{{ isset($user) ? $user->mobile : $admin->mobile }}" placeholder="Enter mobile number">
                    </div>

                    <!-- Field: Email -->
                    <div class="space-y-4">
                        <label for="email" class="block text-base font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            value="{{ isset($user) ? $user->email : $admin->email }}" placeholder="Enter email address">
                    </div>

                    <!-- Field: Status -->
                    <div class="space-y-4">
                        <label for="status" class="block text-base font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <input type="text" name="status" id="status" value="Active" readonly
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-300 bg-gray-100 dark:bg-gray-300 text-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4 cursor-not-allowed">
                    </div>
                    </div>

                <!-- Submit Button -->
                <div class="mt-10">
                    <button type="submit"
                        class="bg-[#24b0ba] dark:bg-[#24b0ba]/80 text-white px-8 py-3 rounded-lg hover:bg-[#73c7e3] dark:hover:bg-[#73c7e3]/80 transition duration-300 text-base font-medium">
                        Update Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
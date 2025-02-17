@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight mb-8">Add New Member</h2>
        <div class="bg-white rounded-lg shadow-sm p-8">
            <form action="" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label for="name" class="block text-base font-medium text-gray-700">Member Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Enter member name">
                    </div>

                    <div class="space-y-4">
                        <label for="mobile" class="block text-base font-medium text-gray-700">Mobile</label>
                        <input type="text" name="mobile" id="mobile"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Enter mobile number">
                    </div>

                    <div class="space-y-4">
                        <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4"
                            placeholder="Enter email address">
                    </div>

                    <div class="space-y-4">
                        <label for="status" class="block text-base font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base h-12 px-4">
                            <option value="">Select status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 text-base font-medium">
                        Save Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
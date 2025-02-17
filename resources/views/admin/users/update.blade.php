@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight">Edit Member</h2>
        <div class="mt-6">
            <form action="{{ route('members.update', $member->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Member Name</label>
                        <input type="text" name="name" id="name" value="{{ $member->name }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                        <input type="text" name="mobile" id="mobile" value="{{ $member->mobile }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $member->email }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Active" {{ $member->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $member->status == 'Inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Update
                        Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
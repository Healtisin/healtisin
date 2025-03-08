<!-- Modal Settings -->
<div id="settingsModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-xl p-6 relative">
        <!-- Close Button -->
        <button onclick="closeSettingsModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Profile Section -->
        <div class="flex flex-col items-center mb-6">
            <div class="w-24 h-24 bg-[#24b0ba] rounded-full flex items-center justify-center shadow-lg">
                @if(auth('admin')->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth('admin')->user()->profile_photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover">
                @else
                    <span class="text-white text-2xl font-bold">{{ substr(auth('admin')->user()->name, 0, 1) }}</span>
                @endif
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ auth('admin')->user()->name }}</h2>
            <p class="text-gray-500 dark:text-gray-300">{{ auth('admin')->user()->email }}</p>
        </div>
        
        <!-- Action Buttons -->
        <div class="grid grid-cols-3 gap-4 text-center mb-6">
            <button class="p-3 rounded-lg bg-[#24b0ba] text-white font-semibold shadow-md hover:bg-[#1c8a8f] transition duration-300" onclick="toggleSection('updateProfile')">Profile</button>
            <button class="p-3 rounded-lg bg-[#24b0ba] text-white font-semibold shadow-md hover:bg-[#1c8a8f] transition duration-300" onclick="toggleSection('changePassword')">Password</button>
            <button class="p-3 rounded-lg bg-[#24b0ba] text-white font-semibold shadow-md hover:bg-[#1c8a8f] transition duration-300" onclick="toggleSection('uploadPhoto')">Photo</button>
        </div>
        
        <!-- Forms Container -->
        <div class="mt-6 space-y-6">
            <!-- Update Profile Form -->
            <div id="updateProfile" class="hidden">
                <form action="{{ route('settings.updateProfile') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Name" value="{{ auth('admin')->user()->name }}" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <input type="text" name="username" placeholder="Username" value="{{ auth('admin')->user()->username }}" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <input type="text" name="phone" placeholder="Phone" value="{{ auth('admin')->user()->phone }}" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <input type="email" name="email" placeholder="Email" value="{{ auth('admin')->user()->email }}" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <button type="submit" class="w-full p-3 bg-[#24b0ba] text-white rounded-md shadow-md hover:bg-[#1c8a8f] transition duration-300">Update Profile</button>
                </form>
            </div>
            
            <!-- Change Password Form -->
            <div id="changePassword" class="hidden">
                <form action="{{ route('settings.changePassword') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="password" name="current_password" placeholder="Current Password" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <input type="password" name="new_password" placeholder="New Password" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" class="w-full p-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#24b0ba] focus:border-[#24b0ba] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <button type="submit" class="w-full p-3 bg-[#24b0ba] text-white rounded-md shadow-md hover:bg-[#1c8a8f] transition duration-300">Change Password</button>
                </form>
            </div>
            
            <!-- Upload Photo Form -->
            <div id="uploadPhoto" class="hidden">
                <form action="{{ route('settings.uploadPhoto') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="file" name="profile_photo" class="w-full p-3 rounded-md border border-gray-300">
                    <button type="submit" class="w-full p-3 bg-[#24b0ba] text-white rounded-md shadow-md">Upload Photo</button>
                </form>
                <form action="{{ route('settings.deletePhoto') }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full p-3 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600">Delete Photo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSection(section) {
    // Sembunyikan semua form
    document.getElementById('updateProfile').classList.add('hidden');
    document.getElementById('changePassword').classList.add('hidden');
    document.getElementById('uploadPhoto').classList.add('hidden');
    
    // Tampilkan form yang dipilih
    document.getElementById(section).classList.remove('hidden');
}

function closeSettingsModal() {
    document.getElementById('settingsModal').classList.add('hidden');
}
</script>
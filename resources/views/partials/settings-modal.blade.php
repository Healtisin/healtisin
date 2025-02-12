<div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-[900px]">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-xl font-semibold">Perincian akun</h3>
            <button onclick="closeSettingsModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <div class="grid grid-cols-2 gap-12 relative">
                <!-- Left Column -->
                <div class="space-y-6 px-4">
                    <div>
                        <h4 class="text-lg font-medium mb-4">Perincian untuk masuk dan nama</h4>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Kata sandi</label>
                            <div class="relative">
                                <input type="password" 
                                       value="••••••••" 
                                       class="w-full px-3 py-2 border rounded-md bg-gray-50" 
                                       readonly>
                            </div>
                            <button onclick="showChangePasswordModal()" class="text-blue-500 text-sm mt-1">Ubah</button>
                        </div>

                        <!-- Display Name -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-1">Nama yang ditampilkan</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded-md bg-gray-50" readonly>
                            <button onclick="showChangeNameModal()"  class="text-blue-500 text-sm mt-1">Ubah</button>
                        </div>

                        <!-- Two Factor Auth -->
                        <div class="mt-6">
                            <h4 class="text-sm font-medium mb-2">Atur autentikasi dua faktor untuk akun pribadi Anda</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Dinonaktifkan</span>
                                <button class="text-blue-500 text-sm">Aktifkan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vertical Divider -->
                <div class="absolute left-1/2 top-0 bottom-0 -ml-px">
                    <div class="w-[1px] h-full bg-gray-200"></div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6 px-4">
                    <!-- Language Settings -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Bahasa</h4>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Indonesia</span>
                            <button class="text-blue-500 text-sm">Ubah</button>
                        </div>
                    </div>

                    <!-- Account Upgrade -->
                    <div>
                        <h4 class="text-lg font-medium mb-4">Tingkatkan akun Anda</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Tingkatkan ke Healtisin Pro untuk mendapatkan fitur premium lainnya.
                        </p>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Bandingkan paket langganan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="mt-8 pt-6 border-t px-4">
                <button class="text-red-500 text-sm hover:underline">Hapus akun</button>
            </div>
        </div>
    </div>
</div>

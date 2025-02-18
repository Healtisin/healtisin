<div id="deleteChatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[60]">
    <div class="bg-white rounded-lg w-[400px] p-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-medium text-red-600">Hapus Chat</h4>
            <button onclick="closeDeleteChatModal()" class="p-1 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="mb-6">
            <div class="bg-red-50 border-l-4 border-red-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-600">Apakah Anda yakin ingin menghapus chat ini?</p>
                        <p class="text-sm text-red-500 mt-2">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteChatModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                Batal
            </button>
            <button onclick="confirmDeleteChat()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Hapus
            </button>
        </div>
    </div>
</div>
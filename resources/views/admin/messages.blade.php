@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Manajemen Pesan</h2>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                Pengirim
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                Subjek
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                Waktu Diterima
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $index => $message)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <div class="flex items-center">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 whitespace-nowrap font-medium">{{ $message->name }}</p>
                                        <p class="text-gray-600 dark:text-gray-400 whitespace-nowrap text-xs">{{ $message->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100">
                                {{ Str::limit($message->subject, 50) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <div>
                                    <p class="text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $message->formatted_date }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 whitespace-nowrap text-xs">{{ $message->formatted_time }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <div class="flex space-x-3">
                                    <button type="button" onclick="viewMessage({{ $message->id }})" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $message->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center text-gray-500 dark:text-gray-400">
                                Belum ada pesan yang diterima.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pesan -->
<div id="messageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-3xl w-full mx-auto overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200" id="modalTitle">Detail Pesan</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pengirim:</p>
                        <p class="font-semibold text-gray-900 dark:text-gray-100" id="modalName"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Email:</p>
                        <p class="font-semibold text-gray-900 dark:text-gray-100" id="modalEmail"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal:</p>
                        <p class="font-semibold text-gray-900 dark:text-gray-100" id="modalDate"></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Subjek:</p>
                    <p class="font-semibold text-gray-900 dark:text-gray-100" id="modalSubject"></p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pesan:</p>
                    <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-800 dark:text-gray-200 whitespace-pre-line" id="modalMessage"></div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 rounded">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Data pesan dalam format JSON
    const messages = @json($messages);
    
    // Fungsi untuk melihat detail pesan
    function viewMessage(id) {
        // Gunakan AJAX untuk mendapatkan data pesan dari server
        fetch(`{{ url('admin/messages') }}/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Tidak dapat mengambil data pesan');
                }
                return response.json();
            })
            .then(message => {
                document.getElementById('modalName').textContent = message.name;
                document.getElementById('modalEmail').textContent = message.email;
                document.getElementById('modalSubject').textContent = message.subject;
                document.getElementById('modalMessage').textContent = message.message;
                
                // Format tanggal menggunakan atribut yang sudah diformat
                document.getElementById('modalDate').textContent = `${message.formatted_date} ${message.formatted_time}`;
                
                // Tampilkan modal
                document.getElementById('messageModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data pesan');
            });
    }
    
    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('messageModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Fungsi untuk konfirmasi hapus
    function confirmDelete(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pesan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: document.documentElement.classList.contains('dark') ? '#1F2937' : '#FFFFFF',
                color: document.documentElement.classList.contains('dark') ? '#FFFFFF' : '#000000'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    }
    
    // Menutup modal saat mengklik di luar modal
    document.getElementById('messageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Menutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('messageModal').classList.contains('hidden')) {
            closeModal();
        }
    });
</script>

@endsection
<script>
function confirmClearLogs() {
    Swal.fire({
        title: 'Hapus Semua Log?',
        text: "Anda akan menghapus semua log pada tanggal {{ $selectedDate->format('d M Y') }}. Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('clearLogsForm').submit();
        }
    });
}

function confirmDeleteLog(logId) {
    Swal.fire({
        title: 'Hapus Log?',
        text: "Anda akan menghapus log ini. Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteLogForm-' + logId).submit();
        }
    });
}
</script> 
import './bootstrap';
import PerfectScrollbar from 'perfect-scrollbar';
import 'perfect-scrollbar/css/perfect-scrollbar.css';

// Inisialisasi saat DOM sudah siap
document.addEventListener('DOMContentLoaded', function() {
    initializePerfectScrollbar();
});

function initializePerfectScrollbar() {
    // Scrollbar untuk area chat messages
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        // Pastikan elemen memiliki posisi relatif
        chatMessages.style.position = 'relative';
        
        // Simpan instance untuk digunakan nanti
        window.chatMessagesPS = new PerfectScrollbar(chatMessages, {
            wheelSpeed: 1,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    }
    
    // Scrollbar untuk riwayat chat di sidebar
    const chatHistory = document.querySelector('.chat-history');
    if (chatHistory) {
        chatHistory.style.position = 'relative';
        window.chatHistoryPS = new PerfectScrollbar(chatHistory, {
            wheelSpeed: 1,
            wheelPropagation: false,
            minScrollbarLength: 20
        });
    }
    
    // Inisialisasi untuk sidebar admin
    const adminSidebar = document.querySelector('#sidebar .scrollbar-hide');
    if (adminSidebar) {
        new PerfectScrollbar(adminSidebar, {
            wheelSpeed: 1,
            wheelPropagation: false,
            minScrollbarLength: 20
        });
    }
}


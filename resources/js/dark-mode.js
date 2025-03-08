// Fungsi untuk memeriksa preferensi tema dari localStorage atau preferensi sistem
function initDarkMode() {
    // Cek apakah pengguna sudah memiliki preferensi tema di localStorage
    const isDarkMode = localStorage.getItem('theme') === 'dark';
    const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Jika ada preferensi di localStorage, gunakan itu
    // Jika tidak, gunakan preferensi sistem
    if (isDarkMode || (!localStorage.getItem('theme') && isSystemDark)) {
        document.documentElement.classList.add('dark');
        updateThemeIcons(true);
    } else {
        document.documentElement.classList.remove('dark');
        updateThemeIcons(false);
    }
}

// Fungsi untuk mengubah tema
function toggleDarkMode() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        updateThemeIcons(false);
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        updateThemeIcons(true);
    }
}

// Fungsi untuk memperbarui ikon tema
function updateThemeIcons(isDark) {
    // Desktop icons
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    
    // Mobile icons
    const mobileDarkIcon = document.getElementById('mobile-theme-toggle-dark-icon');
    const mobileLightIcon = document.getElementById('mobile-theme-toggle-light-icon');
    
    if (darkIcon && lightIcon) {
        darkIcon.classList.toggle('hidden', isDark);
        lightIcon.classList.toggle('hidden', !isDark);
    }
    
    if (mobileDarkIcon && mobileLightIcon) {
        mobileDarkIcon.classList.toggle('hidden', isDark);
        mobileLightIcon.classList.toggle('hidden', !isDark);
    }
}

// Inisialisasi dark mode saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    initDarkMode();
    
    // Tambahkan event listener untuk tombol toggle tema
    const themeToggleBtn = document.getElementById('theme-toggle');
    const mobileThemeToggleBtn = document.getElementById('mobile-theme-toggle');
    
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', toggleDarkMode);
    }
    
    if (mobileThemeToggleBtn) {
        mobileThemeToggleBtn.addEventListener('click', toggleDarkMode);
    }
});

// Export fungsi untuk digunakan di tempat lain jika perlu
export { initDarkMode, toggleDarkMode }; 
<!-- Dark Mode initialization script -->
<script>
    // Immediately set the theme before the page renders to prevent flashing
    (function() {
        // Check if user has a theme preference in localStorage
        const theme = localStorage.getItem('theme');
        
        // If theme preference exists in localStorage, use that
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (theme === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            // If no preference, check system preference
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        }
    })();
</script>
@vite('resources/js/dark-mode.js') 
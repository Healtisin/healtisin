<header class="fixed top-0 left-0 right-0 bg-white z-50 p-4 transition-shadow duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            <div class="flex-shrink-0">
                <a href="/" class="text-xl font-bold">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
                </a>
            </div>
            <nav class="flex items-center gap-8 text-md font-semibold">
                <nav class="flex items-center gap-8 font-styrene text-gray-600">
                    <div class="flex items-center gap-1 cursor-pointer hover:text-[#24b0ba]">
                        <span>Healtisin</span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <!-- <a href="/riset" class="hover:text-gray-600">Riset</a> -->
                    <a href="/perusahaan" class="hover:text-[#24b0ba]">Perusahaan</a>
                    <a href="/karier" class="hover:text-[#24b0ba]">Karier</a>
                    <a href="/berita" class="hover:text-[#24b0ba]">Berita</a>
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-white bg-[#24b0ba] rounded-full hover:bg-[#73c7e3]">
                        Cobalah Healtisin
                    </a>
                </nav>
        </div>
    </div>
</header>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 0) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });
</script>
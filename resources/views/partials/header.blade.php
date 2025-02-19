<header class="fixed top-0 left-0 right-0 bg-white z-50 p-4 transition-shadow duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            <div class="flex-shrink-0">
                <a href="/" class="text-xl font-bold">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
                </a>
            </div>

            <!-- Mobile -->
            <div class="flex md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-[#24b0ba] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Desktop -->
            <nav class="hidden md:flex items-center gap-8 font-styrene text-gray-600 text-md font-semibold">
                <div class="relative">
                    <div id="healtisin-dropdown-trigger"
                        class="flex items-center gap-1 cursor-pointer hover:text-[#24b0ba]">
                        <span>Healtisin</span>
                        <svg id="dropdown-icon" class="w-4 h-4 rotate-icon" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div id="healtisin-dropdown"
                        class="absolute hidden mt-2 w-48 bg-white rounded-lg shadow-lg transition-opacity duration-300 ease-in-out opacity-0">
                        <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-700 hover:text-[#24b0ba]">Tentang Kami</a>
                        <a href="/hubungi-kami" class="block px-4 py-2 text-gray-700 hover:text-[#24b0ba]">Hubungi Kami</a>
                        <a href="/bantuan" class="block px-4 py-2 text-gray-700 hover:text-[#24b0ba]">Bantuan</a>
                    </div>
                </div>
                <a href="/perusahaan" class="hover:text-[#24b0ba]">Pricing</a>
                <a href="{{ route('faq') }}" class="hover:text-[#24b0ba]">FAQ</a>
                <a href="{{ route('news.index') }}" class="hover:text-[#24b0ba]">Berita</a>
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white bg-[#24b0ba] rounded-full hover:bg-[#73c7e3]">
                    Cobalah Healtisin
                </a>
            </nav>
        </div>

        <!-- Mobile -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 font-styrene font-bold">
            <div class="flex flex-col gap-4">
                <div class="relative">
                    <div id="mobile-healtisin-dropdown-trigger"
                        class="flex items-center gap-1 cursor-pointer hover:text-[#24b0ba]">
                        <span>Healtisin</span>
                        <svg id="mobile-dropdown-icon" class="w-4 h-4 rotate-icon" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div id="mobile-healtisin-dropdown" class="hidden mt-2 pl-4">
                        <a href="/fitur1"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#24b0ba] hover:text-white">Fitur 1</a>
                        <a href="/fitur2"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#24b0ba] hover:text-white">Fitur 2</a>
                        <a href="/fitur3"
                            class="block px-4 py-2 text-gray-700 hover:bg-[#24b0ba] hover:text-white">Fitur 3</a>
                    </div>
                </div>
                <a href="/perusahaan" class="hover:text-[#24b0ba]">Pricing</a>
                <a href="{{ route('faq') }}" class="hover:text-[#24b0ba]">FAQ</a>
                <a href="{{ route('news.index') }}" class="hover:text-[#24b0ba]">Berita</a>
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white bg-[#24b0ba] rounded-full hover:bg-[#73c7e3]">
                    Cobalah Healtisin
                </a>
            </div>
        </div>
    </div>
</header>

<style>
    .rotate-icon {
        transition: transform 0.3s ease-in-out;
    }

    .rotate-icon.rotate-180 {
        transform: rotate(180deg);
    }
</style>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 0) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });

    const dropdownTrigger = document.getElementById('healtisin-dropdown-trigger');
    const dropdownMenu = document.getElementById('healtisin-dropdown');
    const dropdownIcon = document.getElementById('dropdown-icon');

    dropdownTrigger.addEventListener('click', function() {
        const isHidden = dropdownMenu.classList.contains('hidden');
        if (isHidden) {
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.remove('opacity-0');
            dropdownMenu.classList.add('opacity-100');
            dropdownIcon.classList.add('rotate-180');
        } else {
            dropdownMenu.classList.add('opacity-0');
            dropdownIcon.classList.remove('rotate-180');
            setTimeout(() => {
                dropdownMenu.classList.add('hidden');
            }, 300);
        }
    });

    const mobileDropdownTrigger = document.getElementById('mobile-healtisin-dropdown-trigger');
    const mobileDropdownMenu = document.getElementById('mobile-healtisin-dropdown');
    const mobileDropdownIcon = document.getElementById('mobile-dropdown-icon');

    mobileDropdownTrigger.addEventListener('click', function() {
        const isHidden = mobileDropdownMenu.classList.contains('hidden');
        if (isHidden) {
            mobileDropdownMenu.classList.remove('hidden');
            mobileDropdownIcon.classList.add('rotate-180');
        } else {
            mobileDropdownMenu.classList.add('hidden');
            mobileDropdownIcon.classList.remove('rotate-180');
        }
    });

    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        const isHidden = mobileMenu.classList.contains('hidden');
        if (isHidden) {
            mobileMenu.classList.remove('hidden');
        } else {
            mobileMenu.classList.add('hidden');
        }
    });

    document.addEventListener('click', function(event) {
        if (!dropdownTrigger.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('opacity-0');
            dropdownIcon.classList.remove('rotate-180');
            setTimeout(() => {
                dropdownMenu.classList.add('hidden');
            }, 300);
        }

        if (!mobileDropdownTrigger.contains(event.target) && !mobileDropdownMenu.contains(event.target)) {
            mobileDropdownMenu.classList.add('hidden');
            mobileDropdownIcon.classList.remove('rotate-180');
        }

        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
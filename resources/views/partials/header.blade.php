<header
    class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 z-50 p-4 transition-shadow transition-colors duration-300"
    id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-xl font-bold">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex md:hidden">
                <button id="mobile-menu-button"
                    class="text-gray-600 dark:text-gray-300 hover:text-[#24b0ba] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <nav
                class="hidden md:flex items-center gap-6 lg:gap-8 font-styrene text-gray-600 dark:text-gray-300 text-sm lg:text-md font-semibold">
                <a href="/" class="hover:text-[#24b0ba]">Beranda</a>
                <div class="relative">
                    <div id="healtisin-dropdown-trigger"
                        class="flex items-center gap-1 cursor-pointer hover:text-[#24b0ba]">
                        <span>Tentang Kami</span>
                        <svg id="dropdown-icon" class="w-4 h-4 rotate-icon" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div id="healtisin-dropdown"
                        class="absolute hidden mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg transition-opacity duration-300 ease-in-out opacity-0 shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="py-1">
                            <a href="{{ route('about') }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-[#24b0ba] hover:bg-gray-50 dark:hover:bg-gray-700">Tentang
                                Healtisin</a>
                            <a href="{{ route('faq') }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-[#24b0ba] hover:bg-gray-50 dark:hover:bg-gray-700">FAQ</a>
                            <a href="/bantuan"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-[#24b0ba] hover:bg-gray-50 dark:hover:bg-gray-700">Bantuan</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('news.index') }}" class="hover:text-[#24b0ba]">Berita</a>
                <a href="{{ route('contact') }}" class="hover:text-[#24b0ba]">Kontak</a>
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white bg-[#24b0ba] rounded-full hover:bg-[#73c7e3]">
                    Cobalah Healtisin
                </a>
                <!-- Language and Theme Group -->
                <div class="flex items-center gap-2">
                    <!-- Language Button -->
                    <div class="relative">
                        <div id="language-dropdown-trigger"
                            class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 dark:text-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                            </svg>
                        </div>
                        <div id="language-dropdown"
                            class="absolute hidden right-0 mt-2 w-36 bg-white dark:bg-gray-800 rounded-lg transition-opacity duration-300 ease-in-out opacity-0 shadow-lg border border-gray-100 dark:border-gray-700">
                            <div class="py-1">
                                <button onclick="changeLanguage('id')"
                                    class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-[#24b0ba] hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center justify-between">
                                    <span>Indonesia</span>
                                    <span id="lang-id-check" class="{{ App::getLocale() == 'id' ? '' : 'hidden' }}">
                                        <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                </button>
                                <button onclick="changeLanguage('en')"
                                    class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-[#24b0ba] hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center justify-between">
                                    <span>English</span>
                                    <span id="lang-en-check" class="{{ App::getLocale() == 'en' ? '' : 'hidden' }}">
                                        <svg class="w-4 h-4 text-[#24b0ba]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Theme Button -->
                    <button id="theme-toggle"
                        class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-600 dark:text-gray-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 font-styrene font-bold">
            <div class="flex flex-col gap-4">
                <a href="/" class="hover:text-[#24b0ba]">Beranda</a>
                <div class="relative">
                    <div id="mobile-healtisin-dropdown-trigger"
                        class="flex items-center gap-1 cursor-pointer hover:text-[#24b0ba]">
                        <span>Tentang Kami</span>
                        <svg id="mobile-dropdown-icon" class="w-4 h-4 rotate-icon" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <div id="mobile-healtisin-dropdown"
                        class="hidden mt-2 pl-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="py-1">
                            <a href="{{ route('about') }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-[#24b0ba] hover:text-white">Tentang
                                Healtisin</a>
                            <a href="{{ route('faq') }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-[#24b0ba] hover:text-white">FAQ</a>
                            <a href="/bantuan"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-[#24b0ba] hover:text-white">Bantuan</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('news.index') }}" class="hover:text-[#24b0ba]">Berita</a>
                <a href="{{ route('contact') }}" class="hover:text-[#24b0ba]">Kontak</a>
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-white bg-[#24b0ba] rounded-full hover:bg-[#73c7e3]">
                    Cobalah Healtisin
                </a>
                <!-- Language & Theme Settings for Mobile -->
                <div class="flex justify-center items-center mt-2">
                    <div class="flex">
                        <div class="relative">
                            <button id="mobile-language-button"
                                class="flex items-center gap-2 px-2 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 dark:text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                <span>Bahasa</span>
                            </button>
                            <div id="mobile-language-dropdown"
                                class="hidden absolute left-0 mt-2 w-36 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700">
                                <div class="py-1">
                                    <button onclick="changeLanguage('id')"
                                        class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-[#24b0ba] hover:text-white flex items-center justify-between">
                                        <span>Indonesia</span>
                                        <span id="mobile-lang-id-check"
                                            class="{{ App::getLocale() == 'id' ? '' : 'hidden' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                    </button>
                                    <button onclick="changeLanguage('en')"
                                        class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-[#24b0ba] hover:text-white flex items-center justify-between">
                                        <span>English</span>
                                        <span id="mobile-lang-en-check"
                                            class="{{ App::getLocale() == 'en' ? '' : 'hidden' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button id="mobile-theme-toggle"
                            class="flex items-center gap-2 px-2 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 ml-1">
                            <svg id="mobile-theme-toggle-dark-icon" class="w-5 h-5 text-gray-600 dark:text-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg id="mobile-theme-toggle-light-icon"
                                class="hidden w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Tema</span>
                        </button>
                    </div>
                </div>
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

        // Language dropdown handler
        if (!languageDropdownTrigger.contains(event.target) && !languageDropdown.contains(event.target)) {
            languageDropdown.classList.add('opacity-0');
            setTimeout(() => {
                languageDropdown.classList.add('hidden');
            }, 300);
        }

        // Mobile language dropdown handler
        if (!mobileLangButton.contains(event.target) && !mobileLangDropdown.contains(event.target)) {
            mobileLangDropdown.classList.add('hidden');
        }
    });

    // Language dropdown functionality
    const languageDropdownTrigger = document.getElementById('language-dropdown-trigger');
    const languageDropdown = document.getElementById('language-dropdown');

    languageDropdownTrigger.addEventListener('click', function() {
        const isHidden = languageDropdown.classList.contains('hidden');
        if (isHidden) {
            languageDropdown.classList.remove('hidden');
            languageDropdown.classList.remove('opacity-0');
            languageDropdown.classList.add('opacity-100');
        } else {
            languageDropdown.classList.add('opacity-0');
            setTimeout(() => {
                languageDropdown.classList.add('hidden');
            }, 300);
        }
    });

    // Mobile language dropdown
    const mobileLangButton = document.getElementById('mobile-language-button');
    const mobileLangDropdown = document.getElementById('mobile-language-dropdown');

    mobileLangButton.addEventListener('click', function() {
        const isHidden = mobileLangDropdown.classList.contains('hidden');
        if (isHidden) {
            mobileLangDropdown.classList.remove('hidden');
        } else {
            mobileLangDropdown.classList.add('hidden');
        }
    });
</script>
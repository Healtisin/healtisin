<aside id="sidebar" class="h-screen w-auto bg-white dark:bg-gray-800 flex flex-col transition-all duration-300">
    <div class="p-4 flex items-center justify-between bg-white dark:bg-gray-800">
        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img id="logoImage" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 transition-all duration-300">
        </a>

        <!-- Ikon Collapse -->
        <button id="collapseButton"
            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">
            <img src="{{ asset('images/collapse.svg') }}" alt="Collapse" class="h-6 w-6">
        </button>
    </div>

    <div id="sidebarContent" class="flex-1 overflow-y-auto p-4 scrollbar-hide" style="max-height: calc(100vh - 96px);">
        <ul class="space-y-3">
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Dashboard</p>
                    </div>
                </a>
            </li>

            <li class="w-full text-left rounded-lg">
                <button onclick="toggleUsers()"
                    class="w-full p-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-4">
                        <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path
                                    d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l448 0c53 0 96-43 96-96l0-320c0-53-43-96-96-96L96 0zM64 96c0-17.7 14.3-32 32-32l448 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32L64 96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0C119.9 256 96 279.9 96 309.3zM461.2 336l56.1 0c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z" />
                            </svg>
                        </span>
                        <div class="min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">User</p>
                        </div>
                        <svg id="users-arrow" class="w-4 h-4 transition-transform duration-200 ml-auto"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="users-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.users') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.users') ? 'active' : '' }}">
                        Pengguna
                    </a>
                    <a href="{{ route('admin.admins') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.admins') ? 'active' : '' }}">
                        Admin
                    </a>
                </div>
            </li>
            <li class="w-full text-left rounded-lg">
                <button onclick="toggleWebsiteInfo()"
                    class="w-full p-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-4">
                        <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path
                                    d="M218.3 8.5c12.3-11.3 31.2-11.3 43.4 0l208 192c6.7 6.2 10.3 14.8 10.3 23.5l-144 0c-19.1 0-36.3 8.4-48 21.7l0-37.7c0-8.8-7.2-16-16-16l-64 0c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l64 0 0 128-160 0c-26.5 0-48-21.5-48-48l0-112-32 0c-13.2 0-25-8.1-29.8-20.3s-1.6-26.2 8.1-35.2l208-192zM352 304l0 144 192 0 0-144-192 0zm-48-16c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32l0 160 32 0c8.8 0 16 7.2 16 16c0 26.5-21.5 48-48 48l-48 0-192 0-48 0c-26.5 0-48-21.5-48-48c0-8.8 7.2-16 16-16l32 0 0-160z" />
                            </svg>
                        </span>
                        <div class="flex-1 min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Website Setting
                            </p>
                        </div>
                        <svg id="website-info-arrow" class="w-4 h-4 transition-transform duration-200 ml-auto"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="website-info-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.information.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.information.index') ? 'active' : '' }}">
                        Informasi
                    </a>
                    <a href="{{ route('admin.footer.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.footer.index') ? 'active' : '' }}">
                        Footer
                    </a>
                    <a href="{{ route('admin.meta-data.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.meta-data.index') ? 'active' : '' }}">
                        Meta Data
                    </a>
                    <a href="{{ route('admin.logo.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.logo.index') ? 'active' : '' }}">
                        Logo
                    </a>
                </div>
            </li>
            <li class="w-full text-left rounded-lg">
                <button onclick="toggleFinance()"
                    class="w-full p-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-4">
                        <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm128 0H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                        </span>
                        <div class="min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Keuangan</p>
                        </div>
                        <svg id="finance-arrow" class="w-4 h-4 transition-transform duration-200 ml-auto"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="finance-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.transactions') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.transactions') ? 'active' : '' }}">
                        Transaksi
                    </a>
                    <a href="{{ route('admin.pricing') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.pricing') ? 'active' : '' }}">
                        Pembayaran
                    </a>
                </div>
            </li>
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.messages') ? 'active' : '' }}">
                <a href="{{route('admin.messages')}}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M64 0C28.7 0 0 28.7 0 64L0 352c0 35.3 28.7 64 64 64l96 0 0 80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416 448 416c35.3 0 64-28.7 64-64l0-288c0-35.3-28.7-64-64-64L64 0z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Pesan</p>
                    </div>
                </a>
            </li>
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.news.*') ? 'active' : '' }}">
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Berita</p>
                    </div>
                </a>
            </li>
            <li class="w-full text-left rounded-lg">
                <button onclick="toggleAITraining()"
                    class="w-full p-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                    d="M248 0h80c13.3 0 24 10.7 24 24V64H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128C0 92.7 28.7 64 64 64H224V24c0-13.3 10.7-24 24-24zM64 384c0 17.7 14.3 32 32 32H352c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H96c-17.7 0-32 14.3-32 32V384zM208 272c0 44.2 35.8 80 80 80s80-35.8 80-80s-35.8-80-80-80s-80 35.8-80 80zm208-64c0 13.3 10.7 24 24 24s24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24zm0 96c0 13.3 10.7 24 24 24s24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24z"/>
                        </svg>
                    </span>
                    <div class="min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">AI Training</p>
                        </div>
                        <svg id="ai-training-arrow" class="w-4 h-4 transition-transform duration-200 ml-auto"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="ai-training-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.prompt-engineering') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.prompt-engineering') ? 'active' : '' }}">
                        Prompt
                    </a>
                    <a href="{{ route('admin.fine-tuning') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.fine-tuning') ? 'active' : '' }}">
                        Fine-tuning
                    </a>
                    <a href="{{ route('admin.keywords-patterns') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.keywords-patterns') ? 'active' : '' }}">
                        Keywords
                    </a>
                </div>
            </li>
            <li class="w-full text-left rounded-lg">
                <button onclick="toggleSystemLogs()"
                    class="w-full p-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-lg cursor-pointer">
                    <div class="flex items-center gap-4">
                        <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </svg>
                        </span>
                        <div class="min-w-0 sidebar-text">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Log Sistem</p>
                        </div>
                        <svg id="system-logs-arrow" class="w-4 h-4 transition-transform duration-200 ml-auto"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="system-logs-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.log-database.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.log-database.*') ? 'active' : '' }}">
                        Database Log
                    </a>
                    <a href="{{ route('admin.log-file.index') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.log-file.*') ? 'active' : '' }}">
                        File Log
                    </a>
                </div>
            </li>
        </ul>
    </div>
</aside>

<script>
    let isWebsiteInfoOpen = false;
    let isSystemLogsOpen = false;
    let isUsersOpen = false;
    let isAITrainingOpen = false;
    let isFinanceOpen = false;

    function toggleWebsiteInfo() {
        const dropdown = document.getElementById('website-info-dropdown');
        const arrow = document.getElementById('website-info-arrow');

        isWebsiteInfoOpen = !isWebsiteInfoOpen;

        if (isWebsiteInfoOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleFinance() {
        const dropdown = document.getElementById('finance-dropdown');
        const arrow = document.getElementById('finance-arrow');

        isFinanceOpen = !isFinanceOpen;

        if (isFinanceOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleSystemLogs() {
        const dropdown = document.getElementById('system-logs-dropdown');
        const arrow = document.getElementById('system-logs-arrow');

        isSystemLogsOpen = !isSystemLogsOpen;

        if (isSystemLogsOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleUsers() {
        const dropdown = document.getElementById('users-dropdown');
        const arrow = document.getElementById('users-arrow');

        isUsersOpen = !isUsersOpen;

        if (isUsersOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleAITraining() {
        const dropdown = document.getElementById('ai-training-dropdown');
        const arrow = document.getElementById('ai-training-arrow');

        isAITrainingOpen = !isAITrainingOpen;

        if (isAITrainingOpen) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Website Info dropdown
        const websiteInfoItems = document.querySelectorAll('#website-info-dropdown a');
        let isAnyWebsiteInfoActive = false;

        websiteInfoItems.forEach(item => {
            if (item.classList.contains('active')) {
                isAnyWebsiteInfoActive = true;
            }
        });

        if (isAnyWebsiteInfoActive) {
            const dropdown = document.getElementById('website-info-dropdown');
            const arrow = document.getElementById('website-info-arrow');

            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            isWebsiteInfoOpen = true;
        }

        // Finance dropdown
        const financeItems = document.querySelectorAll('#finance-dropdown a');
        let isAnyFinanceActive = false;

        financeItems.forEach(item => {
            if (item.classList.contains('active')) {
                isAnyFinanceActive = true;
            }
        });

        if (isAnyFinanceActive) {
            const dropdown = document.getElementById('finance-dropdown');
            const arrow = document.getElementById('finance-arrow');

            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            isFinanceOpen = true;
        }

        // System Logs dropdown
        const systemLogsItems = document.querySelectorAll('#system-logs-dropdown a');
        let isAnySystemLogActive = false;

        systemLogsItems.forEach(item => {
            if (item.classList.contains('active')) {
                isAnySystemLogActive = true;
            }
        });

        if (isAnySystemLogActive) {
            const dropdown = document.getElementById('system-logs-dropdown');
            const arrow = document.getElementById('system-logs-arrow');

            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            isSystemLogsOpen = true;
        }

        // Users dropdown
        const usersItems = document.querySelectorAll('#users-dropdown a');
        let isAnyUsersActive = false;

        usersItems.forEach(item => {
            if (item.classList.contains('active')) {
                isAnyUsersActive = true;
            }
        });

        if (isAnyUsersActive) {
            const dropdown = document.getElementById('users-dropdown');
            const arrow = document.getElementById('users-arrow');

            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            isUsersOpen = true;
        }

        // AI Training dropdown
        const aiTrainingItems = document.querySelectorAll('#ai-training-dropdown a');
        let isAnyAITrainingActive = false;

        aiTrainingItems.forEach(item => {
            if (item.classList.contains('active')) {
                isAnyAITrainingActive = true;
            }
        });

        if (isAnyAITrainingActive) {
            const dropdown = document.getElementById('ai-training-dropdown');
            const arrow = document.getElementById('ai-training-arrow');

            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            isAITrainingOpen = true;
        }
    });

    let isCollapsed = false;

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const logoImage = document.getElementById('logoImage');
        const collapseButton = document.getElementById('collapseButton');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');

        isCollapsed = !isCollapsed;

        if (isCollapsed) {
            sidebar.classList.add('w-[90px]');
            sidebar.classList.remove('w-auto');
            logoImage.src = "{{ asset('images/animasi2.png') }}";
            sidebarTexts.forEach(text => text.classList.add('hidden'));
        } else {
            sidebar.classList.remove('w-[90px]');
            sidebar.classList.add('w-auto');
            logoImage.src = "{{ asset('images/logo.png') }}";
            sidebarTexts.forEach(text => text.classList.remove('hidden'));
        }

        // Adjust dropdown positions
        adjustDropdownPositions();
    }

    function adjustDropdownPositions() {
        const dropdowns = document.querySelectorAll(
            '#users-dropdown, #website-info-dropdown, #system-logs-dropdown, #ai-training-dropdown, #finance-dropdown');
        
        dropdowns.forEach(dropdown => {
            if (isCollapsed) {
                dropdown.classList.add('absolute', 'left-[90px]', 'top-0', 'bg-white', 'dark:bg-gray-800', 'rounded-lg', 'shadow-lg', 'z-50', 'pl-3');
                dropdown.classList.remove('pl-12');
            } else {
                dropdown.classList.remove('absolute', 'left-[90px]', 'top-0', 'bg-white', 'dark:bg-gray-800', 'rounded-lg', 'shadow-lg', 'z-50', 'pl-3');
                dropdown.classList.add('pl-12');
            }
        });
    }

    document.getElementById('collapseButton').addEventListener('click', toggleSidebar);
</script>

<style>
    .rotate-180 {
        transform: rotate(180deg);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .hidden {
        display: none;
    }

    .active {
        background-color: #24b0ba !important;
        color: white !important;
    }

    .active .sidebar-text p {
        color: white !important;
    }

    .sidebar-text p {
        @apply text-gray-700 dark:text-gray-200;
    }

    svg path {
        @apply fill-gray-700 dark:fill-gray-200;
    }

    .active svg path {
        fill: white !important;
    }

    #website-info-arrow {
        @apply text-gray-700 dark:text-gray-200;
    }

    #system-logs-arrow {
        @apply text-gray-700 dark:text-gray-200;
    }
</style>
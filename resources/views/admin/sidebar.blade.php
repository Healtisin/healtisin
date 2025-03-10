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
                        <svg id="users-arrow" class="w-4 h-4 transition-transform duration-200"
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
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.transactions') ? 'active' : '' }}">
                <a href="{{ route('admin.transactions') }}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path
                                d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64l241.9 0c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5 608 384c0 35.3-28.7 64-64 64l-241.9 0c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5 32 128c0-35.3 28.7-64 64-64zm64 64l-64 0 0 64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64l64 0 0-64zM320 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Transaction</p>
                    </div>
                </a>
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
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Website Information
                            </p>
                        </div>
                        <svg id="website-info-arrow" class="w-4 h-4 transition-transform duration-200"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="website-info-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="#"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('#') ? 'active' : '' }}">
                        Description
                    </a>
                    <a href="#"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('#') ? 'active' : '' }}">
                        Footer
                    </a>
                    <a href="#"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('#') ? 'active' : '' }}">
                        Meta Data
                    </a>
                    <a href="#"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('#') ? 'active' : '' }}">
                        Logo
                    </a>
                </div>
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
                        <svg id="ai-training-arrow" class="w-4 h-4 transition-transform duration-200"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </button>

                <div id="ai-training-dropdown" class="hidden pl-12 mt-1 space-y-3 transition-all duration-200">
                    <a href="{{ route('admin.prompt-engineering') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.prompt-engineering') ? 'active' : '' }}">
                        Prompt Engineering
                    </a>
                    <a href="{{ route('admin.fine-tuning') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.fine-tuning') ? 'active' : '' }}">
                        Fine-tuning
                    </a>
                    <a href="{{ route('admin.keywords-patterns') }}"
                        class="block py-2 px-4 text-sm text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors {{ Route::is('admin.keywords-patterns') ? 'active' : '' }}">
                        Keywords dan Patterns
                    </a>
                </div>
            </li>
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.payments') ? 'active' : '' }}">
                <a href="{{ route('admin.payments') }}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2c0 0 0 .1 0 .1c0 0 0 0 0 0l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-18.7L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64 352 64c-17.7 0-32-14.3-32-32s14.3-32 32-32l96 0s0 0 0 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48l416 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 304zM48 416l0 48 48 0c0-26.5-21.5-48-48-48zM96 304l-48 0 0 48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48l48 0 0-48zM416 304c0 26.5 21.5 48 48 48l0-48-48 0zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Payment</p>
                    </div>
                </a>
            </li>
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('admin.pricing') ? 'active' : '' }}">
                <a href="{{ route('admin.pricing') }}" class="flex items-center gap-4">
                    <span class="w-5 h-5 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zM272 192l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16l224 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-224 0c-8.8 0-16-7.2-16-16zM164 152l0 13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9l0 13.8c0 11-9 20-20 20s-20-9-20-20l0-14.6c-10.3-2.2-20-5.5-28.2-8.4c0 0 0 0 0 0s0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5l0-14c0-11 9-20 20-20s20 9 20 20z" />
                        </svg>
                    </span>
                    <div class="flex-1 min-w-0 sidebar-text">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Pricing</p>
                    </div>
                </a>
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
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">Messages</p>
                    </div>
                </a>
            </li>
            <li
                class="w-full text-left p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ Route::is('#') ? 'active' : '' }}">
                <a href="#" class="flex items-center gap-4">
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
                        <svg id="system-logs-arrow" class="w-4 h-4 transition-transform duration-200"
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

        isCollapsed = !isCollapsed;

        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }

        // Adjust dropdown positions
        adjustDropdownPositions();
    }

    function adjustDropdownPositions() {
        const dropdowns = document.querySelectorAll(
            '.collapsed #users-dropdown, .collapsed #website-info-dropdown, .collapsed #system-logs-dropdown, .collapsed #ai-training-dropdown');
        dropdowns.forEach(dropdown => {
            if (isCollapsed) {
                dropdown.style.left = '60px'; // Sesuaikan dengan lebar sidebar saat collapse
            } else {
                dropdown.style.left = 'auto';
            }
        });
    }

    document.getElementById('collapseButton').addEventListener('click', toggleSidebar);
    document.getElementById('logoContainer').addEventListener('click', function() {
        if (isCollapsed) {
            toggleSidebar();
        }
    });
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
        @apply text-gray-700 dark: text-gray-200;
    }

    svg path {
        @apply fill-gray-700 dark: fill-gray-200;
    }

    .active svg path {
        fill: white !important;
    }

    #website-info-arrow {
        @apply text-gray-700 dark: text-gray-200;
    }

    #system-logs-arrow {
        @apply text-gray-700 dark: text-gray-200;
    }

    .collapsed {
        width: 60px;
    }

    .collapsed #logoImage {
        content: url("{{ asset('images/animasi2.png') }}");
        height: 24px;
        margin-right: 0;
    }

    .collapsed #collapseButton {
        display: none;
    }

    .collapsed .sidebar-text {
        display: none;
    }

    .collapsed #sidebarContent {
        padding: 0.5rem;
    }

    .collapsed li {
        justify-content: center;
    }

    .collapsed li a {
        gap: 0;
    }

    .collapsed #users-dropdown,
    .collapsed #website-info-dropdown,
    .collapsed #system-logs-dropdown,
    .collapsed #ai-training-dropdown {
        position: absolute;
        left: 60px;
        /* Sesuaikan dengan lebar sidebar saat collapse */
        top: 0;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        padding: 0.5rem;
        min-width: 160px;
        /* Sesuaikan dengan lebar dropdown yang diinginkan */
    }

    .collapsed #users-dropdown a,
    .collapsed #website-info-dropdown a,
    .collapsed #system-logs-dropdown a,
    .collapsed #ai-training-dropdown a {
        padding: 0.5rem 1rem;
        white-space: nowrap;
    }
</style>
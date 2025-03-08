<footer class="bg-gray-900 dark:bg-gray-950 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- kiri -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="h-8">
                    </div>
                    <div class="flex items-center space-x-6 mb-6 pl-2">
                        <a href="https://github.com/Healtisin" class="text-gray-400 hover:text-gray-300">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                    <div class="space-y-1 pl-2">
                        <p class="text-gray-400 text-sm">© 2025 Healtisin. All rights reserved.</p>
                        <p class="text-gray-400 text-sm">Healtisin, asisten AI kesehatan terdepan siap menjaga kesehatan
                            Anda 24/7.</p>
                        <p class="text-gray-400 text-sm">Dapatkan skrining kesehatan yang cepat dan akurat dengan
                            teknologi AI mutakhir kami.</p>
                    </div>
                </div>

                <!-- kanan -->
                <div class="md:col-span-2 grid grid-cols-4 gap-8 justify-self-end">
                    <div>
                        <h6 class="text-base font-semibold mb-4">Quick Links</h6>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm">About
                                    Us</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-gray-400 hover:text-white text-sm">Contact
                                    Us</a>
                            </li>
                            <li>
                                <a href="{{ route('news.index') }}"
                                    class="text-gray-400 hover:text-white text-sm">News</a>
                            </li>
                            <li>
                                <a href="{{ route('pricing.pro') }}"
                                    class="text-gray-400 hover:text-white text-sm">Pricing</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h6 class="text-base font-semibold mb-4">Legal & Safety</h6>
                        <ul class="space-y-3">
                            <li><a href="{{ route('privacy.policy') }}"
                                    class="text-gray-400 hover:text-white text-sm">Privacy
                                    Policy</a>
                            </li>
                            <li><a href="{{ route('terms.of.use') }}"
                                    class="text-gray-400 hover:text-white text-sm">Terms of Use</a></li>
                            <!-- <li><a href="#" class="text-gray-400 hover:text-white text-sm">Report Vulnerabilities</a>
                            </li> -->
                        </ul>
                    </div>

                    <div>
                        <h6 class="text-base font-semibold mb-4">Information</h6>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="w-5 h-5 flex-shrink-0 text-white" fill="currentColor">
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg>
                                <span class="text-gray-400 hover:text-white text-sm whitespace-nowrap">+62
                                    892-829-891</span>
                            </li>

                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="w-5 h-5 flex-shrink-0 text-white" fill="currentColor">
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                                <span
                                    class="text-gray-400 hover:text-white text-sm whitespace-nowrap">healtisin@gmail.com</span>
                            </li>

                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="w-5 h-5 flex-shrink-0 text-white" fill="currentColor">
                                    <path
                                        d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152l0 270.8c0 9.8-6 18.6-15.1 22.3L416 503l0-302.6zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6l0 251.4L32.9 502.7C17.1 509 0 497.4 0 480.4L0 209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77l0 249.3L192 449.4 192 255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                                </svg>
                                <span class="text-gray-400 hover:text-white text-sm whitespace-nowrap">Daerah Istimewa
                                    Yogyakarta</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
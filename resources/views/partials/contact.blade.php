<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami - Healtisin AI</title>
    @include('partials.dark-mode-init')
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('lang.language-modal')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    @include('partials.header')

    <main class="pt-19 pb-16">
        <div class="pt-12 relative h-[500px] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#24b0ba] to-[#73c7e3]">
                <div class="absolute inset-0 opacity-20">
                    <div class="floating-dots"></div>
                </div>
            </div>
            <div class="relative max-w-6xl mx-auto px-4 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6 animate-fade-in">Hubungi Kami</h1>
                    <p class="text-xl opacity-90 max-w-2xl animate-slide-up">
                        Kami siap membantu Anda dengan pertanyaan atau kebutuhan Anda. Jangan ragu untuk menghubungi
                        kami melalui informasi kontak di bawah ini.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 py-24">
            <div class="grid md:grid-cols-2 gap-16">
                <div class="space-y-8">
                    <div class="reveal-on-scroll">
                        <div class="grid grid-cols-2 gap-4 max-w-2xl mx-auto">
                            <div
                                class="bg-[#24b0ba]/10 dark:bg-[#24b0ba]/20 p-4 rounded-lg flex flex-col items-center text-center hover:shadow-lg transition-shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12 mb-2"
                                    fill="#24b0ba">
                                    <path
                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                </svg>
                                <p class="text-gray-800 dark:text-gray-200 font-medium mb-1">Phone</p>
                                <p class="text-gray-600 dark:text-gray-400">+62 892-829-891</p>
                            </div>
                            <div
                                class="bg-[#24b0ba]/10 dark:bg-[#24b0ba]/20 p-4 rounded-lg hover:shadow-lg transition-shadow flex flex-col items-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12 mb-2"
                                    fill="#24b0ba">
                                    <path d=" M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1
                                    10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6
                                    224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8
                                    18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5
                                    49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6
                                    184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3
                                    18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1
                                    16.3-30.3 1.8-3.7
                                    .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7
                                    0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1
                                    59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13
                                    4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                </svg>
                                <p class="text-gray-800 dark:text-gray-200 font-medium mb-1">Whatsapp</p>
                                <p class="text-gray-600 dark:text-gray-400">085292811199</p>
                            </div>
                            <div
                                class="bg-[#24b0ba]/10 dark:bg-[#24b0ba]/20 p-4 rounded-lg hover:shadow-lg transition-shadow flex flex-col items-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12 mb-2"
                                    fill="#24b0ba">
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                                <p class="text-gray-800 dark:text-gray-200 font-medium mb-1">Email</p>
                                <p class="text-gray-600 dark:text-gray-400">healtisin@gmail.com</p>
                            </div>
                            <div
                                class="bg-[#24b0ba]/10 dark:bg-[#24b0ba]/20 p-4 rounded-lg hover:shadow-lg transition-shadow flex flex-col items-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12 mb-2"
                                    fill="#24b0ba">
                                    <path
                                        d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152l0 270.8c0 9.8-6 18.6-15.1 22.3L416 503l0-302.6zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6l0 251.4L32.9 502.7C17.1 509 0 497.4 0 480.4L0 209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77l0 249.3L192 449.4 192 255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                                </svg>
                                <p class="text-gray-800 dark:text-gray-200 font-medium mb-1">Address</p>
                                <p class="text-gray-600 dark:text-gray-400">Daerah Istimewa Yogyakarta</p>
                            </div>
                        </div>
                    </div>

                    <div class="reveal-on-scroll">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d894.3444645936045!2d110.33814651071343!3d-7.775908361247276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59d56d1052a5%3A0xd840db058e6e4e44!2sKontrakan%20The%20Raid!5e1!3m2!1sid!2sid!4v1739989828006!5m2!1sid!2sid"
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="reveal-on-scroll">
                    <h2 class="text-3xl font-bold dark:text-gray-100">Kirim Pesan</h2>
                    <p class="my-6 dark:text-gray-400">
                        Kami siap membantu Anda dengan berbagai pertanyaan seputar layanan kesehatan digital Healtisin.
                        Tim support kami tersedia 24/7 untuk memberikan bantuan teknis, informasi layanan, atau
                        menjawab kekhawatiran Anda tentang kesehatan. Silakan isi formulir di bawah ini, dan kami
                        akan merespons secepat mungkin untuk memastikan pengalaman terbaik Anda menggunakan platform kami.
                    </p>
                    <!-- @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif -->
                    <form id="contactForm" action="{{ route('partials.contact.store') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full px-3 py-2 text-base rounded-md border border-gray-300 dark:border-gray-600 shadow-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full px-3 py-2 text-base rounded-md border border-gray-300 dark:border-gray-600 shadow-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subjek</label>
                            <input type="text" id="subject" name="subject" required
                                class="mt-1 block w-full px-3 py-2 text-base rounded-md border border-gray-300 dark:border-gray-600 shadow-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pesan</label>
                            <textarea id="message" name="message" rows="6" required
                                class="mt-1 block w-full px-3 py-2 text-base rounded-md border border-gray-300 dark:border-gray-600 shadow-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200"></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#24b0ba] hover:bg-[#73c7e3]">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <style>
        .floating-dots {
            background-image: radial-gradient(circle, white 2px, transparent 0.5px);
            background-size: 30px 30px;
            height: 200%;
            animation: float 20s linear infinite;
            position: absolute;
            width: 100%;
            top: 0;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-slide-up {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 1s ease-out 0.5s forwards;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal-on-scroll');

            function reveal() {
                reveals.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementTop < windowHeight - 100) {
                        element.classList.add('visible');
                    }
                });
            }
            window.addEventListener('scroll', reveal);
            reveal();
            const form = document.getElementById('contactForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const subject = document.getElementById('subject').value;
                const message = document.getElementById('message').value;

                if (!name || !email || !subject || !message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Harap isi semua field!',
                    });
                    return;
                }
                this.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pesan Anda telah berhasil dikirim.',
                }).then(() => {
                    form.reset();
                });
            });
        });
    </script>
</body>

</html>

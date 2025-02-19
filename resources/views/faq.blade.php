<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ - Healtisin AI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    @include('partials.header')

    <main class="pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan yang Sering Diajukan</h1>
                <p class="text-gray-600">Temukan jawaban untuk pertanyaan umum tentang Healtisin AI</p>
            </div>

            <div class="space-y-6">
                <!-- FAQ Items -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button class="faq-button w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">Apa itu Healtisin AI?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 py-4 bg-gray-50 hidden">
                        <p class="text-gray-600">Healtisin AI adalah platform kesehatan digital yang menggunakan kecerdasan buatan untuk membantu Anda mendapatkan informasi kesehatan yang akurat dan terpercaya. Platform ini menyediakan konsultasi kesehatan, artikel kesehatan, dan fitur-fitur inovatif lainnya.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <button class="faq-button w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">Bagaimana cara berlangganan Healtisin Pro?</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 py-4 bg-gray-50 hidden">
                        <p class="text-gray-600">Untuk berlangganan Healtisin Pro, Anda dapat:</p>
                        <ol class="list-decimal ml-5 mt-2 space-y-2 text-gray-600">
                            <li>Klik tombol "Cobalah Healtisin" di halaman utama</li>
                            <li>Pilih paket berlangganan yang sesuai</li>
                            <li>Pilih metode pembayaran</li>
                            <li>Selesaikan proses pembayaran</li>
                        </ol>
                    </div>
                </div>

                <!-- Tambahkan FAQ items lainnya -->
            </div>
        </div>
    </main>

    <script>
        // Toggle FAQ answers
        document.querySelectorAll('.faq-button').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                const icon = button.querySelector('svg');
                
                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    </script>
</body>
</html>
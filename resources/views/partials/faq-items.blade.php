<!-- FAQ Items -->
<div class="space-y-4">
    @foreach($faqs as $faq)
    <div class="bg-gradient-to-r from-[#24b0ba] to-[#73c7e3] rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
        <button class="faq-button w-full px-6 py-5 text-left flex justify-between items-center transition-all duration-300">
            <span class="text-lg font-medium text-white">{{ $faq->question }}</span>
            <svg class="w-5 h-5 text-white transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div class="faq-answer overflow-hidden transition-all duration-300" style="max-height: 0">
            <div class="px-6 py-5 bg-gradient-to-br from-white to-[#f8fdfe]">
                <p class="text-gray-700 leading-relaxed">{!! $faq->answer !!}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .faq-button.active svg {
        color: #ffffff;
        transform: rotate(180deg);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .faq-answer[style*="max-height: 0"] {
        opacity: 0;
    }

    .faq-answer:not([style*="max-height: 0"]) {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>



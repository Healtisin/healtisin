<?php

namespace App\Constants;

class Greetings
{
    public static function getKeywords(): array
    {
        return [
            ...self::getBasicGreetings(),
            ...self::getFormalGreetings(),
            ...self::getReligiousGreetings(),
            ...self::getPoliteExpressions(),
            ...self::getHealthcareGreetings()
        ];
    }

    private static function getBasicGreetings(): array
    {
        return [
            'hai', 'halo', 'hi', 'hello', 'hey', 'hei', 'hay',
            'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam',
            'pagi', 'siang', 'sore', 'malam',
            'apa kabar', 'gimana kabar', 'bagaimana kabar', 'kabar apa',
            'met pagi', 'met siang', 'met sore', 'met malam',
            'pagi bro', 'pagi sis', 'pagi gan', 'pagi kak',
            'siang bro', 'siang sis', 'siang gan', 'siang kak',
            'sore bro', 'sore sis', 'sore gan', 'sore kak',
            'malam bro', 'malam sis', 'malam gan', 'malam kak',
            'hai bro', 'hai sis', 'hai gan', 'hai kak',
            'halo bro', 'halo sis', 'halo gan', 'halo kak',
            'hi bro', 'hi sis', 'hi gan', 'hi kak',
            'hey bro', 'hey sis', 'hey gan', 'hey kak',
            'apa kabarnya', 'bagaimana kabarnya', 'gimana kabarnya',
            'kabar baik', 'kabarnya baik', 'kabar sehat',
            'sehat', 'sehat selalu', 'tetap sehat',
            'pagi semua', 'siang semua', 'sore semua', 'malam semua',
            'hai semua', 'halo semua', 'hi semua', 'hey semua',
            'selamat datang', 'welcome', 'met datang',
            'jumpa lagi', 'ketemu lagi', 'berjumpa lagi',
            'lama tak jumpa', 'lama tidak bertemu', 'sudah lama',
            'apa yang baru', 'ada apa', 'ada kabar',
            'selamat bertemu', 'senang bertemu', 'senang berjumpa',
            'met jumpa', 'met ketemu', 'met berjumpa',
            'hai sayang', 'halo sayang', 'hi sayang',
            'pagi sayang', 'siang sayang', 'sore sayang', 'malam sayang',
            'hai dear', 'halo dear', 'hi dear',
            'pagi dear', 'siang dear', 'sore dear', 'malam dear',
            'hai hon', 'halo hon', 'hi hon',
            'pagi hon', 'siang hon', 'sore hon', 'malam hon',
            'hai guys', 'halo guys', 'hi guys', 'hey guys'
        ];
    }

    private static function getFormalGreetings(): array
    {
        return [
            'selamat datang', 'selamat bertemu', 'selamat berjumpa',
            'selamat pagi bapak', 'selamat pagi ibu', 'selamat pagi dok',
            'selamat siang bapak', 'selamat siang ibu', 'selamat siang dok',
            'selamat sore bapak', 'selamat sore ibu', 'selamat sore dok',
            'selamat malam bapak', 'selamat malam ibu', 'selamat malam dok',
            'dengan bapak', 'dengan ibu', 'dengan dokter',
            'selamat pagi profesor', 'selamat pagi direktur', 'selamat pagi ketua',
            'selamat siang profesor', 'selamat siang direktur', 'selamat siang ketua',
            'selamat sore profesor', 'selamat sore direktur', 'selamat sore ketua',
            'selamat malam profesor', 'selamat malam direktur', 'selamat malam ketua',
            'dengan profesor', 'dengan direktur', 'dengan ketua',
            'selamat pagi pak', 'selamat pagi bu', 'selamat pagi prof',
            'selamat siang pak', 'selamat siang bu', 'selamat siang prof',
            'selamat sore pak', 'selamat sore bu', 'selamat sore prof',
            'selamat malam pak', 'selamat malam bu', 'selamat malam prof',
            'dengan pak', 'dengan bu', 'dengan prof',
            'selamat pagi dokter', 'selamat pagi profesor', 'selamat pagi guru',
            'selamat siang dokter', 'selamat siang profesor', 'selamat siang guru',
            'selamat sore dokter', 'selamat sore profesor', 'selamat sore guru',
            'selamat malam dokter', 'selamat malam profesor', 'selamat malam guru',
            'dengan dokter', 'dengan profesor', 'dengan guru',
            'selamat pagi kepala', 'selamat pagi manager', 'selamat pagi pimpinan',
            'selamat siang kepala', 'selamat siang manager', 'selamat siang pimpinan',
            'selamat sore kepala', 'selamat sore manager', 'selamat sore pimpinan',
            'selamat malam kepala', 'selamat malam manager', 'selamat malam pimpinan',
            'dengan kepala', 'dengan manager', 'dengan pimpinan',
            'selamat pagi tuan', 'selamat pagi nyonya', 'selamat pagi nona',
            'selamat siang tuan', 'selamat siang nyonya', 'selamat siang nona',
            'selamat sore tuan', 'selamat sore nyonya', 'selamat sore nona',
            'selamat malam tuan', 'selamat malam nyonya', 'selamat malam nona',
            'dengan tuan', 'dengan nyonya', 'dengan nona',
            'selamat pagi yang terhormat', 'selamat pagi yang mulia',
            'selamat siang yang terhormat', 'selamat siang yang mulia',
            'selamat sore yang terhormat', 'selamat sore yang mulia',
            'selamat malam yang terhormat', 'selamat malam yang mulia',
            'dengan yang terhormat', 'dengan yang mulia',
            'hormat saya', 'salam hormat', 'dengan hormat',
            'mohon izin', 'izin menyapa', 'izin bertemu',
            'selamat beraktivitas', 'selamat bertugas', 'selamat bekerja',
            'selamat berjumpa kembali', 'sampai bertemu kembali',
            'salam sejahtera', 'salam sukses', 'salam sehat'
        ];
    }

    private static function getReligiousGreetings(): array
    {
        return [
            'assalamualaikum', 'assalamu\'alaikum', 'asalamualaikum',
            'assalamualaikum wr wb', 'assalamu\'alaikum warahmatullahi wabarakatuh',
            'waalaikumsalam', 'waalaikumsalam wr wb', 'waalaikumsalam warahmatullahi wabarakatuh',
            'shalom', 'shalom aleichem', 'aleichem shalom',
            'om swastiastu', 'om santi santi santi om', 'om namo siwa ya',
            'namo buddhaya', 'namo sanghaya', 'namo dharmaya',
            'salam sejahtera', 'salam damai', 'salam kebajikan',
            'salam kasih', 'salam suci', 'salam bahagia',
            'bismillahirrahmanirrahim', 'alhamdulillah', 'subhanallah',
            'astaghfirullah', 'masya allah', 'insya allah',
            'allahu akbar', 'laa ilaha illallah', 'inna lillahi',
            'jazakallah khair', 'barakallah', 'taqabbalallahu minna wa minkum',
            'om namah shivaya', 'om gam ganapataye namaha', 'om mani padme hum',
            'om shanti shanti shanti', 'hari om tat sat', 'om sai ram',
            'namaste', 'satchitananda', 'om namo narayanaya',
            'sang hyang widhi wasa', 'om santih santih santih', 'om tat sat sri narayana',
            'namo amitabha', 'namo tassa bhagavato', 'buddham saranam gacchami',
            'dhammam saranam gacchami', 'sangham saranam gacchami', 'sadhu sadhu sadhu',
            'hallelujah', 'amin', 'praise the lord',
            'peace be with you', 'god bless you', 'in god we trust',
            'deus vult', 'pax vobiscum', 'dominus vobiscum',
            'kyrie eleison', 'agnus dei', 'gloria in excelsis deo',
            'puji tuhan', 'haleluya', 'terpujilah tuhan',
            'salam dalam kasih kristus', 'damai kristus', 'berkat tuhan',
            'om gan ganapataye namo namah', 'om aim saraswatyai namah', 'om namo bhagavate vasudevaya',
            'om tryambakam yajamahe', 'om purnamadah purnamidam', 'om asato ma sadgamaya',
            'wei de dong tian', 'tian zhu bao you', 'fo zu bao you',
            'amitoufo', 'guan yin pu sa', 'nan mo a mi tuo fo',
            'salam yang maha kuasa', 'salam yang maha esa', 'salam yang maha pengasih',
            'salam yang maha penyayang', 'salam yang maha agung', 'salam yang maha suci',
            'salam yang maha bijaksana', 'salam yang maha mengetahui', 'salam yang maha perkasa',
            'salam yang maha mulia', 'salam yang maha tinggi', 'salam yang maha besar',
            'salam yang maha luhur', 'salam yang maha abadi', 'salam yang maha sempurna'
        ];
    }

    private static function getPoliteExpressions(): array
    {
        return [
            'permisi', 'maaf', 'mohon', 'tolong',
            'mohon maaf', 'mohon bantuan', 'mohon petunjuk',
            'mohon penjelasan', 'mohon informasi', 'mohon saran',
            'minta tolong', 'bisa tolong', 'boleh tanya',
            'izin bertanya', 'izin konsultasi', 'izin tanya',
            'mohon bimbingan', 'mohon arahan', 'mohon masukan',
            'mohon kesediaan', 'mohon waktu', 'mohon perhatian',
            'mohon pertimbangan', 'mohon pengertian', 'mohon maklum',
            'mohon dibantu', 'mohon diarahkan', 'mohon dibimbing',
            'mohon diizinkan', 'mohon diperkenankan', 'mohon diperbolehkan',
            'boleh minta tolong', 'boleh minta bantuan', 'boleh minta saran',
            'boleh mohon bantuan', 'boleh mohon petunjuk', 'boleh mohon arahan',
            'izin mengganggu', 'izin menyela', 'izin berkonsultasi',
            'izin berdiskusi', 'izin berbicara', 'izin menyampaikan',
            'izin menanyakan', 'izin mengajukan', 'izin menyarankan',
            'izin memberikan', 'izin mengusulkan', 'izin menyampaikan',
            'permintaan maaf', 'permohonan maaf', 'mohon dimaafkan',
            'minta bantuan', 'minta petunjuk', 'minta arahan',
            'minta saran', 'minta masukan', 'minta pendapat',
            'minta waktu', 'minta kesempatan', 'minta izin',
            'dengan hormat', 'dengan segala hormat', 'dengan penuh hormat',
            'dengan segala kerendahan hati', 'dengan tulus', 'dengan sangat',
            'jika berkenan', 'jika diizinkan', 'jika diperbolehkan',
            'bila berkenan', 'bila diizinkan', 'bila diperbolehkan',
            'apabila berkenan', 'apabila diizinkan', 'apabila diperbolehkan',
            'mohon kesediaannya', 'mohon kebaikannya', 'mohon kemurahan hati',
            'mohon perkenannya', 'mohon bantuannya', 'mohon bimbingannya',
            'mohon arahannya', 'mohon sarannya', 'mohon masukannya',
            'mohon petunjuknya', 'mohon pendapatnya', 'mohon pertimbangannya',
            'mohon pengertiannya', 'mohon maklumnya', 'mohon waktunya',
            'boleh saya', 'boleh kami', 'boleh kita',
            'izinkan saya', 'izinkan kami', 'izinkan kita',
            'perkenankanlah', 'sudilah kiranya', 'berkenankah',
            'mohon izin', 'mohon perkenan', 'mohon kesediaan',
            'mohon kebaikan', 'mohon kemurahan', 'mohon perhatian',
            'mohon pertimbangan', 'mohon pengertian', 'mohon maklum',
            'mohon bantuan', 'mohon bimbingan', 'mohon arahan',
            'mohon saran', 'mohon masukan', 'mohon pendapat',
            'mohon petunjuk', 'mohon waktu', 'mohon kesempatan',
            'terima kasih', 'maaf mengganggu', 'maaf menyela',
            'maaf merepotkan', 'maaf mengganggu waktu', 'maaf menginterupsi'
        ];
    }

    private static function getHealthcareGreetings(): array
    {
        return [
            // Formal Medical Greetings (25)
            'selamat pagi dokter spesialis', 'selamat siang dokter konsultan',
            'selamat sore professor', 'kepada yth dokter ahli',
            'mohon konsultasi dengan dr', 'izin berkonsultasi dokter',
            'selamat bertugas tim medis', 'salam sejahtera dokter',
            'kepada dokter jaga', 'dengan hormat dokter',
            'salam sehat dokter', 'selamat praktik dokter',
            'selamat melayani dok', 'izin konsul dokter',
            'perkenalkan saya pasien', 'mohon bantuan medis',
            'butuh konsultasi dok', 'perlu pemeriksaan dok',
            'mau check up dok', 'izin medical check dok',
            'mohon diagnosa dok', 'butuh saran kesehatan',
            'perlu rekomendasi dokter', 'izin tanya hasil lab',
            'mohon info pengobatan',

            // Healthcare Inquiry Phrases (25)
            'bagaimana kondisi saya dok', 'apa diagnosa dokter',
            'mohon penjelasan hasil lab', 'butuh second opinion',
            'bagaimana hasil checkup', 'apa rekomendasi dokter',
            'mohon saran pengobatan', 'butuh rujukan dokter',
            'izin tanya efek samping', 'bagaimana progress kesehatan',
            'apa treatment selanjutnya', 'mohon jadwal kontrol',
            'kapan follow up dok', 'butuh resep obat',
            'izin konsul gizi', 'mohon saran diet',
            'bagaimana pola makan', 'apa pantangan makanan',
            'butuh vitamin tambahan', 'mohon saran olahraga',
            'izin tanya lifestyle', 'apa anjuran dokter',
            'mohon terapi lanjutan', 'bagaimana prognosis',
            'apa indikasi medis',

            // Digital Healthcare Greetings (25)
            'konsultasi online dok', 'telemedicine consultation',
            'virtual checkup dok', 'e-consultation please',
            'online medical chat', 'digital health consult',
            'remote diagnosis needed', 'virtual appointment',
            'teleconsultation please', 'online medical advice',
            'e-prescription needed', 'digital health check',
            'remote medical support', 'virtual medical chat',
            'online doctor consult', 'digital clinic visit',
            'e-medical assistance', 'remote healthcare help',
            'virtual medical support', 'online health inquiry',
            'digital medical consult', 'e-health assistance',
            'remote doctor visit', 'virtual medical help',
            'online clinical chat',

            // Health Status Greetings (25)
            'ada keluhan dok', 'mengalami gejala',
            'merasakan sakit di', 'ada masalah kesehatan',
            'kondisi kurang fit', 'butuh pemeriksaan',
            'ada gangguan kesehatan', 'merasa tidak enak badan',
            'mengalami demam', 'ada batuk pilek',
            'tekanan darah tinggi', 'gula darah naik',
            'kolesterol tinggi', 'asam urat naik',
            'mengalami alergi', 'ada reaksi obat',
            'efek samping medication', 'butuh vitamin',
            'perlu suplemen', 'ada masalah pencernaan',
            'gangguan tidur', 'stress dan anxiety',
            'masalah mental health', 'butuh konseling',
            'ada trauma fisik',

            // Patient Symptoms Expressions (25)
            'nyeri pada bagian', 'sakit kepala berkelanjutan',
            'pusing berputar', 'mual dan muntah',
            'sesak nafas', 'jantung berdebar',
            'pembengkakan di', 'kesemutan pada',
            'pandangan kabur', 'telinga berdenging',
            'sulit menelan', 'nyeri sendi',
            'kram otot', 'demam tinggi',
            'batuk berdahak', 'hidung tersumbat',
            'ruam kulit', 'gatal-gatal',
            'kehilangan nafsu makan', 'sulit tidur',
            'mudah lelah', 'berat badan turun',
            'keringat malam', 'nyeri dada',
            'sulit berkonsentrasi',

            // Medical History Inquiries (25)
            'riwayat kesehatan', 'catatan medis sebelumnya',
            'penyakit keluarga', 'alergi obat',
            'operasi sebelumnya', 'riwayat vaksinasi',
            'pengobatan rutin', 'konsumsi obat',
            'trauma masa lalu', 'kebiasaan merokok',
            'konsumsi alkohol', 'pola makan',
            'aktivitas fisik', 'jam tidur',
            'riwayat kecelakaan', 'kondisi kronis',
            'pengobatan alternatif', 'supplement rutin',
            'tekanan darah', 'gula darah',
            'kolesterol', 'asam urat',
            'fungsi ginjal', 'fungsi hati',
            'pemeriksaan jantung',

            // Treatment Follow-up (25)
            'progres pengobatan', 'perkembangan terapi',
            'hasil laboratorium', 'efek pengobatan',
            'respon treatment', 'penyesuaian dosis',
            'evaluasi tindakan', 'kontrol rutin',
            'jadwal terapi', 'monitoring kondisi',
            'keluhan tambahan', 'gejala baru',
            'perubahan kondisi', 'efek samping',
            'reaksi obat', 'perbaikan gejala',
            'jadwal kontrol', 'hasil rontgen',
            'hasil CT scan', 'hasil MRI',
            'hasil USG', 'hasil EKG',
            'hasil biopsi', 'hasil kultur',
            'hasil patologi',

            // Lifestyle and Prevention (25)
            'pola hidup sehat', 'diet seimbang',
            'olahraga teratur', 'manajemen stress',
            'kualitas tidur', 'asupan nutrisi',
            'kebutuhan vitamin', 'aktivitas sehari-hari',
            'pencegahan penyakit', 'gaya hidup aktif',
            'kontrol berat badan', 'program diet',
            'rutinitas exercise', 'meditasi',
            'yoga terapi', 'pijat kesehatan',
            'terapi relaksasi', 'manajemen waktu',
            'keseimbangan hidup', 'mindful eating',
            'detox program', 'wellness routine',
            'healthy lifestyle', 'daily habits',
            'self-care practice'
        ];
    }
}

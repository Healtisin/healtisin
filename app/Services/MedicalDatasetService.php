<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MedicalDatasetService
{
    /**
     * Dataset penyakit umum di Indonesia beserta gejala dan informasi dasar
     */
    public function getIndonesianMedicalDatasets()
    {
        return [
            'penyakit_tropis' => [
                'demam_berdarah' => [
                    'nama' => 'Demam Berdarah Dengue (DBD)',
                    'gejala' => ['demam tinggi', 'sakit kepala', 'nyeri sendi', 'ruam merah', 'pendarahan gusi'],
                    'prevalensi' => 'Tinggi di wilayah perkotaan dengan curah hujan tinggi',
                    'faktor_risiko' => ['genangan air', 'tempat penampungan air terbuka', 'cuaca hujan'],
                ],
                'malaria' => [
                    'nama' => 'Malaria',
                    'gejala' => ['demam berkala', 'menggigil', 'sakit kepala', 'berkeringat', 'mual'],
                    'prevalensi' => 'Tinggi di wilayah Indonesia timur seperti Papua, Maluku, NTT',
                    'faktor_risiko' => ['rawa-rawa', 'hutan', 'aktivitas malam hari'],
                ],
                'chikungunya' => [
                    'nama' => 'Chikungunya',
                    'gejala' => ['demam tinggi', 'nyeri sendi parah', 'ruam kulit', 'sakit kepala', 'kelelahan'],
                    'prevalensi' => 'Muncul secara sporadis di berbagai wilayah Indonesia',
                    'faktor_risiko' => ['gigitan nyamuk Aedes', 'daerah tropis', 'musim hujan'],
                ],
                'tifus' => [
                    'nama' => 'Tifus (Demam Tifoid)',
                    'gejala' => ['demam tinggi berkepanjangan', 'sakit kepala', 'mual', 'diare atau sembelit', 'lemah'],
                    'prevalensi' => 'Endemis di sebagian besar wilayah Indonesia',
                    'faktor_risiko' => ['sanitasi buruk', 'makanan/minuman terkontaminasi', 'kebersihan pribadi'],
                ],
                'leptospirosis' => [
                    'nama' => 'Leptospirosis',
                    'gejala' => ['demam', 'sakit kepala', 'nyeri otot', 'mata kuning', 'ruam merah'],
                    'prevalensi' => 'Meningkat saat banjir di daerah perkotaan',
                    'faktor_risiko' => ['banjir', 'kontak dengan air tercemar', 'paparan tikus'],
                ],
                'filariasis' => [
                    'nama' => 'Filariasis (Kaki Gajah)',
                    'gejala' => ['pembengkakan kaki', 'pembengkakan lengan', 'demam berulang', 'pembesaran kelenjar getah bening'],
                    'prevalensi' => 'Endemis di beberapa wilayah pedesaan Indonesia',
                    'faktor_risiko' => ['gigitan nyamuk', 'tinggal di daerah endemis', 'sanitasi buruk'],
                ],
                'japanese_encephalitis' => [
                    'nama' => 'Japanese Encephalitis',
                    'gejala' => ['demam tinggi', 'sakit kepala', 'kaku leher', 'kejang', 'perubahan kesadaran'],
                    'prevalensi' => 'Ditemukan di daerah pertanian dengan peternakan babi',
                    'faktor_risiko' => ['gigitan nyamuk Culex', 'kedekatan dengan peternakan babi', 'musim hujan'],
                ],
                'difteri' => [
                    'nama' => 'Difteri',
                    'gejala' => ['sakit tenggorokan', 'demam ringan', 'selaput putih di tenggorokan', 'pembengkakan leher'],
                    'prevalensi' => 'Kasus sporadis di beberapa wilayah Indonesia',
                    'faktor_risiko' => ['tidak divaksinasi', 'kontak dengan penderita', 'lingkungan padat'],
                ],
                'kolera' => [
                    'nama' => 'Kolera',
                    'gejala' => ['diare hebat', 'muntah', 'dehidrasi berat', 'kram perut'],
                    'prevalensi' => 'Muncul sebagai wabah di daerah dengan sanitasi buruk',
                    'faktor_risiko' => ['air minum tercemar', 'sanitasi buruk', 'makanan tidak higienis'],
                ],
                'hepatitis_a' => [
                    'nama' => 'Hepatitis A',
                    'gejala' => ['demam', 'mual', 'mata kuning', 'urin gelap', 'kehilangan nafsu makan'],
                    'prevalensi' => 'Umum di daerah dengan sanitasi buruk',
                    'faktor_risiko' => ['makanan/minuman tercemar', 'sanitasi buruk', 'kontak dengan penderita'],
                ],
                'campak' => [
                    'nama' => 'Campak',
                    'gejala' => ['demam tinggi', 'ruam merah', 'batuk', 'pilek', 'mata merah'],
                    'prevalensi' => 'Masih ditemukan di daerah dengan cakupan vaksinasi rendah',
                    'faktor_risiko' => ['tidak divaksinasi', 'kontak dengan penderita', 'daya tahan tubuh rendah']
                ],
                'rubella' => [
                    'nama' => 'Rubella',
                    'gejala' => ['ruam merah', 'demam ringan', 'pembengkakan kelenjar', 'nyeri sendi'],
                    'prevalensi' => 'Tersebar di berbagai wilayah Indonesia',
                    'faktor_risiko' => ['tidak divaksinasi', 'kontak dengan penderita', 'kehamilan']
                ],
                'tetanus' => [
                    'nama' => 'Tetanus',
                    'gejala' => ['kaku rahang', 'kejang otot', 'kesulitan menelan', 'demam'],
                    'prevalensi' => 'Kasus sporadis terutama di daerah pedesaan',
                    'faktor_risiko' => ['luka terkontaminasi', 'tidak divaksinasi', 'sanitasi buruk']
                ],
                'schistosomiasis' => [
                    'nama' => 'Schistosomiasis',
                    'gejala' => ['demam', 'nyeri perut', 'diare', 'pembesaran hati', 'kelelahan'],
                    'prevalensi' => 'Endemis di Sulawesi Tengah',
                    'faktor_risiko' => ['kontak dengan air tercemar', 'pertanian', 'sanitasi buruk']
                ],
                'leishmaniasis' => [
                    'nama' => 'Leishmaniasis',
                    'gejala' => ['lesi kulit', 'demam', 'pembesaran limpa', 'anemia'],
                    'prevalensi' => 'Jarang, ditemukan di beberapa wilayah terpencil',
                    'faktor_risiko' => ['gigitan lalat pasir', 'daerah tropis', 'sistem imun lemah']
                ],
                'melioidosis' => [
                    'nama' => 'Melioidosis',
                    'gejala' => ['demam', 'batuk', 'nyeri dada', 'infeksi kulit', 'abses'],
                    'prevalensi' => 'Ditemukan di daerah tropis terutama saat musim hujan',
                    'faktor_risiko' => ['kontak dengan tanah', 'diabetes', 'pekerjaan pertanian']
                ],
                'scrub_typhus' => [
                    'nama' => 'Scrub Typhus',
                    'gejala' => ['demam', 'sakit kepala', 'ruam', 'luka gigitan tungau'],
                    'prevalensi' => 'Tersebar di daerah pedesaan dan pertanian',
                    'faktor_risiko' => ['gigitan tungau', 'aktivitas outdoor', 'daerah semak belukar']
                ],
                'antraks' => [
                    'nama' => 'Antraks',
                    'gejala' => ['lesi kulit hitam', 'demam', 'sesak napas', 'nyeri dada'],
                    'prevalensi' => 'Kasus sporadis terkait kontak dengan hewan terinfeksi',
                    'faktor_risiko' => ['kontak dengan hewan terinfeksi', 'produk hewan mentah', 'pekerjaan peternakan']
                ],
                'rabies' => [
                    'nama' => 'Rabies',
                    'gejala' => ['demam', 'sakit kepala', 'kebingungan', 'kelumpuhan', 'fobia air'],
                    'prevalensi' => 'Endemis di beberapa wilayah dengan populasi anjing liar tinggi',
                    'faktor_risiko' => ['gigitan hewan terinfeksi', 'tidak vaksinasi pasca paparan', 'kontak dengan hewan liar']
                ],
                'paragonimiasis' => [
                    'nama' => 'Paragonimiasis',
                    'gejala' => ['batuk kronis', 'batuk darah', 'nyeri dada', 'sesak napas'],
                    'prevalensi' => 'Jarang, terkait konsumsi kepiting mentah',
                    'faktor_risiko' => ['makan kepiting mentah', 'sanitasi buruk', 'kebiasaan makan tidak sehat']
                ],
                'fascioliasis' => [
                    'nama' => 'Fascioliasis',
                    'gejala' => ['demam', 'nyeri perut', 'pembesaran hati', 'mual muntah'],
                    'prevalensi' => 'Jarang, terkait konsumsi sayuran air mentah',
                    'faktor_risiko' => ['makan sayuran mentah', 'sanitasi buruk', 'peternakan']
                ],
                'echinococcosis' => [
                    'nama' => 'Echinococcosis',
                    'gejala' => ['nyeri perut', 'pembesaran organ', 'mual', 'muntah'],
                    'prevalensi' => 'Jarang, terkait dengan peternakan',
                    'faktor_risiko' => ['kontak dengan anjing terinfeksi', 'peternakan', 'sanitasi buruk']
                ],
                'taeniasis' => [
                    'nama' => 'Taeniasis',
                    'gejala' => ['nyeri perut', 'penurunan berat badan', 'mual', 'diare'],
                    'prevalensi' => 'Tersebar di daerah dengan konsumsi daging mentah',
                    'faktor_risiko' => ['makan daging mentah', 'sanitasi buruk', 'peternakan']
                ],
                'yaws' => [
                    'nama' => 'Yaws (Frambusia)',
                    'gejala' => ['lesi kulit', 'pembengkakan sendi', 'nyeri tulang', 'deformitas'],
                    'prevalensi' => 'Endemis di daerah terpencil dengan sanitasi buruk',
                    'faktor_risiko' => ['sanitasi buruk', 'kontak dengan penderita', 'kemiskinan']
                ],
                'lymphatic_filariasis' => [
                    'nama' => 'Filariasis Limfatik',
                    'gejala' => ['pembengkakan tungkai', 'demam berulang', 'nyeri', 'pembesaran kelenjar getah bening'],
                    'prevalensi' => 'Endemis di daerah dengan sanitasi buruk',
                    'faktor_risiko' => ['gigitan nyamuk', 'sanitasi buruk', 'daerah endemis']
                ],
                'scabies' => [
                    'nama' => 'Scabies (Kudis)',
                    'gejala' => ['gatal intens', 'ruam kulit', 'lesi bernanah', 'gatal malam hari'],
                    'prevalensi' => 'Umum di daerah padat penduduk dengan sanitasi buruk',
                    'faktor_risiko' => ['kontak langsung', 'sanitasi buruk', 'kepadatan penduduk']
                ],
                'trachoma' => [
                    'nama' => 'Trachoma',
                    'gejala' => ['iritasi mata', 'nyeri mata', 'kebutaan', 'infeksi berulang'],
                    'prevalensi' => 'Endemis di daerah dengan akses air bersih terbatas',
                    'faktor_risiko' => ['sanitasi buruk', 'akses air bersih terbatas', 'kemiskinan']
                ],
                'onchocerciasis' => [
                    'nama' => 'Onchocerciasis (River Blindness)',
                    'gejala' => ['gatal kulit', 'lesi kulit', 'gangguan penglihatan', 'kebutaan'],
                    'prevalensi' => 'Jarang, ditemukan di sekitar daerah sungai',
                    'faktor_risiko' => ['gigitan lalat hitam', 'tinggal dekat sungai', 'pertanian']
                ],
                'strongyloidiasis' => [
                    'nama' => 'Strongyloidiasis',
                    'gejala' => ['gatal kulit', 'ruam', 'diare', 'nyeri perut'],
                    'prevalensi' => 'Tersebar di daerah tropis dengan sanitasi buruk',
                    'faktor_risiko' => ['berjalan tanpa alas kaki', 'sanitasi buruk', 'sistem imun lemah']
                ],
                'mycetoma' => [
                    'nama' => 'Mycetoma',
                    'gejala' => ['pembengkakan', 'pembentukan sinus', 'discharge', 'nyeri'],
                    'prevalensi' => 'Jarang, ditemukan di daerah pertanian',
                    'faktor_risiko' => ['trauma kulit', 'pekerjaan pertanian', 'berjalan tanpa alas kaki']
                ]
            ],
            'penyakit_tidak_menular' => [
                'diabetes' => [
                    'nama' => 'Diabetes Melitus',
                    'gejala' => ['sering haus', 'sering buang air kecil', 'penurunan berat badan', 'luka sulit sembuh'],
                    'prevalensi' => 'Meningkat di semua wilayah Indonesia, terutama perkotaan',
                    'faktor_risiko' => ['pola makan tinggi gula', 'kurang aktivitas fisik', 'riwayat keluarga'],
                ],
                'hipertensi' => [
                    'nama' => 'Hipertensi (Tekanan Darah Tinggi)',
                    'gejala' => ['sakit kepala', 'sesak napas', 'pusing', 'nyeri dada'],
                    'prevalensi' => 'Sangat tinggi, terutama di wilayah perkotaan',
                    'faktor_risiko' => ['konsumsi garam berlebih', 'kurang aktivitas fisik', 'stres'],
                ],
                'jantung_koroner' => [
                    'nama' => 'Penyakit Jantung Koroner',
                    'gejala' => ['nyeri dada', 'sesak napas', 'keringat dingin', 'mual'],
                    'prevalensi' => 'Tinggi di perkotaan dan usia lanjut',
                    'faktor_risiko' => ['merokok', 'kolesterol tinggi', 'obesitas', 'riwayat keluarga'],
                ],
                'stroke' => [
                    'nama' => 'Stroke',
                    'gejala' => ['wajah merot', 'lengan lemah', 'bicara pelo', 'sakit kepala hebat'],
                    'prevalensi' => 'Meningkat pada populasi lansia dan penderita hipertensi',
                    'faktor_risiko' => ['hipertensi', 'diabetes', 'merokok', 'obesitas'],
                ],
                'asma' => [
                    'nama' => 'Asma',
                    'gejala' => ['sesak napas', 'mengi', 'batuk-batuk', 'dada terasa berat'],
                    'prevalensi' => 'Umum pada semua kelompok usia',
                    'faktor_risiko' => ['alergi', 'polusi udara', 'riwayat keluarga', 'infeksi saluran napas'],
                ],
                'kanker_paru' => [
                    'nama' => 'Kanker Paru-paru',
                    'gejala' => ['batuk kronis', 'batuk darah', 'sesak napas', 'penurunan berat badan'],
                    'prevalensi' => 'Meningkat terutama pada perokok',
                    'faktor_risiko' => ['merokok', 'paparan asbestos', 'polusi udara', 'riwayat keluarga'],
                ],
                'osteoporosis' => [
                    'nama' => 'Osteoporosis',
                    'gejala' => ['nyeri tulang', 'postur membungkuk', 'mudah patah tulang', 'penurunan tinggi badan'],
                    'prevalensi' => 'Tinggi pada wanita pascamenopause dan lansia',
                    'faktor_risiko' => ['usia lanjut', 'kekurangan kalsium', 'kurang aktivitas fisik', 'merokok'],
                ],
                'gagal_ginjal' => [
                    'nama' => 'Gagal Ginjal Kronis',
                    'gejala' => ['kelelahan', 'bengkak pada kaki', 'perubahan urin', 'tekanan darah tinggi'],
                    'prevalensi' => 'Meningkat seiring pertambahan kasus diabetes dan hipertensi',
                    'faktor_risiko' => ['diabetes', 'hipertensi', 'obesitas', 'riwayat keluarga'],
                ],
                'artritis' => [
                    'nama' => 'Artritis (Radang Sendi)',
                    'gejala' => ['nyeri sendi', 'kaku sendi', 'pembengkakan sendi', 'kesulitan bergerak'],
                    'prevalensi' => 'Umum pada lansia dan orang dengan riwayat cedera sendi',
                    'faktor_risiko' => ['usia lanjut', 'obesitas', 'cedera sendi', 'penyakit autoimun']
                ],
                'alzheimer' => [
                    'nama' => 'Penyakit Alzheimer',
                    'gejala' => ['hilang ingatan', 'kebingungan', 'perubahan perilaku', 'kesulitan berbicara'],
                    'prevalensi' => 'Meningkat pada populasi lansia di atas 65 tahun',
                    'faktor_risiko' => ['usia lanjut', 'riwayat keluarga', 'trauma kepala', 'gaya hidup tidak sehat']
                ],
                'parkinson' => [
                    'nama' => 'Penyakit Parkinson',
                    'gejala' => ['tremor', 'kaku otot', 'gerakan lambat', 'gangguan keseimbangan'],
                    'prevalensi' => 'Meningkat pada populasi lansia',
                    'faktor_risiko' => ['usia lanjut', 'paparan toksin', 'riwayat keluarga', 'trauma kepala']
                ],
                'glaukoma' => [
                    'nama' => 'Glaukoma',
                    'gejala' => ['nyeri mata', 'penglihatan kabur', 'sakit kepala', 'mual'],
                    'prevalensi' => 'Meningkat pada usia di atas 40 tahun',
                    'faktor_risiko' => ['usia lanjut', 'riwayat keluarga', 'diabetes', 'hipertensi']
                ],
                'katarak' => [
                    'nama' => 'Katarak',
                    'gejala' => ['penglihatan kabur', 'sensitif cahaya', 'kesulitan melihat malam', 'perubahan warna'],
                    'prevalensi' => 'Sangat umum pada lansia',
                    'faktor_risiko' => ['usia lanjut', 'paparan UV', 'diabetes', 'merokok']
                ],
                'hipotiroid' => [
                    'nama' => 'Hipotiroidisme',
                    'gejala' => ['kelelahan', 'sensitif dingin', 'kenaikan berat badan', 'depresi'],
                    'prevalensi' => 'Lebih umum pada wanita usia menengah',
                    'faktor_risiko' => ['autoimun', 'operasi tiroid', 'radiasi', 'kekurangan yodium']
                ],
                'psoriasis' => [
                    'nama' => 'Psoriasis',
                    'gejala' => ['kulit merah', 'sisik putih', 'gatal', 'nyeri sendi'],
                    'prevalensi' => 'Mempengaruhi sekitar 2% populasi',
                    'faktor_risiko' => ['genetik', 'stres', 'infeksi', 'obesitas']
                ],
                'migrain' => [
                    'nama' => 'Migrain',
                    'gejala' => ['sakit kepala berdenyut', 'mual', 'sensitif cahaya', 'aura visual'],
                    'prevalensi' => 'Lebih umum pada wanita usia produktif',
                    'faktor_risiko' => ['hormonal', 'stres', 'makanan tertentu', 'kurang tidur']
                ],
                'fibromialgia' => [
                    'nama' => 'Fibromialgia',
                    'gejala' => ['nyeri otot', 'kelelahan', 'gangguan tidur', 'masalah kognitif'],
                    'prevalensi' => 'Lebih sering pada wanita usia menengah',
                    'faktor_risiko' => ['stres', 'trauma fisik', 'infeksi', 'genetik']
                ],
                'ibs' => [
                    'nama' => 'Irritable Bowel Syndrome',
                    'gejala' => ['nyeri perut', 'kembung', 'diare', 'sembelit'],
                    'prevalensi' => 'Umum pada usia produktif',
                    'faktor_risiko' => ['stres', 'diet buruk', 'perubahan hormon', 'infeksi']
                ]
            ],
            'obat_tradisional' => [
                'jamu' => [
                    'nama' => 'Jamu dan Ramuan Tradisional',
                    'jenis' => ['kunyit asam', 'temulawak', 'jahe', 'beras kencur'],
                    'khasiat_umum' => 'Meningkatkan stamina, meredakan nyeri',
                    'catatan' => 'Tidak menggantikan pengobatan medis untuk kondisi serius',
                ],
                'herbal_rempah' => [
                    'nama' => 'Rempah-Rempah Herbal',
                    'jenis' => ['kayu manis', 'cengkeh', 'kapulaga', 'pala', 'lada hitam'],
                    'khasiat_umum' => 'Anti-inflamasi, antioksidan, meningkatkan sistem imun',
                    'catatan' => 'Gunakan sesuai takaran yang dianjurkan'
                ],
                'empon_empon' => [
                    'nama' => 'Empon-Empon',
                    'jenis' => ['jahe merah', 'kunyit', 'kencur', 'lengkuas', 'temulawak'],
                    'khasiat_umum' => 'Meningkatkan daya tahan tubuh, anti-inflamasi',
                    'catatan' => 'Dapat dikonsumsi dalam bentuk seduhan atau campuran jamu'
                ],
                'daun_obat' => [
                    'nama' => 'Daun Obat Tradisional',
                    'jenis' => ['daun sirih', 'daun salam', 'daun pepaya', 'daun sirsak', 'daun jambu biji'],
                    'khasiat_umum' => 'Mengobati berbagai penyakit ringan, antioksidan alami',
                    'catatan' => 'Pastikan mencuci bersih sebelum penggunaan'
                ],
                'minyak_herbal' => [
                    'nama' => 'Minyak Herbal Tradisional',
                    'jenis' => ['minyak kelapa', 'minyak cengkeh', 'minyak kayu putih', 'minyak telon', 'minyak zaitun'],
                    'khasiat_umum' => 'Perawatan kulit, pijat, pengobatan luar',
                    'catatan' => 'Lakukan uji patch test sebelum penggunaan'
                ],
                'ramuan_khusus' => [
                    'nama' => 'Ramuan Khusus Tradisional',
                    'jenis' => ['wedang uwuh', 'wedang jahe', 'sinom', 'beras kencur', 'kunyit asam'],
                    'khasiat_umum' => 'Menjaga kesehatan, meningkatkan stamina, melancarkan peredaran darah',
                    'catatan' => 'Dapat disesuaikan dengan kondisi kesehatan individu'
                ],
                'ramuan_penyegar' => [
                    'nama' => 'Ramuan Penyegar Tradisional',
                    'jenis' => ['minuman kunyit', 'jamu beras kencur', 'wedang ronde', 'bandrek', 'sekoteng'],
                    'khasiat_umum' => 'Menyegarkan badan, menghangatkan tubuh, meningkatkan stamina',
                    'catatan' => 'Baik dikonsumsi secara rutin dengan dosis yang sesuai'
                ],
                'ramuan_pencernaan' => [
                    'nama' => 'Ramuan Pencernaan',
                    'jenis' => ['daun pepaya', 'kunyit', 'temulawak', 'daun mint', 'jahe'],
                    'khasiat_umum' => 'Membantu pencernaan, mengatasi mual dan kembung',
                    'catatan' => 'Hindari konsumsi berlebihan pada ibu hamil'
                ],
                'ramuan_pernapasan' => [
                    'nama' => 'Ramuan Pernapasan',
                    'jenis' => ['jeruk nipis', 'kencur', 'madu', 'kayu manis', 'kapulaga'],
                    'khasiat_umum' => 'Melegakan pernapasan, meredakan batuk',
                    'catatan' => 'Dapat dikombinasikan dengan madu untuk hasil optimal'
                ],
                'ramuan_antiinflamasi' => [
                    'nama' => 'Ramuan Anti Inflamasi',
                    'jenis' => ['jahe merah', 'kunyit', 'temulawak', 'sereh', 'kayu manis'],
                    'khasiat_umum' => 'Mengurangi peradangan, nyeri sendi dan otot',
                    'catatan' => 'Konsultasikan dengan ahli untuk penggunaan jangka panjang'
                ],
                'ramuan_imunitas' => [
                    'nama' => 'Ramuan Peningkat Imunitas',
                    'jenis' => ['echinacea', 'meniran', 'sambiloto', 'kunyit', 'jahe'],
                    'khasiat_umum' => 'Meningkatkan daya tahan tubuh, mencegah penyakit',
                    'catatan' => 'Dapat dikonsumsi rutin sebagai upaya preventif'
                ],
                'ramuan_detoks' => [
                    'nama' => 'Ramuan Detoksifikasi',
                    'jenis' => ['pegagan', 'kumis kucing', 'sambiloto', 'daun sirsak', 'mengkudu'],
                    'khasiat_umum' => 'Membantu detoksifikasi tubuh, membersihkan darah',
                    'catatan' => 'Lakukan detoks secara bertahap dan tidak berlebihan'
                ],
                'ramuan_kulit' => [
                    'nama' => 'Ramuan Perawatan Kulit',
                    'jenis' => ['kunir', 'temugiring', 'bengkoang', 'daun sirih', 'lidah buaya'],
                    'khasiat_umum' => 'Merawat kesehatan kulit, anti jerawat',
                    'catatan' => 'Dapat digunakan sebagai masker atau diminum'
                ],
                'ramuan_reproduksi' => [
                    'nama' => 'Ramuan Kesehatan Reproduksi',
                    'jenis' => ['daun sirih', 'kunyit', 'asam jawa', 'delima', 'kayu rapet'],
                    'khasiat_umum' => 'Menjaga kesehatan organ reproduksi',
                    'catatan' => 'Konsultasikan dengan ahli untuk penggunaan spesifik'
                ],
                'ramuan_metabolisme' => [
                    'nama' => 'Ramuan Metabolisme',
                    'jenis' => ['kelembak', 'bangle', 'lempuyang', 'temu kunci', 'kapulogo'],
                    'khasiat_umum' => 'Membantu metabolisme, melancarkan pencernaan',
                    'catatan' => 'Baik dikonsumsi sebelum makan'
                ],
                'ramuan_antidiabetes' => [
                    'nama' => 'Ramuan Anti Diabetes',
                    'jenis' => ['daun insulin', 'kayu manis', 'brotowali', 'sambiloto', 'daun salam'],
                    'khasiat_umum' => 'Membantu mengontrol gula darah',
                    'catatan' => 'Tetap monitor gula darah secara teratur'
                ],
                'ramuan_jantung' => [
                    'nama' => 'Ramuan Kesehatan Jantung',
                    'jenis' => ['mengkudu', 'bawang putih', 'daun dewa', 'daun seledri', 'buah mahkota dewa'],
                    'khasiat_umum' => 'Menjaga kesehatan jantung dan pembuluh darah',
                    'catatan' => 'Konsumsi teratur dengan dosis yang tepat'
                ],
                'ramuan_sendi' => [
                    'nama' => 'Ramuan Kesehatan Sendi',
                    'jenis' => ['jahe merah', 'kunyit', 'daun sirsak', 'sereh', 'kayu manis'],
                    'khasiat_umum' => 'Meredakan nyeri sendi dan tulang',
                    'catatan' => 'Dapat dikombinasikan dengan pijat tradisional'
                ],
                'ramuan_liver' => [
                    'nama' => 'Ramuan Kesehatan Liver',
                    'jenis' => ['temulawak', 'kunyit', 'mengkudu', 'sambiloto', 'daun pegagan'],
                    'khasiat_umum' => 'Menjaga kesehatan fungsi hati',
                    'catatan' => 'Hindari konsumsi bersamaan dengan obat-obatan'
                ],
                'ramuan_kolesterol' => [
                    'nama' => 'Ramuan Anti Kolesterol',
                    'jenis' => ['bawang putih', 'jahe', 'kayu manis', 'daun salam', 'mengkudu'],
                    'khasiat_umum' => 'Membantu menurunkan kolesterol',
                    'catatan' => 'Kombinasikan dengan pola makan sehat'
                ],
                'ramuan_tekanan_darah' => [
                    'nama' => 'Ramuan Tekanan Darah',
                    'jenis' => ['seledri', 'mengkudu', 'bawang putih', 'kumis kucing', 'pegagan'],
                    'khasiat_umum' => 'Membantu mengontrol tekanan darah',
                    'catatan' => 'Monitor tekanan darah secara teratur'
                ],
                'ramuan_asam_urat' => [
                    'nama' => 'Ramuan Asam Urat',
                    'jenis' => ['sirsak', 'kumis kucing', 'daun salam', 'jahe', 'kunyit'],
                    'khasiat_umum' => 'Membantu menurunkan asam urat',
                    'catatan' => 'Hindari makanan tinggi purin'
                ],
                'ramuan_kewanitaan' => [
                    'nama' => 'Ramuan Kesehatan Wanita',
                    'jenis' => ['kunyit asam', 'sirih', 'delima', 'kayu rapet', 'temu kunci'],
                    'khasiat_umum' => 'Menjaga kesehatan organ kewanitaan',
                    'catatan' => 'Sesuaikan dengan siklus menstruasi'
                ],
                'ramuan_pria' => [
                    'nama' => 'Ramuan Kesehatan Pria',
                    'jenis' => ['pasak bumi', 'ginseng jawa', 'purwoceng', 'cabe jawa', 'jahe merah'],
                    'khasiat_umum' => 'Meningkatkan vitalitas pria',
                    'catatan' => 'Konsumsi sesuai anjuran dan tidak berlebihan'
                ],
                'ramuan_mata' => [
                    'nama' => 'Ramuan Kesehatan Mata',
                    'jenis' => ['wortel', 'bilberry', 'pegagan', 'seledri', 'brokoli'],
                    'khasiat_umum' => 'Menjaga kesehatan mata',
                    'catatan' => 'Kombinasikan dengan istirahat mata yang cukup'
                ],
                'ramuan_rematik' => [
                    'nama' => 'Ramuan Anti Rematik',
                    'jenis' => ['jahe merah', 'kunyit', 'temulawak', 'daun sirsak', 'sereh'],
                    'khasiat_umum' => 'Meredakan nyeri rematik',
                    'catatan' => 'Dapat digunakan untuk kompres atau diminum'
                ]
            ],
        ];
    }

    /**
     * Mengekspor dataset ke format JSON untuk digunakan dalam fine-tuning
     */
    public function exportDatasetForTraining()
    {
        $dataset = $this->getIndonesianMedicalDatasets();
        $trainingExamples = [];
        
        // Mengkonversi dataset menjadi contoh pertanyaan-jawaban untuk fine-tuning
        foreach ($dataset as $kategori => $penyakit_list) {
            foreach ($penyakit_list as $kode => $detail) {
                // Contoh untuk gejala
                $trainingExamples[] = [
                    'input' => "Apa gejala {$detail['nama']}?",
                    'output' => "Gejala umum {$detail['nama']} meliputi " . implode(', ', $detail['gejala']) . '. Namun, gejala dapat bervariasi untuk setiap individu dan setiap kondisi sebaiknya dikonsultasikan dengan tenaga medis profesional.'
                ];
                
                // Contoh untuk prevalensi
                if (isset($detail['prevalensi'])) {
                    $trainingExamples[] = [
                        'input' => "Berapa banyak kasus {$detail['nama']} di Indonesia?",
                        'output' => "Prevalensi {$detail['nama']} di Indonesia: {$detail['prevalensi']}. Data ini dapat berubah, sebaiknya merujuk ke laporan terbaru Kementerian Kesehatan Indonesia."
                    ];
                }
                
                // Contoh untuk faktor risiko
                if (isset($detail['faktor_risiko'])) {
                    $trainingExamples[] = [
                        'input' => "Apa faktor risiko {$detail['nama']}?",
                        'output' => "Faktor risiko {$detail['nama']} meliputi " . implode(', ', $detail['faktor_risiko']) . '. Mengurangi faktor risiko dapat membantu mencegah penyakit ini.'
                    ];
                }
            }
        }
        
        // Simpan ke file JSON
        Storage::disk('local')->put('medical_training_dataset.json', json_encode($trainingExamples, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return count($trainingExamples);
    }
}

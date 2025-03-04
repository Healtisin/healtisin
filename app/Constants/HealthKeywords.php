<?php

namespace App\Constants;

class HealthKeywords
{
    public static function getKeywords(): array
    {
        return [
            // Kata kunci dasar
            'sakit', 'nyeri', 'penyakit', 'gejala', 'obat', 'dokter', 'rumah sakit',
            'kesehatan', 'medis', 'pengobatan', 'diagnosa', 'terapi', 'vaksin',
            
            // Tambahkan method helper untuk mendapatkan keywords per kategori
            ...self::getBasicKeywords(),
            ...self::getCommonDiseases(),
            ...self::getSymptoms(),
            ...self::getDigestiveConditions(),
            ...self::getSkinConditions(),
            ...self::getEyeConditions(),
            ...self::getEarConditions(),
            ...self::getMentalConditions(),
            ...self::getReproductiveConditions(),
            ...self::getBoneAndMuscleConditions(),
            ...self::getDentalConditions(),
            ...self::getHeartConditions(),
            ...self::getRespiratoryConditions(),
            ...self::getNervousSystemConditions(),
            ...self::getEndocrineConditions(),
            ...self::getAutoimmuneConditions(),
            ...self::getBloodConditions(),
            ...self::getPreventiveCare(),
            ...self::getEmergencyConditions(),
            ...self::getMedicalProcedures()
        ];
    }

    private static function getBasicKeywords(): array 
    {
        return [
            'sakit', 'nyeri', 'penyakit', 'gejala', 'obat', 'dokter', 'rumah sakit',
            'kesehatan', 'medis', 'pengobatan', 'diagnosa', 'terapi', 'vaksin',
            'klinik', 'apotek', 'laboratorium', 'medical check up', 'rujukan',
            'rawat inap', 'rawat jalan', 'UGD', 'IGD', 'ambulans', 'puskesmas',
            'spesialis', 'konsultasi', 'pemeriksaan', 'perawatan', 'resep',
            'dosis', 'efek samping', 'alergi', 'imunisasi', 'tes darah',
            'rontgen', 'usg', 'ct scan', 'mri', 'ekg', 'bius', 'operasi',
            'bedah', 'jahit', 'perban', 'plester', 'infus', 'suntik',
            'tablet', 'kapsul', 'sirup', 'salep', 'tetes', 'inhaler',
            'suplemen', 'vitamin', 'herbal', 'tradisional', 'alternatif',
            'rehabilitasi', 'fisioterapi', 'psikolog', 'psikiater', 'bidan',
            'perawat', 'apoteker', 'radiolog', 'patolog', 'anestesi'
        ];
    }

    private static function getCommonDiseases(): array
    {
        return [
            'dbd', 'covid', 'malaria', 'tifus', 'diabetes', 'hipertensi',
            'asma', 'stroke', 'jantung', 'kanker', 'tbc', 'hepatitis',
            'cacar air', 'campak', 'rubella', 'difteri', 'tetanus',
            'polio', 'pneumonia', 'meningitis', 'hiv', 'aids', 'bronkitis',
            'sinusitis', 'tonsilitis', 'faringitis', 'gastritis', 'kolitis',
            'artritis', 'osteoporosis', 'lupus', 'migrain', 'epilepsi',
            'parkinson', 'alzheimer', 'skizofrenia', 'depresi', 'anemia',
            'leukemia', 'hemofilia', 'talasemia', 'gondok', 'tiroid',
            'kolesterol', 'asam urat', 'rematik', 'osteoartritis', 'skoliosis',
            'hernia', 'usus buntu', 'batu ginjal', 'kista', 'mioma',
            'endometriosis', 'prostat', 'katarak', 'glaukoma', 'vertigo'
        ];
    }

    private static function getSymptoms(): array
    {
        return [
            'demam', 'pusing', 'mual', 'muntah', 'diare', 'batuk', 'pilek',
            'sesak nafas', 'lemas', 'pegal', 'meriang', 'flu', 'sakit kepala',
            'berkeringat', 'menggigil', 'kejang', 'pingsan', 'kram',
            'bengkak', 'gatal', 'ruam', 'memar', 'pendarahan', 'nyeri dada',
            'sulit tidur', 'kehilangan nafsu makan', 'berat badan turun',
            'sakit perut', 'sakit tenggorokan', 'hidung tersumbat', 'bersin',
            'batuk berdahak', 'batuk kering', 'nyeri sendi', 'nyeri otot',
            'sakit punggung', 'sakit pinggang', 'migrain', 'vertigo',
            'mual muntah', 'kembung', 'sembelit', 'susah buang air besar',
            'sering buang air kecil', 'nyeri saat buang air kecil',
            'urine keruh', 'urine berdarah', 'nafas berbau', 'bau mulut',
            'mulut kering', 'sariawan', 'lidah putih', 'suara serak',
            'telinga berdenging', 'penglihatan kabur', 'mata berair',
            'mata gatal', 'mata merah', 'kulit kering', 'kulit bersisik'
        ];
    }

    private static function getDigestiveConditions(): array
    {
        return [
            'maag', 'asam lambung', 'sembelit', 'diare', 'radang usus',
            'wasir', 'ambeien', 'gastritis', 'kolitis', 'liver',
            'usus buntu', 'perut kembung', 'mual', 'muntah', 'sakit perut',
            'susah bab', 'konstipasi', 'mencret', 'berak darah', 'tinja hitam',
            'perut bengkak', 'perut keras', 'sulit menelan', 'sendawa',
            'refluks asam', 'gerd', 'ulkus', 'tukak lambung', 'dispepsia',
            'intoleransi laktosa', 'malabsorpsi', 'disentri', 'hepatitis',
            'sirosis', 'batu empedu', 'pankreatitis', 'crohn', 'colitis ulceratif',
            'sindrom iritasi usus', 'ibs', 'perut melilit', 'perut mulas',
            'gangguan pencernaan', 'infeksi lambung', 'infeksi usus', 'parasit usus',
            'cacing', 'divertikulitis', 'fistula', 'prolaps rektum', 'stenosis pylorus',
            'gastroparesis', 'ileus', 'obstruksi usus', 'peritonitis'
        ];
    }

    private static function getSkinConditions(): array
    {
        return [
            'jerawat', 'eksim', 'panu', 'kurap', 'kudis', 'cacar',
            'dermatitis', 'psoriasis', 'vitiligo', 'bisul', 'kutil',
            'herpes', 'melanoma', 'kanker kulit', 'flek hitam',
            'bekas luka', 'keloid', 'stretch mark', 'kerutan',
            'komedo', 'bruntusan', 'milia', 'rosacea', 'selulit',
            'pigmentasi', 'bercak putih', 'bercak merah', 'ruam',
            'gatal', 'alergi kulit', 'urtikaria', 'biduran',
            'dermatofitosis', 'skabies', 'impetigo', 'folikulitis',
            'furunkel', 'karbunkel', 'selulitis', 'abses',
            'tinea versicolor', 'tinea corporis', 'tinea pedis',
            'tinea cruris', 'tinea capitis', 'kandidiasis',
            'dermatitis kontak', 'dermatitis atopik', 'dermatitis seboroik',
            'xerosis', 'ichthyosis', 'akne rosasea', 'akne vulgaris',
            'hidradenitis', 'miliaria', 'hiperpigmentasi', 'hipopigmentasi'
        ];
    }

    private static function getEyeConditions(): array
    {
        return [
            'mata minus', 'mata plus', 'katarak', 'glaukoma', 'mata merah',
            'konjungtivitis', 'rabun', 'silinder', 'mata kering', 'mata gatal',
            'mata berair', 'mata bengkak', 'mata belekan', 'mata berkedip',
            'mata sensitif cahaya', 'mata lelah', 'mata perih', 'mata buram',
            'mata juling', 'strabismus', 'keratitis', 'uveitis', 'retinopati',
            'ablasi retina', 'degenerasi makula', 'pterygium', 'hordeolum',
            'kalazion', 'blefaritis', 'entropion', 'ektropion', 'presbiopi',
            'astigmatisme', 'miopi', 'hipermetropi', 'ambliopia', 'mata malas',
            'skleritis', 'keratokonus', 'sindrom mata kering', 'floaters',
            'penglihatan ganda', 'diplopia', 'nystagmus', 'neuritis optik',
            'edema papil', 'retinitis pigmentosa', 'iridosiklitis', 'keratopati',
            'distrofi kornea', 'xeroftalmia', 'trikiasis', 'epifora',
            'anisometropia', 'anisokoria', 'skotoma', 'hemianopia'
        ];
    }

    private static function getEarConditions(): array
    {
        return [
            'telinga berdengung', 'tuli', 'infeksi telinga', 'otitis',
            'gangguan pendengaran', 'congek', 'tinnitus', 'vertigo',
            'pusing berputar', 'mabuk perjalanan', 'motion sickness',
            'telinga tersumbat', 'telinga gatal', 'telinga berair',
            'telinga bengkak', 'telinga nyeri', 'telinga berdarah',
            'telinga bernanah', 'otitis eksterna', 'otitis media',
            'otitis interna', 'labirintitis', 'penyakit meniere',
            'kolesteatoma', 'perforasi gendang telinga', 'barotrauma',
            'neuroma akustik', 'presbikusis', 'hidrops endolimfatik',
            'otosklerosis', 'gangguan vestibuler', 'sindrom meniere',
            'gangguan keseimbangan', 'disfungsi tuba eustachius',
            'serumen prop', 'penumpukan kotoran telinga', 'trauma telinga',
            'cedera telinga', 'perikondritis', 'otomikosis', 'otalgia',
            'otore', 'otorea', 'tinitus pulsatil', 'tinitus non-pulsatil',
            'gangguan saraf pendengaran', 'neuritis vestibularis',
            'sindrom ramsay hunt', 'herpes zoster otikus', 'otitis adhesiva',
            'disfungsi temporomandibular', 'gangguan artikulasi', 'gangguan bicara',
            'ketulian konduktif', 'ketulian sensorineural', 'ketulian campuran'
        ];
    }

    private static function getMentalConditions(): array
    {
        return [
            'depresi', 'anxiety', 'cemas', 'stress', 'bipolar', 'trauma',
            'insomnia', 'skizofrenia', 'gangguan mental', 'gangguan kecemasan',
            'gangguan panik', 'fobia', 'agorafobia', 'fobia sosial',
            'gangguan obsesif kompulsif', 'ocd', 'ptsd', 'gangguan stres pasca trauma',
            'gangguan mood', 'gangguan afektif', 'mania', 'hipomania',
            'gangguan kepribadian', 'borderline', 'narcissistic', 'paranoid',
            'schizoid', 'antisosial', 'avoidant', 'dependent',
            'gangguan makan', 'anoreksia', 'bulimia', 'binge eating',
            'gangguan tidur', 'parasomnia', 'narkolepsi', 'sleep apnea',
            'gangguan disosiatif', 'amnesia disosiatif', 'fugue', 'depersonalisasi',
            'gangguan penyesuaian', 'gangguan somatoform', 'hipokondriasis',
            'gangguan konversi', 'disforia gender', 'gangguan identitas',
            'adhd', 'add', 'gangguan pemusatan perhatian', 'hiperaktif',
            'gangguan perilaku', 'conduct disorder', 'oppositional defiant',
            'gangguan perkembangan', 'autisme', 'asperger', 'selective mutism',
            'gangguan pembelajaran', 'disleksia', 'diskalkulia', 'dysgraphia',
            'patah hati', 'galau', 'ditinggal pasangan', 'putus cinta',
            'kesepian', 'rindu', 'kecewa', 'sedih berkepanjangan',
            'sulit move on', 'trauma percintaan', 'overthinking',
            'kurang percaya diri', 'merasa tidak dicintai', 'rasa bersalah',
            'penyesalan', 'kehilangan semangat hidup', 'merasa hampa',
            'merasa tidak berharga', 'kesedihan mendalam', 'putus asa',
            'merasa sendiri', 'sulit melupakan', 'trauma ditinggalkan',
            'ketergantungan emosional', 'toxic relationship'
        ];
    }

    private static function getReproductiveConditions(): array
    {
        return [
            'pms', 'menstruasi', 'keputihan', 'kista', 'miom', 'endometriosis',
            'infertilitas', 'prostat', 'impotensi', 'amenore', 'dismenore',
            'menopause', 'andropause', 'vaginitis', 'salpingitis', 'ooforitis',
            'vulvitis', 'cervicitis', 'metroragia', 'oligomenore', 'polimenorea',
            'sindrom ovarium polikistik', 'pcos', 'varikokel', 'hidrokel',
            'epididimitis', 'orkitis', 'prostatitis', 'hiperplasia prostat',
            'kanker serviks', 'kanker ovarium', 'kanker prostat', 'kanker testis',
            'disfungsi ereksi', 'ejakulasi dini', 'libido rendah', 'vaginismus',
            'dispareunia', 'infeksi saluran kemih', 'hernia inguinalis',
            'kriptorkidisme', 'hipogonadisme', 'amenorea primer', 'amenorea sekunder',
            'sindrom premenstruasi', 'perdarahan uterus', 'prolaps uterus',
            'adenomiosis', 'fibroid', 'polip endometrium', 'bartholinitis',
            'vulvodynia', 'vestibulitis', 'kandidosis vulvovaginal', 'trichomoniasis',
            'bacterial vaginosis', 'myoma uteri', 'retrofleksi uterus'
        ];
    }

    private static function getBoneAndMuscleConditions(): array
    {
        return [
            'rematik', 'asam urat', 'osteoporosis', 'arthritis', 'cedera',
            'keseleo', 'patah tulang', 'nyeri otot', 'nyeri sendi', 'osteoarthritis',
            'rheumatoid arthritis', 'gout', 'fibromyalgia', 'tendinitis', 'bursitis',
            'skoliosis', 'kifosis', 'lordosis', 'hernia diskus', 'stenosis spinal',
            'spondilitis', 'spondilosis', 'osteomalasia', 'miositis', 'distrofi otot',
            'sindrom terowongan karpal', 'tennis elbow', 'frozen shoulder', 'dislokasi',
            'sprain', 'strain', 'whiplash', 'artralgia', 'mialgia', 'radikulopati',
            'sciatica', 'low back pain', 'cervicalgia', 'torticollis', 'scoliosis',
            'spina bifida', 'osteomielitis', 'artritis septik', 'artritis gout',
            'pseudogout', 'sindrom kompartemen', 'tendinopati', 'ruptur tendon',
            'sindrom rotator cuff', 'bungkuk', 'kifoskoliosis', 'osteonekrosis',
            'sindrom piriformis', 'sindrom miofasial', 'artritis psoriatik',
            'sindrom hipermobilitas', 'osteokondritis', 'kondromalasia'
        ];
    }

    private static function getDentalConditions(): array
    {
        return [
            'gigi berlubang', 'karies', 'gingivitis', 'sariawan',
            'karang gigi', 'gusi bengkak', 'sakit gigi', 'periodontitis',
            'abses gigi', 'pulpitis', 'gigi sensitif', 'gigi goyang',
            'bau mulut', 'halitosis', 'plak gigi', 'gusi berdarah',
            'resesi gusi', 'hipersensitivitas gigi', 'erosi gigi',
            'fluorosis', 'diskolorasi gigi', 'gigi kuning',
            'maloklusi', 'gigi berjejal', 'gigi tonggos', 'celah gigi',
            'bruksisme', 'gigi gemelutuk', 'tmj', 'sendi rahang',
            'trismus', 'rahang kaku', 'impaksi gigi', 'gigi bungsu',
            'fraktur gigi', 'gigi patah', 'gigi retak', 'enamel rusak',
            'nekrosis pulpa', 'granuloma', 'kista gigi', 'fistula gigi',
            'stomatitis', 'candidiasis oral', 'leukoplakia',
            'angular cheilitis', 'herpes labialis', 'glositis',
            'lidah putih', 'lidah hitam', 'lidah geografis',
            'xerostomia', 'mulut kering', 'hipersalivasi', 'drooling',
            'perforasi palatum', 'langit-langit berlubang'
        ];
    }

    private static function getHeartConditions(): array
    {
        return [
            'jantung koroner', 'serangan jantung', 'gagal jantung',
            'aritmia', 'kardiomegali', 'hipertensi', 'angina pektoris',
            'penyakit jantung iskemik', 'penyakit jantung bawaan',
            'kardiomiopati', 'endokarditis', 'perikarditis', 'miokarditis',
            'fibrilasi atrium', 'takikardia', 'bradikardia', 'murmur jantung',
            'stenosis aorta', 'regurgitasi mitral', 'prolaps katup mitral',
            'defek septum atrium', 'defek septum ventrikel', 'aterosklerosis',
            'trombosis koroner', 'syok kardiogenik', 'tamponade jantung',
            'hipertensi pulmonal', 'cor pulmonale', 'sindrom brugada',
            'sindrom wolff-parkinson-white', 'blok jantung', 'ekstrasistol',
            'penyakit jantung rematik', 'aneurisma aorta', 'diseksi aorta',
            'varises vena', 'tromboflebitis', 'insufisiensi vena',
            'penyakit arteri perifer', 'sindrom raynaud', 'vaskulitis',
            'hipertensi sekunder', 'krisis hipertensi', 'hipotensi',
            'sinkop vasovagal', 'edema paru', 'efusi perikard',
            'kardiomiopati dilatasi', 'kardiomiopati hipertrofik',
            'kardiomiopati restriktif', 'penyakit kawasaki',
            'sindrom marfan', 'disfungsi diastolik', 'disfungsi sistolik',
            'penyakit jantung valvular', 'stenosis pulmonal'
        ];
    }

    private static function getRespiratoryConditions(): array
    {
        return [
            'asma', 'bronkitis', 'pneumonia', 'tbc', 'ispa',
            'emfisema', 'sinusitis', 'polip', 'bronkiektasis',
            'pleuritis', 'efusi pleura', 'pneumotoraks', 'atelektasis',
            'fibrosis paru', 'sarkoidosis', 'bronkiolitis',
            'laringitis', 'faringitis', 'tonsilitis', 'adenoiditis',
            'rinitis', 'rinosinusitis', 'deviasi septum', 'polip hidung',
            'obstructive sleep apnea', 'narkolepsi', 'hiperventilasi',
            'dispnea', 'hemoptisis', 'batuk kronis', 'batuk berdarah',
            'batuk berdahak', 'sesak napas', 'wheezing', 'stridor',
            'aspirasi benda asing', 'edema laring', 'abses peritonsil',
            'penyakit paru obstruktif kronik', 'ppok', 'embolisme paru',
            'hipertensi pulmonal', 'cor pulmonale', 'kanker paru',
            'mesothelioma', 'bronkospasme', 'sindrom distres pernapasan',
            'ards', 'pneumonitis', 'pneumokoniosis', 'asbestosis',
            'silikosis', 'bersin-bersin', 'pilek', 'hidung tersumbat',
            'radang tenggorokan', 'suara serak'
        ];
    }

    private static function getNervousSystemConditions(): array
    {
        return [
            'stroke', 'epilepsi', 'alzheimer', 'parkinson',
            'migrain', 'vertigo', 'kejang', 'meningitis',
            'ensefalitis', 'miastenia gravis', 'sklerosis lateral',
            'neuritis', 'sindrom guillain-barre', 'tumor otak',
            'hidrosefalus', 'aneurisma otak', 'demensia',
            'neuropati', 'neuralgia', 'ataksia', 'distonia',
            'sindrom tourette', 'narkolepsi', 'insomnia',
            'sleep apnea', 'parasomnia', 'amnesia',
            'afasia', 'disleksia', 'autisme', 'adhd',
            'depresi', 'anxiety', 'bipolar', 'skizofrenia',
            'ocd', 'ptsd', 'gangguan panik', 'fobia',
            'tremor', 'disartria', 'disfagia', 'atrofi otot',
            'paralisis', 'hemiplegia', 'paraplegia', 'quadriplegia',
            'spastisitas', 'sindrom carpal tunnel', 'herniasi diskus',
            'radikulopati', 'mielopati', 'sindrom locked-in',
            'koma', 'vegetative state', 'sindrom down'
        ];
    }

    private static function getEndocrineConditions(): array
    {
        return [
            'diabetes', 'diabetes tipe 1', 'diabetes tipe 2', 'diabetes gestasional',
            'hipotiroid', 'hipertiroid', 'tiroiditis', 'gondok', 'struma',
            'penyakit graves', 'penyakit hashimoto', 'nodul tiroid', 'kanker tiroid',
            'hiperparatiroid', 'hipoparatiroid', 'sindrom cushing', 'penyakit addison',
            'feokromositoma', 'akromegali', 'gigantisme', 'hipopituitarisme',
            'hiperprolaktinemia', 'diabetes insipidus', 'sindrom siadh',
            'hipogonadisme', 'pubertas prekoks', 'pubertas terlambat',
            'sindrom ovarium polikistik', 'pcos', 'hirsutisme',
            'obesitas', 'malnutrisi', 'anoreksia', 'bulimia',
            'hiperglikemia', 'hipoglikemia', 'resistensi insulin',
            'sindrom metabolik', 'dislipidemia', 'hiperkolesterolemia',
            'hipertrigliseridemia', 'osteoporosis', 'osteomalasia',
            'hiperaldosteronisme', 'hipoaldosteronisme', 'hiperkalemia',
            'hipokalemia', 'hiperkalsemia', 'hipokalsemia',
            'hipernatremia', 'hiponatremia', 'gangguan elektrolit',
            'ketoacidosis diabetik', 'hiperosmolar hiperglikemik'
        ];
    }

    private static function getAutoimmuneConditions(): array
    {
        return [
            'lupus', 'multiple sclerosis', 'rheumatoid arthritis',
            'psoriasis', 'vitiligo', 'alergi', 'scleroderma',
            'sindrom sjogren', 'vaskulitis', 'myasthenia gravis',
            'penyakit celiac', 'diabetes tipe 1', 'tiroiditis hashimoto',
            'penyakit graves', 'polymyositis', 'dermatomyositis',
            'sindrom antifosfolipid', 'skleroderma', 'pemfigus',
            'pemfigoid', 'sindrom guillain-barre', 'artritis psoriatik',
            'spondilitis ankilosa', 'sindrom reiter', 'polimialgia reumatika',
            'arteritis temporal', 'granulomatosis wegener', 'sindrom churg-strauss',
            'poliarteritis nodosa', 'hepatitis autoimun', 'kolangitis bilier primer',
            'sindrom goodpasture', 'ensefalitis autoimun', 'myelitis transversa',
            'sindrom evans', 'neutropenia autoimun', 'trombositopenia autoimun',
            'anemia hemolitik autoimun', 'sindrom behcet', 'sarkoidosis',
            'dermatitis herpetiformis', 'alopecia areata', 'vitiligo',
            'skleroderma lokal', 'morfea', 'fasciitis eosinofilik',
            'sindrom crest', 'mixed connective tissue disease',
            'overlap syndrome', 'undifferentiated connective tissue disease',
            'polymyositis', 'inclusion body myositis', 'juvenile arthritis',
            'uveitis', 'scleritis', 'vaskulitis retina'
        ];
    }

    private static function getBloodConditions(): array
    {
        return [
            'anemia', 'leukemia', 'hemofilia', 'thalassemia', 'trombosis', 'kurang darah',
            'polisitemia', 'trombositopenia', 'trombositosis', 'neutropenia', 'neutrofilia',
            'limfopenia', 'limfositosis', 'pancytopenia', 'agranulocytosis', 'leukopenia',
            'leukositosis', 'myelodysplasia', 'myelofibrosis', 'multiple myeloma',
            'lymphoma', 'hodgkin', 'non-hodgkin', 'anemia aplastik', 'anemia defisiensi besi',
            'anemia megaloblastik', 'anemia pernisiosa', 'anemia hemolitik',
            'spherocytosis', 'sickle cell', 'von willebrand', 'purpura', 'hemokromatosis',
            'gangguan pembekuan darah', 'defisiensi faktor viii', 'defisiensi faktor ix',
            'trombofilia', 'emboli', 'dvt', 'disseminated intravascular coagulation',
            'idiopathic thrombocytopenic purpura', 'essential thrombocythemia',
            'polycythemia vera', 'myeloma', 'waldenstrom macroglobulinemia',
            'hemoglobinopati', 'porfiri', 'talasemia alfa', 'talasemia beta',
            'gangguan sel darah merah', 'gangguan sel darah putih', 'gangguan trombosit',
            'kelainan sumsum tulang', 'gangguan koagulasi', 'kelainan plasma darah'
        ];
    }

    private static function getPreventiveCare(): array
    {
        return [
            'imunisasi', 'vaksinasi', 'vitamin', 'suplemen', 'check up',
            'skrining', 'deteksi dini', 'pola hidup sehat', 'olahraga',
            'nutrisi', 'diet', 'konsultasi', 'cek darah', 'cek kolesterol',
            'cek gula darah', 'cek tekanan darah', 'cek kesehatan',
            'pemeriksaan rutin', 'pap smear', 'mammografi', 'kolonoskopi skrining',
            'vaksin flu', 'vaksin hepatitis', 'vaksin hpv', 'vaksin pneumonia',
            'vaksin tetanus', 'suplemen kalsium', 'suplemen zat besi', 'suplemen omega 3',
            'suplemen vitamin d', 'suplemen multivitamin', 'senam', 'yoga', 'meditasi',
            'tidur cukup', 'makan sehat', 'kontrol berat badan', 'berhenti merokok',
            'hindari alkohol', 'cuci tangan', 'kebersihan diri', 'kebersihan gigi',
            'periksa gigi', 'periksa mata', 'cek pendengaran', 'cek densitas tulang',
            'cek fungsi tiroid', 'cek fungsi ginjal', 'cek fungsi hati',
            'pemeriksaan prostat', 'pemeriksaan payudara', 'pemeriksaan kulit',
            'manajemen stres', 'program kebugaran', 'konseling gizi',
            'pemeriksaan mental', 'vaksin covid', 'program berhenti merokok'
        ];
    }

    private static function getEmergencyConditions(): array
    {
        return [
            'kecelakaan', 'trauma', 'luka bakar', 'patah tulang',
            'serangan jantung', 'stroke', 'keracunan', 'overdosis', 
            'gigitan', 'sengatan', 'tenggelam', 'tersedak', 'pingsan',
            'pendarahan hebat', 'kejang', 'shock', 'koma', 'sesak napas',
            'kesulitan bernapas', 'nyeri dada', 'cedera kepala', 'cedera leher',
            'cedera tulang belakang', 'luka tusuk', 'luka tembak', 'perdarahan dalam',
            'dehidrasi berat', 'hipotermia', 'hipertermia', 'serangan asma',
            'reaksi alergi', 'anafilaksis', 'keracunan makanan', 'keracunan gas',
            'keracunan obat', 'gigitan ular', 'gigitan serangga', 'sengatan lebah',
            'sengatan ubur-ubur', 'luka bakar kimia', 'luka bakar listrik',
            'tersengat listrik', 'hipoglikemia', 'hiperglikemia', 'meningitis',
            'appendisitis', 'ruptur organ', 'perdarahan otak', 'emboli paru',
            'pneumotoraks', 'henti jantung', 'aritmia berat', 'syok kardiogenik',
            'gagal napas', 'gagal jantung akut', 'gagal ginjal akut',
            'kejang demam', 'status epileptikus', 'trauma mata'
        ];
    }

    private static function getMedicalProcedures(): array
    {
        return [
            'operasi', 'bedah', 'jahit luka', 'suntik', 'infus',
            'transfusi', 'kemoterapi', 'radioterapi', 'dialisis',
            'transplantasi', 'implan', 'amputasi', 'biopsi',
            'endoskopi', 'kolonoskopi', 'rontgen', 'ct scan', 'mri',
            'usg', 'ekg', 'rehabilitasi', 'fisioterapi', 'angiografi',
            'bronkoskopi', 'laparoskopi', 'torakoskopi', 'krioterapi',
            'terapi laser', 'terapi hormon', 'imunoterapi', 'anestesi',
            'sedasi', 'intubasi', 'kateterisasi', 'aspirasi', 'drainase',
            'kuretase', 'sirkumsisi', 'vasektomi', 'tubektomi', 'histerektomi',
            'tonsilektomi', 'apendektomi', 'gastroskopi', 'kolostomi',
            'trakeostomi', 'mammografi', 'spirometri', 'audiometri',
            'elektroforesis', 'spinal tap', 'pungsi', 'biopsi sumsum tulang',
            'embolisasi', 'litotripsi', 'terapi radiasi', 'terapi gen',
            'terapi sel punca', 'terapi plasma', 'terapi oksigen',
            'terapi insulin', 'terapi ozon', 'terapi proton'
        ];
    }
}

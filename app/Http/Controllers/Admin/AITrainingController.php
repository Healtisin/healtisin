<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Greetings;
use App\Constants\HealthKeywords;
use App\Constants\QuestionPatterns;

class AITrainingController extends Controller
{
    /**
     * Menampilkan halaman Prompt Engineering
     */
    public function promptEngineering()
    {
        return view('admin.ai-training.prompt-engineering');
    }

    /**
     * Menampilkan halaman Fine-tuning untuk melatih model AI
     */
    public function fineTuning()
    {
        return view('admin.ai-training.fine-tuning');
    }

    /**
     * Menampilkan halaman Keywords dan Patterns
     */
    public function keywordsPatterns()
    {
        return view('admin.ai-training.keywords-patterns');
    }
        
    /**
     * Menampilkan halaman Greetings
     */
    public function greetings()
    {
        // Dapatkan data kategori Greetings
        $greetingsData = [
            'basic' => $this->callPrivateMethod(Greetings::class, 'getBasicGreetings'),
            'formal' => $this->callPrivateMethod(Greetings::class, 'getFormalGreetings'),
            'religious' => $this->callPrivateMethod(Greetings::class, 'getReligiousGreetings'),
            'polite' => $this->callPrivateMethod(Greetings::class, 'getPoliteExpressions'),
            'healthcare' => $this->callPrivateMethod(Greetings::class, 'getHealthcareGreetings'),
        ];
        
        return view('admin.ai-training.greetings', compact('greetingsData'));
    }

    /**
     * Menampilkan halaman Health Keywords
     */
    public function healthKeywords()
    {
        // Dapatkan data kategori Health Keywords
        $healthKeywordsData = [
            'basic' => $this->callPrivateMethod(HealthKeywords::class, 'getBasicKeywords'),
            'diseases' => $this->callPrivateMethod(HealthKeywords::class, 'getCommonDiseases'),
            'symptoms' => $this->callPrivateMethod(HealthKeywords::class, 'getSymptoms'),
            'digestive' => $this->callPrivateMethod(HealthKeywords::class, 'getDigestiveConditions'),
            'skin' => $this->callPrivateMethod(HealthKeywords::class, 'getSkinConditions'),
            'eye' => $this->callPrivateMethod(HealthKeywords::class, 'getEyeConditions'),
            'ear' => $this->callPrivateMethod(HealthKeywords::class, 'getEarConditions'),
            'mental' => $this->callPrivateMethod(HealthKeywords::class, 'getMentalConditions'),
            'reproductive' => $this->callPrivateMethod(HealthKeywords::class, 'getReproductiveConditions'),
            'bone' => $this->callPrivateMethod(HealthKeywords::class, 'getBoneAndMuscleConditions'),
            'dental' => $this->callPrivateMethod(HealthKeywords::class, 'getDentalConditions'),
            'heart' => $this->callPrivateMethod(HealthKeywords::class, 'getHeartConditions'),
            'respiratory' => $this->callPrivateMethod(HealthKeywords::class, 'getRespiratoryConditions'),
            'nervous' => $this->callPrivateMethod(HealthKeywords::class, 'getNervousSystemConditions'),
            'endocrine' => $this->callPrivateMethod(HealthKeywords::class, 'getEndocrineConditions'),
            'autoimmune' => $this->callPrivateMethod(HealthKeywords::class, 'getAutoimmuneConditions'),
            'blood' => $this->callPrivateMethod(HealthKeywords::class, 'getBloodConditions'),
            'preventive' => $this->callPrivateMethod(HealthKeywords::class, 'getPreventiveCare'),
            'emergency' => $this->callPrivateMethod(HealthKeywords::class, 'getEmergencyConditions'),
            'procedures' => $this->callPrivateMethod(HealthKeywords::class, 'getMedicalProcedures'),
        ];

        return view('admin.ai-training.health-keywords', compact('healthKeywordsData'));
    }

    /**
     * Menampilkan halaman Question Patterns
     */
    public function questionPatterns()
    {
        $questionPatterns = QuestionPatterns::DESCRIPTIVE_PATTERNS;
        return view('admin.ai-training.question-patterns', compact('questionPatterns'));
    }

    /**
     * Memanggil method private dari sebuah class
     */
    private function callPrivateMethod($class, $methodName)
    {
        try {
            $reflectionMethod = new \ReflectionMethod($class, $methodName);
            $reflectionMethod->setAccessible(true);
            return $reflectionMethod->invoke(null);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Menyimpan perubahan pada prompt
     */
    public function savePrompt(Request $request)
    {
        $request->validate([
            'prompt_type' => 'required|string',
            'prompt_content' => 'required|string',
        ]);

        try {
            // Path untuk menyimpan file prompts
            $promptsPath = storage_path('app/prompts');
            
            // Buat direktori jika belum ada
            if (!file_exists($promptsPath)) {
                mkdir($promptsPath, 0755, true);
            }
            
            // Nama file berdasarkan jenis prompt
            $filename = $promptsPath . '/' . $request->prompt_type . '.json';
            
            // Data prompt yang akan disimpan
            $promptData = [
                'type' => $request->prompt_type,
                'content' => $request->prompt_content,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
            
            // Jika file sudah ada, update timestamp
            if (file_exists($filename)) {
                $existingData = json_decode(file_get_contents($filename), true);
                $promptData['created_at'] = $existingData['created_at'] ?? now()->toDateTimeString();
            }
            
            // Simpan data ke file JSON
            file_put_contents($filename, json_encode($promptData, JSON_PRETTY_PRINT));
            
            // Log aktivitas
            activity()
                ->causedBy(auth()->user())
                ->log('Menyimpan prompt baru: ' . $request->prompt_type);
        
        return redirect()->back()->with('success', 'Prompt berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan prompt: ' . $e->getMessage());
        }
    }

    /**
     * Upload dataset untuk fine-tuning
     */
    public function uploadDataset(Request $request)
    {
        $request->validate([
            'dataset_file' => 'required|file|mimes:json,csv,txt|max:10240',
            'model_name' => 'required|string|max:255',
        ]);

        try {
            // Path untuk menyimpan dataset
            $datasetPath = storage_path('app/datasets');
            
            // Buat direktori jika belum ada
            if (!file_exists($datasetPath)) {
                mkdir($datasetPath, 0755, true);
            }
            
            // Generate nama unik untuk file
            $fileName = time() . '_' . $request->file('dataset_file')->getClientOriginalName();
            
            // Simpan file
            $filePath = $request->file('dataset_file')->storeAs('datasets', $fileName);
            
            // Simpan metadata dataset ke database
            $dataset = new \App\Models\Dataset();
            $dataset->name = $request->model_name;
            $dataset->file_path = $filePath;
            $dataset->status = 'uploaded';
            $dataset->user_id = auth()->id();
            $dataset->save();
            
            // Log aktivitas
            activity()
                ->causedBy(auth()->user())
                ->performedOn($dataset)
                ->log('Mengupload dataset baru: ' . $request->model_name);

        return redirect()->back()->with('success', 'Dataset berhasil diupload');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload dataset: ' . $e->getMessage());
        }
    }

    /**
     * Memulai proses fine-tuning
     */
    public function startFineTuning(Request $request)
    {
        $request->validate([
            'dataset_id' => 'required|integer',
            'parameters' => 'required|array',
        ]);

        try {
            // Ambil data dataset
            $dataset = \App\Models\Dataset::findOrFail($request->dataset_id);
            
            // Validasi status dataset
            if ($dataset->status !== 'uploaded') {
                return redirect()->back()->with('error', 'Dataset harus dalam status uploaded untuk memulai fine-tuning');
            }
            
            // Update status dataset
            $dataset->status = 'processing';
            $dataset->save();
            
            // Buat job untuk proses fine-tuning
            \App\Jobs\ProcessFineTuning::dispatch($dataset, $request->parameters)
                ->onQueue('fine-tuning');
            
            // Log aktivitas
            activity()
                ->causedBy(auth()->user())
                ->performedOn($dataset)
                ->log('Memulai fine-tuning untuk dataset: ' . $dataset->name);
                
            return redirect()->back()->with('success', 'Proses fine-tuning berhasil dimulai. Anda akan menerima notifikasi setelah proses selesai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memulai fine-tuning: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan perubahan pada keywords dan patterns
     */
    public function saveKeywordsPatterns(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:greetings,health_keywords,question_patterns',
        ]);

        $type = $request->input('type');
        
        if ($type === 'question_patterns') {
            $request->validate(['pattern' => 'required|string']);
            
            // Jika ada index pattern, berarti ini adalah update
            if ($request->has('pattern_index') && $request->input('pattern_index') != -1) {
                $patternIndex = (int) $request->input('pattern_index');
                
                // Update pattern yang sudah ada
                $this->updateQuestionPattern($patternIndex, $request->input('pattern'));
                
                return redirect()->back()->with('success', 'Pattern berhasil diperbarui');
            } else {
                // Tambahkan pattern baru
                $this->addQuestionPattern($request->input('pattern'));
                
                return redirect()->back()->with('success', 'Pattern baru berhasil ditambahkan');
            }
        } else {
            $request->validate([
                'keyword' => 'required|string',
                'category' => 'required|string',
            ]);
            
            $keyword = $request->input('keyword');
            $category = $request->input('category');
            
            // Tambahkan keyword baru
            if ($type === 'greetings') {
                $this->addGreetingKeyword($keyword, $category);
            } else {
                $this->addHealthKeyword($keyword, $category);
            }
            
            return redirect()->back()->with('success', 'Keyword berhasil ditambahkan');
        }
    }

    /**
     * Menghapus keyword atau pattern
     */
    public function deleteKeywordPattern(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:greetings,health_keywords,question_patterns',
        ]);
        
        $type = $request->input('type');
        
        if ($type === 'question_patterns') {
            $request->validate(['pattern_index' => 'required|integer']);
            $patternIndex = (int) $request->input('pattern_index');
            
            // Hapus pattern
            $this->deleteQuestionPattern($patternIndex);
            
            return redirect()->back()->with('success', 'Pattern berhasil dihapus');
        } else {
            $request->validate(['keyword' => 'required|string']);
            $keyword = $request->input('keyword');
            
            // Hapus keyword
            if ($type === 'greetings') {
                $this->deleteGreetingKeyword($keyword);
            } else {
                $this->deleteHealthKeyword($keyword);
            }
            
            return redirect()->back()->with('success', 'Keyword berhasil dihapus');
        }
    }

    /**
     * Metode-metode helper untuk memanipulasi file konstanta
     */
    private function addQuestionPattern($pattern)
    {
        // Implementasi untuk menambahkan pattern ke QuestionPatterns.php
        // Contoh dengan pendekatan file manipulation:
        $filePath = app_path('Constants/QuestionPatterns.php');
        $fileContent = file_get_contents($filePath);
        
        // Mencari posisi array DESCRIPTIVE_PATTERNS
        $patternStart = strpos($fileContent, 'DESCRIPTIVE_PATTERNS = [');
        $patternEnd = strpos($fileContent, '];', $patternStart);
        
        // Siapkan pattern baru dengan format yang benar
        $newPattern = "        '{$pattern}',\n";
        
        // Sisipkan pattern baru sebelum tutup array
        $newContent = substr($fileContent, 0, $patternEnd) . 
                      $newPattern . 
                      substr($fileContent, $patternEnd);
        
        // Simpan perubahan
        file_put_contents($filePath, $newContent);
    }

    private function updateQuestionPattern($index, $newPattern)
    {
        // Implementasi untuk mengupdate pattern di QuestionPatterns.php
        // Pendekatan: Baca seluruh array, update elemen tertentu, tulis ulang file
        $patterns = QuestionPatterns::DESCRIPTIVE_PATTERNS;
        
        if (isset($patterns[$index])) {
            $filePath = app_path('Constants/QuestionPatterns.php');
            $fileContent = file_get_contents($filePath);
            
            // Ganti pattern lama dengan yang baru
            $oldPattern = $patterns[$index];
            $escapedOldPattern = preg_quote($oldPattern, '/');
            $newContent = preg_replace("/'$escapedOldPattern'/", "'$newPattern'", $fileContent);
            
            // Simpan perubahan
            file_put_contents($filePath, $newContent);
        }
    }

    private function deleteQuestionPattern($index)
    {
        // Implementasi untuk menghapus pattern dari QuestionPatterns.php
        $patterns = QuestionPatterns::DESCRIPTIVE_PATTERNS;
        
        if (isset($patterns[$index])) {
            $filePath = app_path('Constants/QuestionPatterns.php');
            $fileContent = file_get_contents($filePath);
            
            // Hapus baris pattern yang dipilih
            $pattern = $patterns[$index];
            $escapedPattern = preg_quote($pattern, '/');
            $newContent = preg_replace("/\s*'$escapedPattern',\n/", "\n", $fileContent);
            
            // Simpan perubahan
            file_put_contents($filePath, $newContent);
        }
    }

    private function addGreetingKeyword($keyword, $category)
    {
        // Implementasi untuk menambahkan greeting keyword
        $filePath = app_path('Constants/Greetings.php');
        $fileContent = file_get_contents($filePath);
        
        // Tentukan metode mana yang akan diedit berdasarkan kategori
        $methodName = '';
        switch ($category) {
            case 'basic':
                $methodName = 'getBasicGreetings';
                break;
            case 'formal':
                $methodName = 'getFormalGreetings';
                break;
            case 'religious':
                $methodName = 'getReligiousGreetings';
                break;
            case 'polite':
                $methodName = 'getPoliteExpressions';
                break;
            case 'healthcare':
                $methodName = 'getHealthcareGreetings';
                break;
        }
        
        if (!empty($methodName)) {
            // Cari posisi array dalam metode yang dipilih
            $methodStart = strpos($fileContent, "private static function $methodName()");
            $arrayStart = strpos($fileContent, 'return [', $methodStart);
            $arrayEnd = strpos($fileContent, '];', $arrayStart);
            
            // Siapkan keyword baru dengan format yang benar
            $newKeyword = "            '$keyword',\n";
            
            // Sisipkan keyword baru sebelum tutup array
            $newContent = substr($fileContent, 0, $arrayEnd) . 
                        $newKeyword . 
                        substr($fileContent, $arrayEnd);
            
            // Simpan perubahan
            file_put_contents($filePath, $newContent);
        }
    }

    private function deleteGreetingKeyword($keyword)
    {
        // Implementasi untuk menghapus greeting keyword
        $filePath = app_path('Constants/Greetings.php');
        $fileContent = file_get_contents($filePath);
        
        // Hapus keyword dari file
        $escapedKeyword = preg_quote($keyword, '/');
        $newContent = preg_replace("/\s*'$escapedKeyword',\n/", "\n", $fileContent);
        
        // Simpan perubahan
        file_put_contents($filePath, $newContent);
    }

    private function addHealthKeyword($keyword, $category)
    {
        // Implementasi untuk menambahkan health keyword
        $filePath = app_path('Constants/HealthKeywords.php');
        $fileContent = file_get_contents($filePath);
        
        // Tentukan metode mana yang akan diedit berdasarkan kategori
        $methodName = '';
        switch ($category) {
            case 'basic':
                $methodName = 'getBasicKeywords';
                break;
            case 'diseases':
                $methodName = 'getCommonDiseases';
                break;
            case 'symptoms':
                $methodName = 'getSymptoms';
                break;
            case 'digestive':
                $methodName = 'getDigestiveConditions';
                break;
            case 'skin':
                $methodName = 'getSkinConditions';
                break;
            case 'eye':
                $methodName = 'getEyeConditions';
                break;
            case 'ear':
                $methodName = 'getEarConditions';
                break;
            case 'mental':
                $methodName = 'getMentalConditions';
                break;
            case 'reproductive':
                $methodName = 'getReproductiveConditions';
                break;
            case 'bone':
                $methodName = 'getBoneAndMuscleConditions';
                break;
            case 'dental':
                $methodName = 'getDentalConditions';
                break;
            case 'heart':
                $methodName = 'getHeartConditions';
                break;
            case 'respiratory':
                $methodName = 'getRespiratoryConditions';
                break;
            case 'nervous':
                $methodName = 'getNervousSystemConditions';
                break;
            case 'endocrine':
                $methodName = 'getEndocrineConditions';
                break;
            case 'autoimmune':
                $methodName = 'getAutoimmuneConditions';
                break;
            case 'blood':
                $methodName = 'getBloodConditions';
                break;
            case 'preventive':
                $methodName = 'getPreventiveCare';
                break;
            case 'emergency':
                $methodName = 'getEmergencyConditions';
                break;
            case 'procedures':
                $methodName = 'getMedicalProcedures';
                break;
        }
        
        if (!empty($methodName)) {
            // Cari posisi array dalam metode yang dipilih
            $methodStart = strpos($fileContent, "private static function $methodName()");
            $arrayStart = strpos($fileContent, 'return [', $methodStart);
            $arrayEnd = strpos($fileContent, '];', $arrayStart);
            
            // Siapkan keyword baru dengan format yang benar
            $newKeyword = "            '$keyword',\n";
            
            // Sisipkan keyword baru sebelum tutup array
            $newContent = substr($fileContent, 0, $arrayEnd) . 
                        $newKeyword . 
                        substr($fileContent, $arrayEnd);
            
            // Simpan perubahan
            file_put_contents($filePath, $newContent);
        }
    }

    private function deleteHealthKeyword($keyword)
    {
        // Implementasi untuk menghapus health keyword
        $filePath = app_path('Constants/HealthKeywords.php');
        $fileContent = file_get_contents($filePath);
        
        // Hapus keyword dari file
        $escapedKeyword = preg_quote($keyword, '/');
        $newContent = preg_replace("/\s*'$escapedKeyword',\n/", "\n", $fileContent);
        
        // Simpan perubahan
        file_put_contents($filePath, $newContent);
    }
}

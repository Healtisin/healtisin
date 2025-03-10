<?php

namespace App\Jobs;

use App\Models\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FineTuningCompleted;
use App\Exceptions\AIServiceException;

class ProcessFineTuning implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Jumlah percobaan maksimum.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Dataset yang akan diproses.
     *
     * @var \App\Models\Dataset
     */
    protected $dataset;

    /**
     * Parameter untuk fine-tuning.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\Dataset  $dataset
     * @param  array  $parameters
     * @return void
     */
    public function __construct(Dataset $dataset, array $parameters)
    {
        $this->dataset = $dataset;
        $this->parameters = $parameters;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Memulai fine-tuning untuk dataset: ' . $this->dataset->name);
            
            // Mengambil path file dataset
            $filePath = storage_path('app/' . $this->dataset->file_path);
            
            if (!file_exists($filePath)) {
                throw new AIServiceException('File dataset tidak ditemukan.');
            }
            
            // Proses fine-tuning
            // 1. Persiapan data
            $this->prepareData($filePath);
            
            // 2. Mulai fine-tuning
            $results = $this->startFineTuningProcess();
            
            // 3. Simpan hasil
            $this->dataset->result_data = $results;
            $this->dataset->status = 'completed';
            $this->dataset->save();
            
            // 4. Kirim notifikasi
            $this->sendNotification();
            
            Log::info('Fine-tuning selesai untuk dataset: ' . $this->dataset->name);
        } catch (\Exception $e) {
            Log::error('Fine-tuning gagal: ' . $e->getMessage());
            
            $this->dataset->result_data = [
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ];
            $this->dataset->status = 'failed';
            $this->dataset->save();
            
            // Kirim notifikasi kegagalan
            $this->sendFailureNotification($e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Mempersiapkan data untuk fine-tuning.
     *
     * @param  string  $filePath
     * @return void
     */
    protected function prepareData($filePath)
    {
        // Implementasi persiapan data untuk fine-tuning
        // Contoh: konversi data ke format yang diperlukan oleh API
        
        Log::info('Mempersiapkan data untuk fine-tuning');
        
        // Simulasi persiapan data
        sleep(2);
    }
    
    /**
     * Memulai proses fine-tuning sebenarnya.
     *
     * @return array
     */
    protected function startFineTuningProcess()
    {
        // Implementasi panggilan ke API fine-tuning
        // Contoh: memanggil OpenAI API atau API lain untuk fine-tuning
        
        Log::info('Menjalankan proses fine-tuning dengan parameter: ' . json_encode($this->parameters));
        
        // Simulasi proses fine-tuning yang memakan waktu
        sleep(5);
        
        // Contoh hasil
        return [
            'model_id' => 'ft-' . uniqid(),
            'training_file' => $this->dataset->file_path,
            'created_at' => now()->toDateTimeString(),
            'finished_at' => now()->addMinutes(5)->toDateTimeString(),
            'parameters' => $this->parameters,
            'training_metrics' => [
                'epochs' => 3,
                'loss' => 0.056,
                'accuracy' => 0.92
            ]
        ];
    }
    
    /**
     * Kirim notifikasi bahwa fine-tuning selesai.
     *
     * @return void
     */
    protected function sendNotification()
    {
        Notification::send(
            $this->dataset->user,
            new FineTuningCompleted($this->dataset)
        );
    }
    
    /**
     * Kirim notifikasi bahwa fine-tuning gagal.
     *
     * @param  string  $errorMessage
     * @return void
     */
    protected function sendFailureNotification($errorMessage)
    {
        Notification::send(
            $this->dataset->user,
            new FineTuningCompleted($this->dataset, true, $errorMessage)
        );
    }
} 
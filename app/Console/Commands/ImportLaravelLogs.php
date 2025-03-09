<?php

namespace App\Console\Commands;

use App\Models\FileLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportLaravelLogs extends Command
{
    protected $signature = 'logs:import';
    protected $description = 'Import logs from laravel.log file to database';

    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (!File::exists($logPath)) {
            $this->error('Laravel log file not found!');
            return 1;
        }

        $contents = File::get($logPath);
        $pattern = '/\[(?<date>.*)\] (?<env>\w+)\.(?<type>\w+): (?<message>.*)/';
        
        preg_match_all($pattern, $contents, $matches, PREG_SET_ORDER);
        
        $count = 0;
        foreach ($matches as $match) {
            $logDate = Carbon::parse($match['date']);
            
            // Cek apakah log sudah ada di database
            $exists = FileLog::where('created_at', $logDate)
                ->where('type', strtolower($match['type']))
                ->where('message', $match['message'])
                ->exists();
            
            if (!$exists) {
                FileLog::create([
                    'type' => strtolower($match['type']),
                    'message' => $match['message'],
                    'created_at' => $logDate,
                    'updated_at' => $logDate,
                ]);
                $count++;
            }
        }

        $this->info("Successfully imported {$count} new logs.");
        return 0;
    }
} 
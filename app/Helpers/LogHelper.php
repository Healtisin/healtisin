<?php

namespace App\Helpers;

use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class LogHelper
{
    // Konstanta untuk tipe log
    const ERROR = 'error';
    const WARNING = 'warning';
    const INFO = 'info';
    const AUDIT_SUCCESS = 'audit_success';
    const AUDIT_FAILURE = 'audit_failure';

    // Konstanta untuk segmen
    const SEGMENT_TRANSACTION = 'transaction';
    const SEGMENT_USER = 'user';
    const SEGMENT_API = 'api';
    const SEGMENT_VIEW = 'view';
    const SEGMENT_SYSTEM = 'system';

    /**
     * Mencatat log ke dalam database dan file
     *
     * @param string $type Tipe log (error, warning, info, audit_success, audit_failure)
     * @param string $segment Segmen aplikasi (transaction, user, api, view, system)
     * @param string $message Pesan log
     * @param array|null $data Data tambahan (opsional)
     * @return SystemLog
     */
    public static function log(string $type, string $segment, string $message, ?array $data = null): SystemLog
    {
        $userId = Auth::id();
        $context = [
            'segment' => $segment,
            'user_id' => $userId,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'data' => $data
        ];
        
        // Log ke file laravel.log
        switch ($type) {
            case self::ERROR:
                Log::error($message, $context);
                break;
            case self::WARNING:
                Log::warning($message, $context);
                break;
            case self::INFO:
                Log::info($message, $context);
                break;
            case self::AUDIT_SUCCESS:
            case self::AUDIT_FAILURE:
                Log::info("AUDIT: [{$type}] {$message}", $context);
                break;
        }

        // Log ke database
        return SystemLog::create([
            'type' => $type,
            'segment' => $segment,
            'message' => $message,
            'user_id' => $userId,
            'data' => $data,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Mencatat log error
     */
    public static function error(string $segment, string $message, ?array $data = null): SystemLog
    {
        return self::log(self::ERROR, $segment, $message, $data);
    }

    /**
     * Mencatat log warning
     */
    public static function warning(string $segment, string $message, ?array $data = null): SystemLog
    {
        return self::log(self::WARNING, $segment, $message, $data);
    }

    /**
     * Mencatat log informasi
     */
    public static function info(string $segment, string $message, ?array $data = null): SystemLog
    {
        return self::log(self::INFO, $segment, $message, $data);
    }

    /**
     * Mencatat log audit success
     */
    public static function auditSuccess(string $segment, string $message, ?array $data = null): SystemLog
    {
        return self::log(self::AUDIT_SUCCESS, $segment, $message, $data);
    }

    /**
     * Mencatat log audit failure
     */
    public static function auditFailure(string $segment, string $message, ?array $data = null): SystemLog
    {
        return self::log(self::AUDIT_FAILURE, $segment, $message, $data);
    }

    /**
     * Helper untuk log transaksi
     */
    public static function transaction(string $type, string $message, ?array $data = null): SystemLog
    {
        return self::log($type, self::SEGMENT_TRANSACTION, $message, $data);
    }

    /**
     * Helper untuk log user
     */
    public static function user(string $type, string $message, ?array $data = null): SystemLog
    {
        return self::log($type, self::SEGMENT_USER, $message, $data);
    }

    /**
     * Helper untuk log API
     */
    public static function api(string $type, string $message, ?array $data = null): SystemLog
    {
        return self::log($type, self::SEGMENT_API, $message, $data);
    }

    /**
     * Helper untuk log view
     */
    public static function view(string $type, string $message, ?array $data = null): SystemLog
    {
        return self::log($type, self::SEGMENT_VIEW, $message, $data);
    }

    /**
     * Helper untuk log system
     */
    public static function system(string $type, string $message, ?array $data = null): SystemLog
    {
        return self::log($type, self::SEGMENT_SYSTEM, $message, $data);
    }
} 
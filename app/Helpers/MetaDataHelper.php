<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MetaDataHelper
{
    /**
     * Mendapatkan semua metadata dari database atau cache
     *
     * @return \Illuminate\Support\Collection
     */
    public static function all()
    {
        return Cache::remember('meta_data', 60 * 24, function () {
            return DB::table('meta_data')->get()->keyBy('key');
        });
    }

    /**
     * Mendapatkan nilai metadata berdasarkan key
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function get($key, $default = '')
    {
        $metaData = self::all();
        return $metaData->has($key) ? $metaData->get($key)->value : $default;
    }

    /**
     * Menghasilkan HTML metadata untuk <head>
     *
     * @param array $customMeta
     * @return string
     */
    public static function generate($customMeta = [])
    {
        $html = '';

        // Title tag
        $title = $customMeta['title'] ?? self::get('title');
        $html .= "<title>{$title}</title>\n";

        // Meta description
        $description = $customMeta['description'] ?? self::get('description');
        if (!empty($description)) {
            $html .= "<meta name=\"description\" content=\"{$description}\">\n";
        }

        // Meta keywords
        $keywords = $customMeta['keywords'] ?? self::get('keywords');
        if (!empty($keywords)) {
            $html .= "<meta name=\"keywords\" content=\"{$keywords}\">\n";
        }

        // Meta charset
        $charset = $customMeta['charset'] ?? self::get('charset', 'UTF-8');
        $html .= "<meta charset=\"{$charset}\">\n";

        // Meta author
        $author = $customMeta['author'] ?? self::get('author');
        if (!empty($author)) {
            $html .= "<meta name=\"author\" content=\"{$author}\">\n";
        }

        // Meta viewport
        $viewport = $customMeta['viewport'] ?? self::get('viewport', 'width=device-width, initial-scale=1.0');
        $html .= "<meta name=\"viewport\" content=\"{$viewport}\">\n";

        // Meta robots
        $robots = $customMeta['robots'] ?? self::get('robots');
        if (!empty($robots)) {
            $html .= "<meta name=\"robots\" content=\"{$robots}\">\n";
        }

        // Open Graph meta (untuk sharing di sosial media)
        if (isset($customMeta['og:title']) || isset($title)) {
            $ogTitle = $customMeta['og:title'] ?? $title;
            $html .= "<meta property=\"og:title\" content=\"{$ogTitle}\">\n";
        }

        if (isset($customMeta['og:description']) || isset($description)) {
            $ogDescription = $customMeta['og:description'] ?? $description;
            $html .= "<meta property=\"og:description\" content=\"{$ogDescription}\">\n";
        }

        if (isset($customMeta['og:image'])) {
            $html .= "<meta property=\"og:image\" content=\"{$customMeta['og:image']}\">\n";
        }

        if (isset($customMeta['og:url'])) {
            $html .= "<meta property=\"og:url\" content=\"{$customMeta['og:url']}\">\n";
        }

        // Twitter Card meta
        if (isset($customMeta['twitter:card'])) {
            $html .= "<meta name=\"twitter:card\" content=\"{$customMeta['twitter:card']}\">\n";
        }

        return $html;
    }

    /**
     * Memperbarui cache metadata
     *
     * @return void
     */
    public static function refreshCache()
    {
        Cache::forget('meta_data');
        self::all();
    }
} 
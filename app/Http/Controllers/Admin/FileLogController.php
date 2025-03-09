<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class FileLogController extends Controller
{
    protected $perPage = 10;

    /**
     * Import logs from laravel.log file
     */
    private function importLogs()
    {
        Artisan::call('logs:import');
    }

    /**
     * Menampilkan halaman file log
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Import logs jika diperlukan
        $this->importLogs();
        
        $selectedDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();
        
        // Pengurutan default
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        // Query logs dari database
        $query = FileLog::whereDate('created_at', $selectedDate);

        // Filter berdasarkan tipe
        if ($request->has('filter_type') && !empty($request->filter_type)) {
            $query->where('type', $request->filter_type);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        // Pengurutan
        $query->orderBy($sort, $direction);

        // File logs dengan paginasi
        $logs = $query->paginate($this->perPage)->withQueryString();

        // Ambil tanggal-tanggal yang memiliki log
        $logDates = FileLog::select(DB::raw('DATE(created_at) as date'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        // Set view_name untuk breadcrumbs
        $route_name = 'admin.log-file.index';

        return view('admin.logs.index-filelog', compact('logs', 'selectedDate', 'route_name', 'logDates'));
    }

    /**
     * Menampilkan detail file log
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $log = FileLog::findOrFail($id);
        
        // Set view_name untuk breadcrumbs
        $route_name = 'admin.log-file.show';
        
        return view('admin.logs.show-filelog', compact('log', 'route_name'));
    }
} 
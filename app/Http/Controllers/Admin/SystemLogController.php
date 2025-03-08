<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemLogController extends Controller
{
    protected $perPage = 10;

    /**
     * Menampilkan halaman log sistem
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $selectedDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();
        $logType = $request->get('log_type', 'database');
        
        // Pengurutan default
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        // Daftar kolom yang diizinkan untuk diurutkan
        $allowedSortColumns = [
            'created_at',
            'type',
            'segment',
            'message',
            'user_id'
        ];
        
        // Validasi kolom pengurutan
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'created_at';
        }

        // Query logs dari database
        $dbLogs = SystemLog::whereDate('created_at', $selectedDate)
            ->when($sort === 'user_id', function ($query) use ($direction) {
                return $query->leftJoin('users', 'system_logs.user_id', '=', 'users.id')
                           ->orderBy('users.name', $direction)
                           ->select('system_logs.*');
            })
            ->when($sort !== 'user_id', function ($query) use ($sort, $direction) {
                return $query->orderBy($sort, $direction);
            });

        // Jika memilih File Log
        if ($logType === 'file') {
            // Baca log dari file laravel.log
            $logPath = storage_path('logs/laravel.log');
            $fileLogs = [];
            
            if (File::exists($logPath)) {
                $contents = File::get($logPath);
                $pattern = '/\[(?<date>.*)\] (?<env>\w+)\.(?<type>\w+): (?<message>.*)/';
                
                preg_match_all($pattern, $contents, $matches, PREG_SET_ORDER);
                
                foreach ($matches as $match) {
                    $logDate = Carbon::parse($match['date']);
                    
                    // Filter berdasarkan tanggal yang dipilih
                    if ($logDate->format('Y-m-d') === $selectedDate->format('Y-m-d')) {
                        $fileLogs[] = (object)[
                            'id' => 'file-' . md5($match[0]),
                            'created_at' => $logDate,
                            'type' => strtolower($match['type']),
                            'segment' => 'system',
                            'message' => $match['message'],
                            'user_id' => null,
                            'is_file_log' => true
                        ];
                    }
                }
                
                // Urutkan koleksi file logs
                $collection = collect($fileLogs);
                if ($direction === 'desc') {
                    $collection = $collection->sortByDesc($sort);
                } else {
                    $collection = $collection->sortBy($sort);
                }
                
                // Buat paginasi manual
                $page = $request->get('page', 1);
                $perPage = $this->perPage;
                $items = $collection->forPage($page, $perPage);
                
                $logs = new LengthAwarePaginator(
                    $items,
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $logs = new LengthAwarePaginator(
                    [],
                    0,
                    $this->perPage,
                    1,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }

            // Ambil tanggal-tanggal yang memiliki log file
            $logDates = [];
            if (File::exists($logPath)) {
                $contents = File::get($logPath);
                preg_match_all('/\[(\d{4}-\d{2}-\d{2})/', $contents, $dates);
                $logDates = array_unique($dates[1]);
                sort($logDates);
            }

            // Set view_name untuk breadcrumbs
            $route_name = 'admin.logs.index';

            return view('admin.logs.index-filelog', compact('logs', 'logDates', 'selectedDate', 'logType', 'route_name'));
        } else {
            // Database logs dengan paginasi
            $logs = $dbLogs->paginate($this->perPage);

            // Hitung jumlah log berdasarkan tipe
            $logCounts = SystemLog::whereDate('created_at', $selectedDate)
                ->selectRaw('type, count(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray();

            // Ambil tanggal-tanggal yang memiliki log
            $logDates = SystemLog::selectRaw('DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->pluck('date')
                ->toArray();

            // Set view_name untuk breadcrumbs
            $route_name = 'admin.logs.index';

            return view('admin.logs.index-databaselog', compact('logs', 'logCounts', 'logDates', 'selectedDate', 'logType', 'route_name'));
        }
    }
    
    /**
     * Menampilkan detail log
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $type = request('type', 'database');
        
        if ($type === 'file') {
            // Baca log dari file laravel.log
            $logPath = storage_path('logs/laravel.log');
            $log = null;
            
            if (File::exists($logPath)) {
                $contents = File::get($logPath);
                $pattern = '/\[(?<date>.*)\] (?<env>\w+)\.(?<type>\w+): (?<message>.*)/';
                
                preg_match_all($pattern, $contents, $matches, PREG_SET_ORDER);
                
                foreach ($matches as $match) {
                    if ('file-' . md5($match[0]) === $id) {
                        $log = (object)[
                            'id' => $id,
                            'created_at' => Carbon::parse($match['date']),
                            'type' => strtolower($match['type']),
                            'segment' => 'system',
                            'message' => $match['message'],
                            'user_id' => null,
                            'is_file_log' => true
                        ];
                        break;
                    }
                }
            }
            
            if (!$log) {
                abort(404);
            }
            
            // Set view_name untuk breadcrumbs
            $route_name = 'admin.logs.show';
            
            return view('admin.logs.show-filelog', compact('log', 'route_name'));
        } else {
            $log = SystemLog::with('user')->findOrFail($id);
            
            // Set view_name untuk breadcrumbs
            $route_name = 'admin.logs.show';
            
            return view('admin.logs.show-databaselog', compact('log', 'route_name'));
        }
    }
    
    /**
     * Menghapus log
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $log = SystemLog::findOrFail($id);
        $log->delete();
        
        return redirect()->route('admin.logs.index')
            ->with('success', 'Log berhasil dihapus');
    }
    
    /**
     * Menghapus semua log pada tanggal tertentu
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearByDate(Request $request)
    {
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($date);
        
        SystemLog::whereDate('created_at', $selectedDate)->delete();
        
        return redirect()->route('admin.logs.index')
            ->with('success', 'Semua log pada tanggal ' . $selectedDate->format('d M Y') . ' berhasil dihapus');
    }
}

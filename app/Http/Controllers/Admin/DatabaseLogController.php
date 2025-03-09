<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatabaseLogController extends Controller
{
    protected $perPage = 10;

    /**
     * Menampilkan halaman database log
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $selectedDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();
        
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
        $query = SystemLog::whereDate('created_at', $selectedDate);

        // Filter berdasarkan tipe
        if ($request->has('filter_type') && !empty($request->filter_type)) {
            $query->where('type', $request->filter_type);
        }

        // Filter berdasarkan segmen
        if ($request->has('filter_segment') && !empty($request->filter_segment)) {
            $query->where('segment', $request->filter_segment);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        // Pengurutan
        if ($sort === 'user_id') {
            $query->leftJoin('users', 'system_logs.user_id', '=', 'users.id')
                   ->orderBy('users.name', $direction)
                   ->select('system_logs.*');
        } else {
            $query->orderBy($sort, $direction);
        }

        // Database logs dengan paginasi
        $logs = $query->paginate($this->perPage)->withQueryString();

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
        $route_name = 'admin.log-database.index';

        return view('admin.logs.index-databaselog', compact('logs', 'logCounts', 'logDates', 'selectedDate', 'route_name'));
    }

    /**
     * Menampilkan detail log
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $log = SystemLog::with('user')->findOrFail($id);
        
        // Set view_name untuk breadcrumbs
        $route_name = 'admin.log-database.show';
        
        return view('admin.logs.show-databaselog', compact('log', 'route_name'));
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
        
        return redirect()->route('admin.log-database.index')
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
        
        return redirect()->route('admin.log-database.index')
            ->with('success', 'Semua log pada tanggal ' . $selectedDate->format('d M Y') . ' berhasil dihapus');
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemLogController extends Controller
{
    /**
     * Menampilkan halaman log sistem
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

        // Query logs dengan pengurutan
        $logs = SystemLog::whereDate('created_at', $selectedDate)
            ->when($sort === 'user_id', function ($query) use ($direction) {
                return $query->leftJoin('users', 'system_logs.user_id', '=', 'users.id')
                           ->orderBy('users.name', $direction)
                           ->select('system_logs.*');
            })
            ->when($sort !== 'user_id', function ($query) use ($sort, $direction) {
                return $query->orderBy($sort, $direction);
            })
            ->paginate(10)
            ->withQueryString();

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

        return view('admin.logs.index', compact('logs', 'logCounts', 'logDates', 'selectedDate'));
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
        
        return view('admin.logs.show', [
            'log' => $log,
        ]);
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

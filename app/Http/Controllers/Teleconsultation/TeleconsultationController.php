<?php

namespace App\Http\Controllers\Teleconsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TeleconsultationController extends Controller
{
    //
    public function index()
    {

        return Inertia::render('teleconsultation/revenue');
    }


    public function loadTcOrderRevenue(Request $request)
    {
        $doctor = Auth::user()->userable;

        // Ambil query params (opsional)
        $month = $request->query('month');
        $year = $request->query('year');
        $perPage = $request->query('per_page', 10);

        // Query relasi langsung dengan kondisi & pagination
        $tc_orders = $doctor->tc_orders()
            ->where('status', 'completed')
            ->when($month, fn($q) => $q->whereMonth('completed_at', $month))
            ->when($year, fn($q) => $q->whereYear('completed_at', $year))
            ->orderByDesc('updated_at')
            ->paginate($perPage);

        // Return dalam bentuk JSON agar bisa dipakai di axios React
        return response()->json($tc_orders);
    }

}

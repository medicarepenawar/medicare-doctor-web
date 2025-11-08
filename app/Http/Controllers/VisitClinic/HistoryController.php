<?php

namespace App\Http\Controllers\VisitClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HistoryController extends Controller
{
    //

    public function index()
    {


        return Inertia::render('visit-clinic/history');
    }

    public function loadVcOrderHistory(Request $request)
    {
        $doctor = Auth::user()->userable;

        // Ambil query params
        $page = $request->query('page', 1); // default 1
        $status = $request->query('status'); // opsional
        $perPage = $request->query('per_page', 10);

        // Query dasar
        $query = $doctor->vc_orders()->latest();

        // Jika ada filter status
        if ($status) {
            $query->where('status', $status);
        }

        // Pagination
        $vc_orders = $query->paginate($perPage, ['*'], 'page', $page);

        // Kalau mau JSON untuk axios frontend
        return response()->json($vc_orders);
    }
}

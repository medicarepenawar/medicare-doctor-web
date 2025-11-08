<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Utils\CloudStorageUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data dokter (bisa disesuaikan pakai pagination)
        $doctors = Auth::user()->userable;
        // dd($doctors);
        // Kirim ke komponen Inertia
        return Inertia::render('home/dashboard', [
            'doctors' => $doctors
        ]);
    }

    public function testing()
    {
        $userable = auth()->user()->userable;
        $doctor = $userable->load([
            'vc_doctor_details' => function ($query) {
                $query->where('on_duty', 1)->with('vendors_visit_clinic');
                ;

            },
            'tc_doctor_details' => function ($query) {
                $query->where('on_duty', 1);
            },
        ]);

        $profile_image = CloudStorageUtils::getFilePath($doctor->photo);

        return response()->json([
            'doctor' => $doctor,
            'profile_image' => $profile_image,
            'vc' => $doctor->vc_doctor_details,
            'tc' => $doctor->tc_doctor_details,
        ]);
    }

    public function doctorInfoOrder()
    {

        $userable = auth()->user()->userable;

        $order = $userable->load([
            'tc_orders' => function ($query) {
                $query->with([
                    'order' => function ($query) {
                        $query->withSum([
                            'transactions as total_amount' => function ($q) {
                                $q->where('status_payment', 'paid');
                            }
                        ], 'total_amount');
                    },
                ]);
                ;

            },
            'vc_orders' => function ($query) {
                $query->with([
                    'order' => function ($query) {
                        $query->with('transactions');
                    }
                ]);
                ;

            }
        ]);



        return response()->json($order);
    }
}

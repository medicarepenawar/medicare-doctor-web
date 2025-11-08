<?php

namespace App\Http\Controllers\VisitClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    //

    public function index()
    {
        $doctor = Auth::user()->userable;

        $vcShift = $doctor->load([
            'vc_doctor_details' => function ($query) {
                $query->with(['vendors_visit_clinic']);
            }

        ])->vc_doctor_details;


        // dd($vcShift);

        return Inertia::render('visit-clinic/schedule', [
            'vcShift' => $vcShift
        ]);
    }

}

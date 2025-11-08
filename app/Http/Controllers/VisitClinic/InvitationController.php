<?php

namespace App\Http\Controllers\VisitClinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InvitationController extends Controller
{
    //

    public function index()
    {
        $doctor = Auth::user()->userable;
        $invitation = $doctor->load([
            'vc_doctor_details' => function ($query) {
                $query->with('vendors_visit_clinic')->where('doctor_accept', false);
            }
        ]);
        return Inertia::render('visit-clinic/invitation', [
            'invitation' => $invitation
        ]);
    }


}

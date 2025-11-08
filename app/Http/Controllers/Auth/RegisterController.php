<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\TemplateDoctor;
use App\Models\User;
use App\Utils\CloudStorageUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RegisterController extends Controller
{
    //

    public function index()
    {
        // $doctors = TemplateDoctor::all();
        return Inertia::render('auth/register');
    }

    public function fromTemplate($doctorId)
    {
        // Cari doctor berdasarkan ID
        $doctor = TemplateDoctor::find($doctorId);

        if (!$doctor) {
            return redirect()->route('doctor.register')
                ->with('error', 'Doctor not found');
        }

        // Render halaman register dan kirim props doctor
        return Inertia::render('auth/register', [
            'doctor' => $doctor
        ]);
    }

    public function showOptions()
    {
        return Inertia::render('auth/registerOptions');
    }

    public function searchDoctorTemplate(Request $request)
    {
        // ✅ Validasi input
        // $request->validate([
        //     'nric' => ['required', 'string', 'max:50'],
        // ]);

        // ✅ Cari doctor berdasarkan NRIC
        $doctor = TemplateDoctor::where('nric', $request->query('nric'))->first();

        // ❌ Kalau tidak ditemukan
        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        // ✅ Kembalikan data doctor untuk frontend
        return response()->json([
            'success' => true,
            'doctor' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'nric' => $doctor->nric,

                // tambah field lain sesuai kebutuhan
            ],
        ]);
    }



    public function store(Request $request)
    {
        // ✅ DATABASE TRANSACTION
        DB::beginTransaction();

        try {
            // ✅ VALIDATION
            $validated = $request->validate([
                // STEP 1 — General Information
                'name' => ['required', 'string', 'max:255'],
                'nric' => ['required', 'string', 'max:50', 'unique:doctors,nric'],
                'gender' => ['required', Rule::in(['male', 'female'])],
                'phone_number' => ['required', 'string', 'max:20'],
                'passport_number' => ['nullable', 'string', 'max:50'],

                // STEP 1 — Medical Information
                'specialist' => ['required', 'string', 'max:255'],
                'experience' => ['required', 'string'],
                'medical_degree_university' => ['required', 'string', 'max:255'],
                'mmc_number' => ['required', 'string', 'max:100'],
                'apc_number' => ['required', 'string', 'max:100'],
                'apc_expired' => ['required', 'date'],

                // STEP 1 — File Upload
                'photo' => ['nullable', 'file', 'image', 'max:2048'],
                'front_nric_photo' => ['nullable', 'file', 'image', 'max:2048'],
                'back_nric_photo' => ['nullable', 'file', 'image', 'max:2048'],
                'apc_certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,png,jpeg', 'max:4096'],
                'mmc_certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,png,jpeg', 'max:4096'],

                // STEP 2 — Account
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6'],
                'password_confirmation' => ['required', 'same:password'],
            ]);


            $photo = CloudStorageUtils::uploadFile($validated['photo'], 'doctors/profile-images');
            $front_nric_photo = CloudStorageUtils::uploadFile($validated['front_nric_photo'], 'doctors/nric-images');
            $back_nric_photo = CloudStorageUtils::uploadFile($validated['back_nric_photo'], 'doctors/nric-images');
            $apc_certificate_file = CloudStorageUtils::uploadFile($validated['apc_certificate_file'], 'doctor/certificate-files');
            $mmc_certificate_file = CloudStorageUtils::uploadFile($validated['mmc_certificate_file'], 'doctor/certificate-files');



            // dd($photo, $front_nric_photo, $back_nric_photo, $apc_certificate_file, $mmc_certificate_file);


            // // ✅ HANDLE FILE UPLOADS
            // $paths = [];

            // foreach ([
            //     'photo',
            //     'front_nric_photo',
            //     'back_nric_photo',
            //     'apc_certificate_file',
            //     'mmc_certificate_file'
            // ] as $field) {

            //     if ($request->hasFile($field)) {
            //         $paths[$field] = $request->file($field)->store("doctor/$field", 'public');
            //     } else {
            //         $paths[$field] = null;
            //     }
            // }

            // ✅ CREATE DOCTOR RECORD
            $doctor = Doctor::create([
                'name' => $validated['name'],
                'nric' => $validated['nric'],
                'gender' => $validated['gender'],
                'phone_number' => $validated['phone_number'],
                'passport_number' => $validated['passport_number'] ?? null,

                'specialist' => $validated['specialist'],
                'experience' => $validated['experience'],
                'medical_degree_university' => $validated['medical_degree_university'],
                'mmc_number' => $validated['mmc_number'],
                'apc_number' => $validated['apc_number'],
                'apc_expired' => $validated['apc_expired'],

                'photo' => $photo,
                'front_nric_photo' => $front_nric_photo,
                'back_nric_photo' => $back_nric_photo,
                'apc_certificate_file' => $apc_certificate_file,
                'mmc_certificate_file' => $mmc_certificate_file,
            ]);

            // ✅ CREATE USER ACCOUNT
            $user = User::create([
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'userable_type' => 'Modules\Auth\Models\Doctor',
                'userable_id' => $doctor->id,
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Doctor registered successfully!');

        } catch (\Throwable $e) {

            DB::rollBack();

            // ✅ LOG ERROR
            Log::error('Doctor registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->
                route('doctor.register')
                ->with('error', 'Something went wrong while registering the doctor.');
        }
    }


}

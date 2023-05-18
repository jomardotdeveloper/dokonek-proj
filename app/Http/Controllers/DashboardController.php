<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Special;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->user_type == "doctor"){
            return view('dashboard', [
                'appointments' => Appointment::where('approval_status', 'approved')->where('doctor_id', auth()->user()->id)->where('date', '>=', date('Y-m-d'))->get(),
                'appointment_requests' => Appointment::where('approval_status', 'pending')->where('doctor_id', auth()->user()->id)->get(),
            ]);
        }
        return view('dashboard', [
            'appointments' => Appointment::where('approval_status', 'pending')->count(),
            'patients' => Patient::count(),
            'doctors' => Doctor::count(),
            'specials' => Special::all(),
            'all' => Appointment::all(),
        ]);
    }
}

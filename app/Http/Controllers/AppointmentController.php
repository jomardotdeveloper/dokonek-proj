<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Special;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();

        if (auth()->user()->user_type == 'doctor') {
            $appointments = Appointment::where('doctor_id', auth()->user()->id)->get();
        } elseif (auth()->user()->user_type == 'patient') {
            $appointments = Appointment::where('patient_id', auth()->user()->id)->get();
        }
        
        return view('appointments.index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(User::with('patient')->get()[0]->doctor);

        $doctors = User::has('doctor')->get();

        if(isset($_GET['doctor_id']))
            $doctors = [Doctor::where('id', $_GET['doctor_id'])->get()[0]->user];

        return view('appointments.create', [
            'specials' => Special::all(),
            'patients' => User::has('patient')->get(),
            'doctors' => $doctors,
            'approval_status' => Appointment::APPROVAL_STATUS,
            'status' => Appointment::STATUS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Appointment::create($request->all());

        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'specials' => Special::all(),
            'patients' => User::has('patient')->get(),
            'doctors' => User::has('doctor')->get(),
            'approval_status' => Appointment::APPROVAL_STATUS,
            'status' => Appointment::STATUS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        
        $appointment->update($request->all());

        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        
        $appointment->delete();
        return redirect()->route('appointments.index');
    }

    public function approve (Appointment $appointment)
    {
        $appointment->update([
            'approval_status' => 'approved',
        ]);
        return redirect()->back();
    }

    public function reject (Appointment $appointment)
    {
        $appointment->update([
            'approval_status' => 'rejected',
        ]);
        return redirect()->back();
    }

    // public function cancel (Appointment $appointment)
    // {
    //     $appointment->update([
    //         'status' => 'cancelled',
    //     ]);
    //     return redirect()->route('appointments.index');
    // }

    public function finish (Appointment $appointment)
    {
        $appointment->update([
            'status' => 'done',
        ]);
        return redirect()->back();
    }

    public function ongoing (Appointment $appointment)
    {
        $appointment->update([
            'status' => 'ongoing',
        ]);
        return redirect()->back();
    }

    public function pending (Appointment $appointment)
    {
        $appointment->update([
            'status' => 'pending',
        ]);
        return redirect()->back();
    }
}

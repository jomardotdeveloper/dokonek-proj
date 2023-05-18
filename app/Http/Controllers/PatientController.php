<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patients.index', [
            'patients' => Patient::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $values = $request->all();

        $path = Storage::putFile("public/profiles" , $request->file("image_src"));
        $path = Storage::url($path);
        $values['image_src'] =  $path;

        $user = User::create([
            'name' => $values['first_name'] . ' ' . $values['last_name'],
            'email' => $values['email'],
            'password' => Hash::make($request->password),
        ]);
        

        $values['user_id'] = $user->id;

        Patient::create($values);

        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $patient->user_id,
        ]);

        $values = $request->all();

        if($request->hasFile("image_src")) {
            $path = Storage::putFile("public/profiles" , $request->file("image_src"));
            $path = Storage::url($path);
            $values['image_src'] =  $path;
        }

        $user = User::find($patient->user_id);

        $user->update([
            'name' => $values['first_name'] . ' ' . $values['last_name'],
            'email' => $values['email'],
        ]);

        if($request->password != "HAHAHA")
            $user->update([
                'password' => Hash::make($request->password),
            ]);


        $patient->update($values);

        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $user = User::find($patient->user_id);
        $patient->delete();
        $user->delete();
        return redirect()->route('patients.index');
    }
}

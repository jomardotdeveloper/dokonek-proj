<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Special;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctors.index', [
            'doctors' => Doctor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create',[
            'specials' => Special::all(),
            'checklists' => Doctor::SCHEDULE_CHECKLISTS,
        ]);
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

        if(array_key_exists("schedule_checklists" , $values))
            $values["schedule_checklists"] = implode(",", $values["schedule_checklists"]);

        Doctor::create($values);

        return redirect()->route('doctors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor' => $doctor,
            'specials' => Special::all(),
            'checklists' => Doctor::SCHEDULE_CHECKLISTS,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor' => $doctor,
            'specials' => Special::all(),
            'checklists' => Doctor::SCHEDULE_CHECKLISTS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
        ]);

        $values = $request->all();

        if($request->hasFile("image_src")) {
            $path = Storage::putFile("public/profiles" , $request->file("image_src"));
            $path = Storage::url($path);
            $values['image_src'] =  $path;
        }

        $user = User::find($doctor->user_id);

        $user->update([
            'name' => $values['first_name'] . ' ' . $values['last_name'],
            'email' => $values['email'],
        ]);

        if($request->password != "HAHAHA")
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        
        
        if(array_key_exists("schedule_checklists" , $values))
            $values["schedule_checklists"] = implode(",", $values["schedule_checklists"]);
        else 
            $values["schedule_checklists"] = null;

        $doctor->update($values);

        return redirect()->route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $user = User::find($doctor->user_id);
        // $user->delete();
        $doctor->delete();

        $user->delete();

        return redirect()->route('doctors.index');
    }
}

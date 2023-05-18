@extends("layouts.master")

@section('content')
<div class="col-12">
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-fill alert-icon alert-dismissible alert-danger " role="alert">
            <strong>{{ $error }}</strong>
            
        </div>
        @endforeach
    @endif
    
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Appointment</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('appointments.update', ['appointment' => $appointment]) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <div class="form-group">
                        <label>Session Date</label>
                        <input type="date" class="form-control" placeholder="Session Date" name="date" required value="{{ $appointment->date }}"/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Approval Status</label>
                        <select class="form-control" name="approval_status" required>
                           
                            @foreach ($approval_status as $key => $value)
                                <option value="{{ $key }}" {{ $appointment->approval_status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                           
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}" {{ $appointment->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Patient</label>
                        <select class="form-control" name="patient_id" required>
                           
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id" required>
                           
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->doctor->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="col-6">
                    <div class="form-group">
                        <label>Specialization</label>
                        <select class="form-control" name="special_id" required>
                           
                            @foreach ($specials as $special)
                                <option value="{{ $special->id }}" {{ $appointment->special_id == $special->id ? 'selected' : '' }}>{{ $special->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
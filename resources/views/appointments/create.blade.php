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
            <h4 class="card-title">New Appointment</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('appointments.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <div class="form-group">
                        <label>Session Date</label>
                        <input type="date" class="form-control" placeholder="Session Date" name="date" required/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Patient</label>
                        <select class="form-control" name="patient_id" required>
                           
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id" required>
                           
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->doctor->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="col-6">
                    <div class="form-group">
                        <label>Specialization</label>
                        <select class="form-control" name="special_id" required>
                           
                            @foreach ($specials as $special)
                                <option value="{{ $special->id }}">{{ $special->name }}</option>
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
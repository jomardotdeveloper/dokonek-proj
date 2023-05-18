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
            <h4 class="card-title">View Doctor</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('doctors.update', ['doctor' => $doctor]) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $doctor->first_name }}" required disabled/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $doctor->last_name }}" required disabled/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="{{ $doctor->middle_name }}" disabled/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" placeholder="Birthdate" name="birthday" required value="{{ $doctor->birthday }}" disabled/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Contact #</label>
                        <input type="text" class="form-control" placeholder="Contact #" name="contact_number" value="{{ $doctor->contact_number }}" disabled/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Consultation Fee</label>
                        <input type="number" class="form-control" placeholder="Fee" name="consultation_fee" required value="{{ $doctor->consultation_fee }}" disabled/>
                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label>Specialization</label>
                        <select class="form-control" name="special_id" required disabled>
                           
                            @foreach ($specials as $special)
                                <option value="{{ $special->id }}" {{ $doctor->special_id == $special->id ? 'selected' : '' }}>{{ $special->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <label>SCHEDULES</label>
                    @foreach ($checklists as $key => $val)
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $key }}" name="schedule_checklists[]"  {{ in_array(strval($key), $doctor->schedule_checklists_arr) ? 'checked' : '' }} disabled>
                            <label class="form-check-label">
                                {{ $val }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
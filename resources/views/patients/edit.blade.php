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
            <h4 class="card-title">Edit Patient</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('patients.update', ['patient' => $patient]) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $patient->first_name }}" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $patient->last_name }}" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="{{ $patient->middle_name }}"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" placeholder="Birthdate" name="birthday" required value="{{ $patient->birthday }}"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Contact #</label>
                        <input type="text" class="form-control" placeholder="Contact #" name="contact_number" value="{{ $patient->contact_number }}"/>
                    </div>
                </div>
        

                <div class="col-6">
                    <div class="form-group">
                        <label>Update Image</label>
                        <input type="file" class="form-control" name="image_src" />
                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{ $patient->user->email }}" name="email" required/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" value="HAHAHA" placeholder="Password" name="password" required/>
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
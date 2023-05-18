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
            <h4 class="card-title">New Patient</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('patients.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" placeholder="Birthdate" name="birthday" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Contact #</label>
                        <input type="text" class="form-control" placeholder="Contact #" name="contact_number"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image_src" required/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required/>
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
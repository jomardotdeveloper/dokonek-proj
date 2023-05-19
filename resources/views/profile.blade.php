@extends("layouts.master")

@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'doctor')
<div class="col-12">
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-fill alert-icon alert-dismissible alert-danger " role="alert">
            <strong>{{ $error }}</strong>
            
        </div>
        @endforeach
    @endif
    @if (Session::has('success'))
        <div class="alert alert-fill alert-icon alert-dismissible alert-success " role="alert">
            <strong>{{ Session::get('success') }}</strong>
            
        </div>
        
    @endif
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Profile</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="old_password" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_confirmation" required/>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
        </div>
    </div> 
</div>    


@endif
@endsection
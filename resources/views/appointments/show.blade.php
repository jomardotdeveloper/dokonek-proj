@extends("layouts.master")

@section('content')
@if (!isset($_GET['is_continue']))
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Doctor Details</h4>
            </div>
            <div class="card-body">
                <img src="{{ $appointment->doctor->doctor->image_src }}" style="width: 70px; height:70px;" alt="">
                <h3>Dr. {{ $appointment->doctor->doctor->full_name }} </h3>
                <h4 class="lead">{{ $appointment->doctor->doctor->special->name }}</h4>
                <h3>Appointment Fees</h3>
                <hr>
                <h4 class="lead">Total : {{ $appointment->doctor->doctor->consultation_fee }}</h4>
                <a href="{{ route('appointments.show', $appointment) }}?is_continue=1" class="btn btn-primary">Continue</a>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Patient Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $appointment->patient->patient->first_name }}" required disabled/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $appointment->patient->patient->last_name }}" required disabled/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="{{ $appointment->patient->patient->middle_name }}" disabled/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" class="form-control" placeholder="Birthdate" name="birthday" required value="{{ $appointment->patient->patient->birthday }}" disabled/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Contact #</label>
                            <input type="text" class="form-control" placeholder="Contact #" name="contact_number" value="{{ $appointment->patient->patient->contact_number }}" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
{{-- <div class="container"> --}}
    @if ($_GET['is_continue'] == 1)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Options</h4>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('images/paymaya.png') }}" alt="" class="img-fluid img-thumbnail">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/gcash.png') }}" alt="" class="img-fluid img-thumbnail">
                        </div>
                    </div>
                    <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_paid" value="1"/>
                        <button type="submit" class="btn btn-primary mt-5">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    
{{-- </div> --}}

@endif


@endsection
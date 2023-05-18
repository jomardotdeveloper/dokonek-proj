@extends("layouts.master")

@section('content')

@if (auth()->user()->user_type == 'admin')
<div class="row">
    <div class="col-xl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-heart"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Patient</p>
                        <h3 class="text-white">{{ $patients }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Doctors</p>
                        <h3 class="text-white">{{ $doctors }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-notepad"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total New Appointments</p>
                        <h3 class="text-white">{{ $appointments }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($specials as $special)
    <div class="col-xl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-warning">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-notepad"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">{{ $special->name }}</p>
                        @php($count = 0)
                        @foreach ($all as $p)
                            @if($p->special_id == $special->id)
                                @php($count++)
                            @endif
                        @endforeach
                        <h3 class="text-white">{{ $count }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@elseif(auth()->user()->user_type == 'doctor')
<div class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Today's Appointments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table patient-activity">
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img class="mr-3 img-fluid rounded" width="78" src="{{ $appointment->patient->patient->image_src }}" alt="DexignZone">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">Patient</h5>
                                        <p class="mb-0">{{ $appointment->patient->patient->full_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0">Specialization</p>
                                <h5 class="my-0 text-primary">{{ $appointment->special->name }}</h5>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-1">Status</p>
                                        @if ($appointment->status == 'pending')
                                        <h5 class="mt-0 mb-1 text-secondary">Pending</h5>
                                        @elseif($appointment->status == 'done')
                                        <h5 class="mt-0 mb-1 text-success">Finished</h5>
                                        @elseif($appointment->status == 'ongoing')
                                        <h5 class="mt-0 mb-1 text-warning">Ongoing</h5>
                                        @endif
                                        
                                        <small>{{ $appointment->date }}</small>
                                    </div>
                                    <div class="dropdown ml-auto">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" >
                                            <a class="dropdown-item" href="{{ route('appointments.pending', $appointment) }}">Pending</a>
                                            <a class="dropdown-item" href="{{ route('appointments.finish',  $appointment) }}">Finished</a>
                                            <a class="dropdown-item" href="{{ route('appointments.ongoing',  $appointment) }}">Ongoing</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if (count($appointments) == 0)
                            <tr>
                                <td colspan="3" class="text-center">No Appointments</td>
                            </tr>
                            
                        @endif
                       
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Appointment Requests </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table patient-activity">
                        @foreach ($appointment_requests as $appointment)
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <img class="mr-3 img-fluid rounded" width="78" src="{{ $appointment->patient->patient->image_src }}" alt="DexignZone">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">Patient</h5>
                                        <p class="mb-0">{{ $appointment->patient->patient->full_name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0">Specialization</p>
                                <h5 class="my-0 text-primary">{{ $appointment->special->name }}</h5>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-1">Status</p>
                                        <h5 class="mt-0 mb-1 text-secondary">Pending</h5>
                                        
                                        <small>{{ $appointment->date }}</small>
                                    </div>
                                    <div class="dropdown ml-auto">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" >
                                            <a class="dropdown-item" href="{{ route('appointments.approve', $appointment) }}">Approve</a>
                                            <a class="dropdown-item" href="{{ route('appointments.reject',  $appointment) }}">Reject</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if (count($appointments) == 0)
                            <tr>
                                <td colspan="3" class="text-center">No Appointments</td>
                            </tr>
                            
                        @endif
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-xl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-heart"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Appointments</p>
                        <h3 class="text-white">{{ count($all) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
@extends("layouts.master")
@section('css')

@endsection
@section('content')

    

@if (auth()->user()->user_type == 'admin')
<div class="col-12">
    <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-2">Create</a>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Specialties</th>
                            <th>Date</th>
                            <th>Approval Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                           
                            <td>{{ $appointment->formatted_id }}</td>
                            <td>{{ $appointment->patient->patient->full_name }}</td>
                            <td>{{ $appointment->doctor->doctor->full_name }}</td>
                            <td>{{ $appointment->special->name }}</td>
                            <td>{{ $appointment->date  }}</td>
                            <td>{{ $appointment->approval_status }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <a href="{{ route('appointments.edit', ['appointment' => $appointment])  }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp" onclick="deletemoto('{{ $appointment->id }}')"><i class="fa fa-trash"></i></a>
                                </div>
                                <form action="{{ route('appointments.destroy', ['appointment' => $appointment]) }}" method="POST" id="{{ $appointment->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>												
                            </td>												
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@elseif(auth()->user()->user_type == 'doctor')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Specialties</th>
                            <th>Date</th>
                            <th>Approval Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                           
                            <td>{{ $appointment->formatted_id }}</td>
                            <td>{{ $appointment->patient->patient->full_name }}</td>
                            <td>{{ $appointment->doctor->doctor->full_name }}</td>
                            <td>{{ $appointment->special->name }}</td>
                            <td>{{ $appointment->date  }}</td>
                            <td>{{ $appointment->approval_status }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <a href="{{ route('appointments.approve', ['appointment' => $appointment])  }}" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-check"></i></a>
                                    <a href="{{ route('appointments.reject', ['appointment' => $appointment])  }}" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-close"></i></a>
                                </div>
									
                            </td>												
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Specialties</th>
                            <th>Date</th>
                            <th>Approval Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                           
                            <td>{{ $appointment->formatted_id }}</td>
                            <td>{{ $appointment->patient->patient->full_name }}</td>
                            <td>{{ $appointment->doctor->doctor->full_name }}</td>
                            <td>{{ $appointment->special->name }}</td>
                            <td>{{ $appointment->date  }}</td>
                            <td>{{ $appointment->approval_status }}</td>
                            <td>{{ $appointment->status }}</td>			
                            <td>
                                @if ($appointment->approval_status == 'approved')
                                    @if (!$appointment->is_paid)
                                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-primary">Pay Now</a> 
                                    @else
                                    Paid   
                                    @endif
                                @else
                                Pending........ 
                                @endif
                                
                            </td>							
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
@push('scripts')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

<script>
    function deletemoto(id) {
        document.getElementById(id).submit();
    }
</script>
@endpush
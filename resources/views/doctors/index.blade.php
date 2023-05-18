@extends("layouts.master")
@section('css')

@endsection
@section('content')
@if (auth()->user()->user_type == 'admin')
<div class="col-12">
    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-2">Create</a>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Doctors</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Specialties</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr>
                            <td><img class="rounded-circle" width="35" src="{{ $doctor->image_src }}" alt=""></td>
                            <td>{{ $doctor->formatted_id }}</td>
                            <td>{{ $doctor->full_name }}</td>
                            <td>{{ $doctor->user->email }}</td>
                            <td>{{ $doctor->special->name }}</td>
                            
                        
                            <td>
                                <div class="d-flex">
                                    {{-- <a href="{{ route('doctors.show', ['doctor' => $doctor])  }}" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a> --}}
                                    <a href="{{ route('doctors.edit', ['doctor' => $doctor])  }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp" onclick="deletemoto('{{ $doctor->id }}')"><i class="fa fa-trash"></i></a>
                                </div>
                                <form action="{{ route('doctors.destroy', ['doctor' => $doctor]) }}" method="POST" id="{{ $doctor->id }}">
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
@else
<div class="col-12">
    <div class="card">
        <div class="card-header border-0 pb-0">
            <h4 class="card-title">Doctor</h4>
        </div>
        <div class="card-body">
            <div class="widget-media best-doctor">
                <ul class="timeline">
                    @foreach ($doctors as $doctor)
                    <li>
                        <div class="timeline-panel">
                            <div class="media mr-4">
                                <img alt="image" width="90" src="{{ $doctor->image_src }}">
                            </div>
                            <div class="media-body">
                                <h4 class="mb-2">Dr. {{ $doctor->full_name }}</h4>
                                <p class="mb-2 text-primary"> {{ $doctor->special->name }}</p>
                            </div>
                            <div class="social-media">
                                <a href="{{ route('doctors.show', ['doctor' => $doctor]) }}" class="btn btn-outline-primary btn-rounded fa fa-user btn-sm"></a>
                                <a href="{{ route('appointments.create') }}?doctor_id={{ $doctor->id }}" class="btn btn-outline-primary btn-rounded fa fa-calendar btn-sm"></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    
                </ul>
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
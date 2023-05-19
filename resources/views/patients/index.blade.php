@extends("layouts.master")
@section('css')

@endsection
@section('content')
@if (auth()->user()->user_type == 'admin')
<div class="col-12">
    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-2">Create</a>
</div>
@endif
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Patients</h4>
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
                            <th>Contact #</th>
                            @if (auth()->user()->user_type == 'admin')
                            <th>Action</th>
                            @endif
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td><img class="rounded-circle" width="35" src="{{ $patient->image_src }}" alt=""></td>
                            <td>{{ $patient->formatted_id }}</td>
                            <td>{{ $patient->full_name }}</td>
                            <td>{{ $patient->user->email }}</td>
                            <td>{{ $patient->contact_number }}</td>
                            
                            @if (auth()->user()->user_type == 'admin')
                            <td>
                                <div class="d-flex">
                                    {{-- <a href="{{ route('doctors.show', ['doctor' => $doctor])  }}" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a> --}}
                                    <a href="{{ route('patients.edit', ['patient' => $patient])  }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp" onclick="deletemoto('{{ $patient->id }}')"><i class="fa fa-trash"></i></a>
                                </div>
                                <form action="{{ route('patients.destroy', ['patient' => $patient]) }}" method="POST" id="{{ $patient->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>												
                            </td>				
                            @endif								
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
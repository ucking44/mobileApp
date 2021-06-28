@extends('layouts.backend.app')

@section('title', 'Appointment')

@push('css')
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Appointment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Appointment</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--  <a href="{{ URL::to('/create/appointments') }}" class="btn btn-primary">Create Appointment</a>  --}}
                    @include('layouts.backend.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>All Appointments</b></h4>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                           
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class=" text-primary">
                                            <th>ID</th>
                                            <th class="text-center">Service Name</th>
                                            <th class="text-center">First Name</th>
                                            <th class="text-center">Last Name</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Service Duration</th>
                                            <th class="text-center">Service Fee</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Message</th>
                                            <th>Status</th>
                                            <th style="text-align: center;">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $key => $appointment)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td >{{ $appointment->service_name }}</td>
                                                    <td>{{ $appointment->firstName }}</td>
                                                    <td>{{ $appointment->lastName }}</td>
                                                    <td>{{ $appointment->date }}</td>
                                                    <td>{{ $appointment->duration }}</td>
                                                    <td>{{ $appointment->fee }}</td>
                                                    <td>{{ $appointment->time }}</td>
                                                    <td>{{ $appointment->gender }}</td>
                                                    <td>{{ $appointment->email }}</td>
                                                    <td>{{ $appointment->phone }}</td>
                                                    <td>{{ $appointment->message }}</td>
                                                    <td class="center">
                                                        @if ($appointment->status == 'enable')
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                        @else
                                                        <span class="badge badge-warning">
                                                            In-active
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center;">
                                                        @if ($appointment->status == 'enable')
                                                        <a href="{{ URL::to('/appointment/unactive/' . $appointment->id)}}">
                                                            <span class="badge badge-warning">Inactive</span>
                                                        </a>
                                                        @else
                                                        <a href="{{ URL::to('/appointment/active/' . $appointment->id)}}">
                                                            <span class="badge badge-success">Active</span>
                                                        </a>
                                                        @endif

                                                        <form id="delete-form-{{ $appointment->id }}" method="POST" action="{{ URL::to('/delete/appointment', $appointment->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this data?')) {
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $appointment->id }}').submit();
                                                            }
                                                            else {
                                                                event.preventDefault();
                                                            }">
                                                            <i class="mdi mdi-delete-empty"> Delete</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                </div>
            </div>
            {{--  {{ $appointments->links() }}  --}}
        </div>
    </div>


      @endsection

@push('js')
    <!-- DataTables -->
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.js') }}">


    <script>
        $(function() {
            $('#startDate').datepicker({
                autoclose:true,
                dateFormat:'dd-mm-yy',
            });
            $('#endDate').datepicker({
                autoclose:true,
                dateFormat:'dd-mm-yy',
            });
        })
    </script>


@endpush



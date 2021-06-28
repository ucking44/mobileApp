@extends('layouts.backend.app')

@section('title', 'Manufacture')

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
            <h1 class="m-0 text-dark">Manufacture</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manufacture</li>
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
                    <a href="{{ URL::to('add-manufacture') }}" class="btn btn-primary">Create Manufacture</a>
                    @include('layouts.backend.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>All Categories</b></h4>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class=" text-primary">
                                            <th>ID</th>
                                            <th>Manufacture Name</th>
                                            <th>Manufacture Description</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th style="text-align: center;">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_manufacture_info as $key => $v_manufacture)
                                            {{-- <tbody> --}}
                                                <tr>
                                                    <td>{{ $v_manufacture->manufacture_id }}</td>
                                                    {{-- <td>{{ $key + 1 }}</td> --}}
                                                    <td>{{ $v_manufacture->manufacture_name }}</td>
                                                    <td>{{ $v_manufacture->manufacture_description }}</td>
                                                    <td class="center">
                                                        @if ($v_manufacture->status == 'enable')
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                        @else
                                                        <span class="badge badge-warning">
                                                            In-active
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $v_manufacture->created_at }}</td>
                                                    <td>{{ $v_manufacture->updated_at }}</td>

                                                    <td style="text-align: center;">
                                                        @if ($v_manufacture->status == 'enable')
                                                        <a href="{{ URL::to('/unactive_manufacture/' . $v_manufacture->manufacture_id)}}">
                                                            <span class="badge badge-warning">Inactive</span>
                                                            {{-- <i class="halflings-icon white thumbs-down">in-active</i> --}}
                                                        </a>
                                                        @else
                                                        <a href="{{ URL::to('/active_manufacture/' . $v_manufacture->manufacture_id)}}">
                                                            <span class="badge badge-success">Active</span>
                                                            {{-- <i class="halflings-icon white thumbs-up">active</i> --}}
                                                        </a>
                                                        @endif
                                                        <a href="{{ URL::to('/edit-manufacture/' . $v_manufacture->manufacture_id)}}">
                                                            <span class="badge badge-info">Edit</span>
                                                            {{-- <i class="halflings-icon white edit">edit</i> --}}
                                                        </a>
                                                        <a href="{{ URL::to('/delete-manufacture/' . $v_manufacture->manufacture_id)}}" id="delete">
                                                            <span class="badge badge-danger">Delete</span>
                                                            {{-- <i class="halflings-icon white trash">delete</i> --}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            {{-- </tbody> --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                </div>
            </div>
            {{ $all_manufacture_info->links() }}
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

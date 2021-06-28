@extends('layouts.backend.app')

@section('title', 'Slider')

@push('css')
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/jquery-ui/jquery-ui.css') }}">
@endpush

<style>
    span {
        content: "\20A6";
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-task"><a href="#">Home</a></li>
                    <li class="breadcrumb-task">Master</li>
                    <li class="breadcrumb-task active">Slider</li>
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
                    <a href="{{ URL::to('create/slider') }}" class="btn btn-primary">Add New Slider</a>
                    @include('layouts.backend.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>All Sliders</b></h4>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class=" text-primary">
                                            <th>Slider ID</th>
                                            <th>Slider Image</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th style="text-align: center;">Actions</th>
                                        </thead>

                                        <tbody>
                                            {{-- @foreach ($sliders as $key => $v_slider) --}}
                                            @foreach ($sliders as $v_slider)
                                            <tr>
                                                {{-- <td>{{ $key + 1 }}</td> --}}
                                                <td class="center">{{ $v_slider->id }}</td>
                                                <td> <img src="{{ URL::to($v_slider->slider_image) }}" style="height: 100px; width: 100px;"></td>
                                                <td class="center">

                                                    @if ($v_slider->status == 1)
                                                    <span class="badge bg-green">
                                                        Active
                                                    </span>
                                                    @else
                                                    <span class="badge bg-pink">
                                                        In-Active
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="center">{{ $v_slider->created_at }}</td>
                                                <td class="center">{{ $v_slider->updated_at }}</td>
                                                <td style="text-align: center;">
                                                    @if ($v_slider->status == 1)
                                                    <a href="{{ URL::to('/unactive_slider/' . $v_slider->id)}}">
                                                        <span class="badge badge-warning">Inactive</span>
                                                        {{-- <i class="halflings-icon white thumbs-down"></i> --}}
                                                    </a>
                                                    @else
                                                    <a href="{{ URL::to('/active_slider/' . $v_slider->id)}}">
                                                        <span class="badge badge-success">Active</span>
                                                        {{-- <i class="halflings-icon white thumbs-up">active</i> --}}
                                                    </a>
                                                    @endif
                                                    {{-- <a href="{{ URL::to('/edit-slider/' . $v_slider->id)}}">
                                                        <span class="badge badge-info">Edit</span> --}}
                                                        {{-- <i class="halflings-icon white edit">edit</i> --}}
                                                    {{-- </a> --}}
                                                    <form id="delete-form-{{ $v_slider->id }}" method="POST" action="{{ URL::to('/delete-slider', $v_slider->id) }}" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this data?')) {
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $v_slider->id }}').submit();
                                                    }
                                                    else {
                                                        event.preventDefault();
                                                    }">
                                                    <span class="badge badge-danger">Delete</span>

                                                    {{-- <a href="{{ URL::to('/delete-slider/' . $v_slider->id)}}" id="delete">
                                                        <span class="badge badge-danger">Delete</span> --}}
                                                        {{-- <i class="halflings-icon white trash">delete</i> --}}
                                                    {{-- </a> --}}
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
            {{ $sliders->links() }}
        </div>
    </div>
    <!-- /.content -->

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

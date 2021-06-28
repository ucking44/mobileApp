@extends('layouts.backend.app')

@section('title', 'Manufacture')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Category</li>
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
                    @include('layouts.backend.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>Add New Manufacture</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ URL::to('/save-manufacture') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Manufacture Name</label>
                                            <input type="text" class="form-control" name="manufacture_name" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Manufacture Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="manufacture_description" rows="3" cols="35" required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Publication Status</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" value="enable" required="">
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/all-manufacture') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Create Manufacture</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

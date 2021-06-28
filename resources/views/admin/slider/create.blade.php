@extends('layouts.backend.app')

@section('title', 'Slider')

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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Slider</li>
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
                            <h4 class="card-title "><b>Add New Slider</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ URL::to('/save-slider') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Slider Image</label>
                                        <input type="file" class="form-control" name="slider_image" required="">
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Publication Status</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" value="1" required="">
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/sliders') }}" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-primary">Create Slider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@extends('layouts.backend.app')

@section('title', 'Edit Service Categories')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Service Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Edit Service Category</li>
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
                            <h4 class="card-title "><b>Edit Service Category</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/update/service-category', $serviceCate->id) }}" method="POST">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Service Category Name</label>
                                            <input type="text" class="form-control" name="category_name" value="{{ $serviceCate->category_name }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Category Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="category_description" rows="3" cols="35" required="">{{ $serviceCate->category_description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/service-category') }}" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-primary">Update Service Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- /.content -->

@endsection
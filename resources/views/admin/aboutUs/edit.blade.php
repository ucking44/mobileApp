@extends('layouts.backend.app')

@section('title', 'Edit About Us')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit About Us</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Edit About Us</li>
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
                            <h4 class="card-title "><b>Edit About Us</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/update/aboutus', $aboutUs->id) }}" method="POST">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $aboutUs->name }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Years Of Experience</label>
                                            <input type="text" class="form-control" name="years_of_experience" value="{{ $aboutUs->years_of_experience }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $aboutUs->email }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Company</label>
                                            <input type="text" class="form-control" name="company" value="{{ $aboutUs->company }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Website</label>
                                            <input type="url" class="form-control" name="website" value="{{ $aboutUs->website }}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating"> Status</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" {{ $aboutUs->status == "enable" ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/aboutus') }}" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-primary">Update About Us</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- /.content -->

@endsection

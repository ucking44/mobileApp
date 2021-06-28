@extends('layout')

@section('title', 'Contact Us')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact Us</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Contact Us</li>
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
                            <h4 class="card-title "><b>Add New Contact Us</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ URL::to('/save/contact-us') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Name </label>
                                            <input type="text" class="form-control" name="name" required="" placeholder="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Email </label>
                                            <input type="email" class="form-control" name="email" required="" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Phone </label>
                                            <input type="number" class="form-control" name="phone" required="" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Message</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" rows="3" cols="35" required="" placeholder="Your Message"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Contact Us</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

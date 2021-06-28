@extends('layouts.backend.app')

@section('title', 'Create Article')

@section('content')

<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{--  @include('layouts.backend.partials.msg')  --}}
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>Create Article</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ URL::to('/store/blogs') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"><h6><b>Title</b></h6></label>
                                            <input type="text" class="form-control" name="title" placeholder="Title ....." required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"><h6><b>Body</b></h6></label>
                                            <textarea type="text" class="form-control" rows="5" name="body" placeholder="Content ....." required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3 mt-3">
                                        <label for="image"> <h6><b>Image</b></h6></label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>

                                <br/>
                                <br/>
                                <a href="{{ URL::to('/blogs') }}" class="btn btn-danger"><i class="mdi mdi-keyboard-backspace"> Back </i></a>
                                <button type="submit" class="btn btn-primary">Create Article</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

@endsection

@section('scripts')

@endsection

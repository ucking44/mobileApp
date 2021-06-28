@extends('layouts.backend.app')

@section('title', 'Edit Article')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{-- @include('layouts.backend.partials.msg') --}}
            <div class="card">
                <div class="card-header">
                    <h3><b>Edit Article</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ URL::to('/update/blogs', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label for="title"> <h6><b>Title</b></h6></label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="body"> <h6><b>Body</b></h6></label>
                                    <textarea type="text" class="form-control" rows="5" name="body" placeholder="Content ....." required="">{{ $blog->body }}</textarea>
                                </div>

                                <div class="col-3 mt-3">
                                    <label for="image"> <h6><b>Image</b></h6></label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <br/>
                                <br/>

                                <a href="{{ URL::to('/admin/blogs') }}" class="btn btn-danger"><i class="mdi mdi-keyboard-backspace"> Back </i></a>
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-update"> Update </i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection

@extends('layouts.backend.app')

@section('title', 'Blog Post')

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
            <h1 class="m-0 text-dark">Blog Post</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Blog Post</li>
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
                    <a href="{{ URL::to('/create/blogs') }}" class="btn btn-primary">Create Article</a>
                    @include('layouts.backend.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>All Blog Posts</b></h4>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class=" text-primary">
                                            <th>ID</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Body</th>
                                            <th class="text-center">Image</th>
                                            {{--  <th class="text-center">Edit</th>
                                            <th class="text-center">Delete</th>  --}}
                                            <th>Status</th>
                                            {{-- <th>Created At</th>
                                            <th>Updated At</th> --}}
                                            <th style="text-align: center;">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $key => $article)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td >{{ $article->title }}</td>
                                                    <td>{{ $article->body }}</td>
                                                    <td class="text-center">
                                                        <img class="img-responsive img-thumbnail" src="{{ asset('uploads/blog/' . $article->image) }}" style="height: 80px; width: 80px" alt="">
                                                    </td>
                                                    {{--  <td>  delete/{id}
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item align-middle"><i class="fas fa-circle text-success"></i></li>
                                                            <li class="list-inline-item align-middle"><i class="fas fa-circle text-pink"></i></li>
                                                            <li class="list-inline-item align-middle"><i class="fas fa-circle text-info"></i></li>
                                                            <li class="list-inline-item align-middle"><i class="fas fa-circle text-warning"></i></li>
                                                        </ul>
                                                    </td>  --}}
                                                    <td class="center">
                                                        @if ($article->status == 'enable')
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                        @else
                                                        <span class="badge badge-warning">
                                                            In-active
                                                        </span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ $article->created_at }}</td>
                                                    <td>{{ $article->updated_at }}</td> --}}

                                                    <td style="text-align: center;">
                                                        @if ($article->status == 'enable')
                                                        <a href="{{ URL::to('/blog/unactive/' . $article->id)}}">
                                                            <span class="badge badge-warning">Inactive</span>
                                                            {{-- <i class="halflings-icon white thumbs-down">in-active</i> --}}
                                                        </a>
                                                        @else
                                                        <a href="{{ URL::to('/blog/active/' . $article->id)}}">
                                                            <span class="badge badge-success">Active</span>
                                                            {{-- <i class="halflings-icon white thumbs-up">active</i> --}}
                                                        </a>
                                                        @endif

                                                         <a href="{{ URL::to('/edit/blogs', $article->id) }}" class="mr-2"><span class="badge badge-info">Edit</span></a>


                                                        <form id="delete-form-{{ $article->id }}" method="POST" action="{{ URL::to('/delete/blogs', $article->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this data?')) {
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $article->id }}').submit();
                                                            }
                                                            else {
                                                                event.preventDefault();
                                                            }">
                                                            <i class="mdi mdi-delete-empty"> Delete</i>
                                                        </button>
                                                        {{--  <a href="{{ URL::to('/admin/delete', $member->id) }}"><i class="las la-trash-alt text-danger font-18"></i></a>  --}}
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
            {{--  {{ $blogs->links() }}  --}}
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



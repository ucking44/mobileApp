@extends('layouts.backend.app')

@section('title', 'Product')

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
                    <h1 class="m-0 text-dark">Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-task"><a href="#">Home</a></li>
                    <li class="breadcrumb-task">Master</li>
                    <li class="breadcrumb-task active">Product</li>
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
                    <a href="{{ URL::to('add-product') }}" class="btn btn-primary">Add New Product</a>
                    @include('layouts.backend.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                            <h4 class="card-title "><b>All Products</b></h4>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class=" text-primary">
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Product Price</th>
                                            <th>Stock</th>
                                            <th>Image</th>
                                            {{-- <th>Product Size</th>
                                            <th>Product Color</th> --}}
                                            <th>Status</th>
                                            {{-- <th>Created At</th>
                                            <th>Updated At</th> --}}
                                            <th style="text-align: center;">Actions</th>
                                        </thead>

                                        <tbody>
                                        @foreach ($products as $v_product)
                                            <tr>
                                                {{-- <td>{{ $key + 1 }}</td> --}}
                                                <td>{{ $v_product->product_id }}</td>
                                                <td>{{ $v_product->category_name }}</td>
                                                <td>{{ $v_product->manufacture_name }}</td>
                                                <td>{{ $v_product->product_name }}</td>
                                                {{-- <td>{{ $v_product->product_description }}</td> --}}
                                                <td><span>&#8358;</span>{{ number_format($v_product->product_price, 2) }}</td>
                                                <td>{{ $v_product->stock }}</td>
                                                <td>
                                                    <img class="img-responsive img-thumbnail" src="{{ asset('uploads/products/' .  $v_product->product_image) }}" style="height: 80px; width: 80px" alt="">
                                                </td>
                                                {{-- <td> <img src="{{ URL::to($v_product->product_image) }}" style="height: 80px; width: 80px;"></td> --}}
                                                {{-- <td>{{ $v_product->product_size }}</td>
                                                <td>{{ $v_product->product_color }}</td> --}}
                                                <td>
                                                    @if ($v_product->status == 'enable')
                                                        <span class="badge bg-green">Active</span>
                                                    @else
                                                        <span class="badge bg-pink">In-active</span>
                                                    @endif
                                                    {{-- <span class="badge badge-success">
                                                        Active
                                                    </span>
                                                    @else
                                                    <span class="badge badge-warning">
                                                        In-active
                                                    </span> --}}
                                                    {{-- @endif --}}
                                                </td>
                                                {{-- <td>
                                                    @if($interestRate->status == 'enable')
                                                        <span class="badge bg-blue">Enable</span>
                                                    @else
                                                        <span class="badge bg-pink">Disable</span>
                                                    @endif
                                                </td> --}}
                                                <td style="text-align: center;">
                                                    @if ($v_product->status == 'enable')
                                                    <a href="{{ URL::to('/unactive_product/' . $v_product->product_id)}}">
                                                        <span class="badge badge-warning">Inactive</span>
                                                        {{-- <i class="halflings-icon white thumbs-down"></i> --}}
                                                    </a>
                                                    @else
                                                    <a href="{{ URL::to('/active_product/' . $v_product->product_id)}}">
                                                        <span class="badge badge-success">Active</span>
                                                        {{-- <i class="halflings-icon white thumbs-up">active</i> --}}
                                                    </a>
                                                    @endif
                                                    <a href="{{ URL::to('/edit-product/' . $v_product->product_id)}}">
                                                        <span class="badge badge-info">Edit</span>
                                                        {{-- <i class="halflings-icon white edit">edit</i> --}}
                                                    </a>
                                                    <a href="{{ URL::to('/delete-product/' . $v_product->product_id)}}" id="delete">
                                                        <span class="badge badge-danger">Delete</span>
                                                        {{-- <i class="halflings-icon white trash">delete</i> --}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>


                                        {{-- <tbody>
                                            @foreach($tasks as $key => $task)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $task->name }}</td>
                                                    <td>{{ $task->category->name }}</td>
                                                    <td>{{ $task->description }}</td>
                                                    <td>{{ $task->created_at }}</td>
                                                    <td>{{ $task->updated_at }}</td>
                                                    <td><a href="{{ route('task.edit', $task->id) }}" class="btn btn-info btn-sm"><i class="material-icons">Edit</i> </a>

                                                        <form id="delete-form-{{ $task->id }}" method="POST" action="{{ route('task.destroy', $task->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this data?')) {
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{ $task->id }}').submit();
                                                        }
                                                        else {
                                                            event.preventDefault();
                                                        }">
                                                        <i class="material-icons">Delete</i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>
                            {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                    </div>
            </div>
            {{ $products->links() }}
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

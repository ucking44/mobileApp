@extends('layouts.backend.app')

@section('title', 'Product')

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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active"> Product</li>
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
                            <h4 class="card-title "><b>Edit Product</b></h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ URL::to('update-product', $product_info->product_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Category</label>
                                            <select class="form-control" name="category">
                                                <option>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option {{ $category->category_id == $product_info->category_id ? 'selected' : '' }} value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Manufacture</label>
                                            <select class="form-control" name="manufacture">
                                                <option>Select Manufacturer</option>
                                                @foreach($all_manufacture_info as $v_manufacture)
                                                <option {{ $v_manufacture->manufacture_id == $product_info->manufacture_id ? 'selected' : ''}} value="{{ $v_manufacture->manufacture_id }}">{{ $v_manufacture->manufacture_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" value="{{ $product_info->product_name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Description</label>
                                            <textarea type="text" class="form-control" name="product_description">{{ $product_info->product_description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Product Price</label>
                                            <input type="number" class="form-control" name="product_price" value="{{ $product_info->product_price }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Stock</label>
                                            <input type="number" class="form-control" name="stock" value="{{ $product_info->stock }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Product Image</label>
                                            <input type="file" class="form-control" name="product_image" value="{{ $product_info->product_image }}">
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Product Size</label>
                                            <input type="text" class="form-control" name="product_size" value="{{ $product_info->product_size }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Product Color</label>
                                            <input type="text" class="form-control" name="product_color" value="{{ $product_info->product_color }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="modal-body">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                      <input type="checkbox" name="status" id="status" {{ $interestRate->status == "enable" ? 'checked' : '' }} >
                                    </div>
                                </div> --}}


                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Publication Status</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="publication_status" {{ $product_info->status == "enable" ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <a href="{{ URL::to('all-product') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

@endsection

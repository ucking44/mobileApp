@extends('layout')
@section('content')

<div class="col-sm-9 padding-right">
    @include('layouts.flash-message')
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img class="img-responsive img-thumbnail" src="{{ asset('uploads/products/' .  $product->product_image) }}" alt="">
                {{-- <img src="{{ URL::to($product_by_details->product_image) }}" alt="" /> --}}
                <h3>ZOOM</h3>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{ $product->product_name }}</h2>
                <p>Color: {{ $product->product_color }}</p>
                <img src="{{ URL::to('frontend/images/product-details/rating.png') }}" alt="" />
                <span>
                    <span>{{ $product->product_price }} NG</span>
                    <form action="{{ url('/add-to-cart') }}" method="POST">
                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        <label>Quantity:</label>
                        <input name="qty" type="text" value="1" />
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </form>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ $product->manufacture_name }} </p>
                <p><b>Category:</b> {{ $product->category_name }} </p>
                <p><b>Size:</b> {{ $product->product_size }} </p>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->


@endsection

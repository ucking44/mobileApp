@extends('layout')

@section('content')

<div class="custom-product">
    {{-- <div class="col-sm-4">
        <a href="#">Filter</a>
    </div> --}}
    <h2 class="title text-center">Search Result For Product ...</h2>
        @foreach($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <img class="img-responsive img-thumbnail" src="{{ asset('uploads/products/' .  $product->product_image) }}" style="height: 200px; width: 200px;" alt="">
                                {{-- <img src="{{ URL::to( $v_published_product->product_image ) }}" style="height: 200px;" alt="" /> --}}
                                <h2>{{ $product->product_price }} NGN</h2>
                                <p>{{ $product->product_name }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{ $product->product_price }} NGN</h2>
                                    <a href="{{ URL::to('/view_product/'. $product->product_id) }}"><p>{{ $product->product_name }}</p></a>
                                    <a href="{{ URL::to('/view_product/'. $product->product_id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>{{ $product->manufacture_name }}</a></li>
                            <li><a href="{{ URL::to('/view_product/'. $product->product_id) }}"><i class="fa fa-plus-square"></i>View Product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $products->links() }}
</div>
					{{-- </div><!--features_items--> --}}

@endsection

@push('js')

@endpush




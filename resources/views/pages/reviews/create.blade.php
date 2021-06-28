@extends('layout')
@section('content')

<div class="col-sm-9 padding-right">
    @include('layouts.flash-message')

    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                {{-- <p> {{ $reviews->product_description }} </p> --}}
            </div>



                {{-- <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

            <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">

                    <p><b>Write Your Review</b></p>

                    {{-- <form action="#" style="background-color: cyan;"> --}}
                        <form action="{{ URL::to('/products') }}" method="POST">
                        @csrf
                        <span>
                            <input type="text" name="customer_name" placeholder="Enter Your Name...."/>
                            {{-- <input type="hidden" value="{{ Auth::id() }}" name="product" id="product_id"> --}}

                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->product_id }}">

                            {{-- <input type="email" placeholder="Enter Your Email Address...."/> --}}
                        </span>
                        <textarea name="review" rows="5" class="form-control" ></textarea>

                        {{-- <input type="checkbox" name="status" value="enable" required=""> --}}
                        <b>Rating: </b> <img src="{{ URL::to('frontend/images/product-details/rating.png') }}" alt="" />
                        {{-- <input type="checkbox" name="rating" value="" required=""> --}}
                        <button type="submit" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/category-tab-->

@endsection

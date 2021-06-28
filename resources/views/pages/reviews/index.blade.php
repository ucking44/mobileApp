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
                <p>  </p>
            </div>

            <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">
                    <?php $reviews = DB::table('reviews')->get(); ?>
                    @foreach($reviews as $review)
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>{{ $review->customer_name }}</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>{{ date('H: i', strtotime($review->created_at)) }}</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>{{ date('F j, Y', strtotime($review->created_at)) }}</a></li>
                    </ul>
                    <p>{{ $review->review }}</p>
                    @endforeach
                    {{-- <p><b>Write Your Review</b></p> --}}

                </div>
            </div>


            <div class="col-sm-4" style="float: right;">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{ URL::to('/write-review') }}" class="btn btn-default add-to-cart"><b>Write Your Review</b></a>
                    </div>
                </div>
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

        </div>
    </div><!--/category-tab-->

@endsection

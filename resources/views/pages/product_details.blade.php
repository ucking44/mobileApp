@extends('layout')
@section('content')

@include('layouts.flash-message')
{{-- @foreach($product_by_details as $value) --}}
<div class="col-sm-9 padding-right">
    {{-- @include('layouts.flash-message') --}}
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img class="img-responsive img-thumbnail" src="{{ asset('uploads/products/' .  $product_by_details->product_image) }}" alt="">
                {{-- <img src="{{ URL::to($product_by_details->product_image) }}" alt="" /> --}}
                <h3>ZOOM</h3>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{ $product_by_details->product_name }}</h2>
                <p>Color: {{ $product_by_details->product_color }}</p>
                <img src="{{ URL::to('frontend/images/product-details/rating.png') }}" alt="" />
                <span>
                    <span>{{ $product_by_details->product_price }} NG</span>
                    <form action="{{ url('/add-to-cart') }}" method="POST">
                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        <label>Quantity:</label>
                        <input name="qty" type="text" value="1" />
                        <input type="hidden" name="product_id" value="{{ $product_by_details->product_id }}">
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </form>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ $product_by_details->manufacture_name }} </p>
                <p><b>Category:</b> {{ $product_by_details->category_name }} </p>
                <p><b>Size:</b> {{ $product_by_details->product_size }} </p>


                <?php
                    $customer_id = Session::get('customer_id');
                    //wishlist Code start
                    // if(Auth::check()){
                    // if (Session::get('customer_id')){
                    if ($customer_id != NULL){
                        // {{ session()->get('name') }}
                    $wishData = DB::table('wish_lists')->leftJoin('products', 'wish_lists.product_id', '=', 'products.product_id')->where('wish_lists.product_id', '=', $product_by_details->product_id)->get();
                    //if($wishData==""){ echo 'empty'; } else { echo 'filled';}
                    $count = App\WishList::where(['product_id' => $product_by_details->product_id])->count();
                ?>
                <?php if ($count == "0") { ?>

                <form action="{{ URL::to('/addToWishList') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product_by_details->product_id }}">
                    <input type="submit" value="Add To WishList" class="btn btn-success">
                </form>

                <?php } else {?>
                    <h4 style="color:green"><b>Added To</b><a href="{{url('/wishList')}}" class="btn btn-info cart">WishList</a></h4>
                <?php }
                }?>

            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->

    <?php $reviews = DB::table('reviews')->get();
    $count_reviews = count($reviews); ?>
    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{ $count_reviews }})</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                <p> {{ $product_by_details->product_description }} </p>
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
                    {{-- @if(count($reviews) > 1) --}}
                        @foreach($reviews as $review)
                        <ul>
                            <li><a href="{{ URL::to('/product-show-review', $review->product_id) }}"><i class="fa fa-user"></i>{{ $review->customer_name }}</a></li>
                            {{-- <li><a href=""><i class="fa fa-user"></i>{{ $review->customer_name }}</a></li> --}}
                            <li><a href="#"><i class="fa fa-clock-o"></i>{{ date('H: i', strtotime($review->created_at)) }}</a></li>
                            <li><a href="#"><i class="fa fa-calendar-o"></i>{{ date('F j, Y', strtotime($review->created_at)) }}</a></li>
                        </ul>
                        <p>{{ $review->review }}</p>
                        @endforeach
                    {{-- @else
                    </p> Review Not Found!</p>
                    @endif --}}
                    <p><b>Write Your Review</b></p>


                    {{-- <form action="#" style="background-color: cyan;"> --}}
                        <form action="{{ URL::to('/reviews') }}" method="POST">
                        @csrf
                        <span>
                            <input type="text" name="customer_name" placeholder="Enter Your Name...." required="" />
                            {{-- <input type="hidden" value="{{ Auth::id() }}" name="product" id="product_id"> --}}
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product_by_details->product_id }}">
                            {{-- <input type="email" placeholder="Enter Your Email Address...."/> --}}
                        </span>
                        <textarea name="review" rows="5" class="form-control" required=""></textarea>

                        {{-- <input type="checkbox" name="status" value="enable" required=""> --}}
                        {{-- <b>Rating: </b> <img src="{{ URL::to('frontend/images/product-details/rating.png') }}" alt="" /> --}}
                        {{-- <input type="checkbox" name="rating" value="" required=""> --}}
                        <button type="submit" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/category-tab-->
</div>
{{-- @endforeach --}}

@endsection

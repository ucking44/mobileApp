@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">

        <div class="register-req">
            <p>Please Fill Up This Form............</p>
        </div><!--/register-req-->
        
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Shipping Details</p>
                        <div class="form-one">
                            <form action="{{ url('/save/aboutus') }}" method="POST">
                                @csrf
                                <input type="email" name="name" placeholder="Email*" required="">
                                <input type="text" name="name" placeholder=" Name *" required="">
                                <input type="text" name="years_of_experience" placeholder="Years Of Experience *" required="">
                                <input type="text" name="company" placeholder="Company *" required="">
                                <input type="url" name="website" placeholder="Company Website *" required="">
                                {{--  <input type="text" name="shipping_city" placeholder="City *" required="">  --}}
                                <input type="submit" class="btn btn-warning" value="Done">
                                {{-- <b><input type="submit" class="btn btn-warning" value="Done"></b> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="review-payment">
            <h2>Review & Payment</h2>
        </div> --}}
    </div>
</section> <!--/#cart_items-->

@endsection

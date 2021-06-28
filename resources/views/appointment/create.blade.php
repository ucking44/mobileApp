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
                @include('layouts.backend.partials.msg')
                    <div class="bill-to">
                        <p>Shipping Details</p>
                        <div class="form-one">
                            <form action="{{ url('/save/appointment') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Service Name</label>
                                            <select class="form-control" name="service_name" required>
                                                <option>Select Service Name</option>
                                                @foreach ($services as $id => $service)
                                                    <option value="{{ $id }}">{{ $service }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{--  <input type="text" name="service_name" placeholder="Service Name *" required="">  --}}
                                <input type="text" name="firstName" placeholder="First Name *" required="">
                                <input type="text" name="lastName" placeholder="Last Name *" required="">
                                <input type="date" name="date" placeholder="Date *" required="">
                                <input type="time" name="time" placeholder="Time *" required="">
                                <input type="text" name="gender" placeholder="Gender *" required="">
                                <input type="email" name="email" placeholder="Email*" required="">
                                <input type="text" name="phone" placeholder="Mobile Number *" required="">
                                <textarea type="text" class="form-control" rows="5" name="message" placeholder="Message ....." required=""></textarea>
                                <input type="checkbox" name="status" value="enable" required="">
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

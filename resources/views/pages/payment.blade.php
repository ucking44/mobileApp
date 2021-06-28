@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container col-sm-12">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $contents = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contents as $v_contents) { ?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ URL::to($v_contents->options->image) }}" height="80px;" width="80px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $v_contents->name }}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $v_contents->price }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ url('/update-cart') }}" method="POST">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="qty" value="{{ $v_contents->qty }}" autocomplete="off" size="2">
                                    {{-- <a class="cart_quantity_up" href=""> + </a> --}}
                                    <input type="hidden" name="rowId" value="{{ $v_contents->rowId }}">
                                    {{-- <a class="cart_quantity_down" href=""> - </a> --}}
                                    <input class="btn btn-sm btn-default" type="submit" name="submit" value="update">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ $v_contents->total }}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ URL::to('/delete-to-cart/'. $v_contents->rowId) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would</h3>
            <p>Choose if like</p>
        </div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Payment Method</li>
            </ol>
        </div>
        <div class="paymentCont col-sm-8">
            <div class="headingWrap">
                <h3 class="headingTop text-center">Select Your Payment Method</h3>
                <p class="text-center">Created with</p>
            </div>
            
                {{-- <div class="paymentWrap">
                    <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                        <form action="{{ url('/order-place') }}" method="POST">
                            @csrf
                            <label class="btn paymentMethod active">
                                <div class="method visa"></div>
                                    <input type="radio" name="payment_gateway" value="handcash" checked>
                            </label>
                            <label class="btn paymentMethod">
                                <div class="method master-card"></div>
                                    <input type="radio" name="payment_gateway" value="paypal" checked>
                            </label>
                            <label class="btn paymentMethod">
                                <div class="method method amex"></div>
                                    <input type="radio" name="payment_gateway" value="bakash" checked>
                            </label>
                            <label class="btn paymentMethod active">
                                <div class="method vishwa"></div>
                                    <input type="radio" name="payment_gateway" value="payza" checked>
                            </label> --}}
                            {{-- <label class="btn paymentMethod active">
                                <div class="method ez-cash"></div>
                                    <input type="radio" name="payment_gateway" checked>
                            </label> --}}
                            {{-- <div class="footerNavWrap clearfix">
                                <input type="submit" value="Done" class="btn btn-success pull-left btn-fyl"><span class="glyphicon glyphicon-chevron-left"></span>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <form action="{{ url('/order-place') }}" method="POST">
                    @csrf
                    <input type="radio" name="payment_method" value="handcash">Hand Cash <br>
                    <input type="radio" name="payment_method" value="card">Debit Card <br>
                    <input type="radio" name="payment_method" value="paypal">Paypal <br>
                    <input type="submit" name="" value="Done">
                </form>
                
        </div>
    </div>
</section>

@endsection

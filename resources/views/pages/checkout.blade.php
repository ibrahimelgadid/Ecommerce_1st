@extends('layout')

@section('content')
<section id="cart_items">
    <div class="container">
    

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Shipping details</p>
                        <div class="form-one">
                            <form action="/save_shipping" method="POST">
                                @csrf
                                <input type="email" placeholder="Email*" name="email">
                                <input type="text" placeholder="First Name *" name="fname">
                                <input type="text" placeholder="Last Name *" name="lname">
                                <input type="text" placeholder="Address*" name="address">
                                <input type="text" placeholder="Mobile" name="mobile">
                                <input type="text" placeholder="City *" name="city">
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
                				
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        
        
    </div>
</section> <!--/#cart_items-->
@endsection
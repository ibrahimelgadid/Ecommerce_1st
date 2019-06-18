@extends('layout')

@section('content')


<section id="cart_items">
		<div class="container col-md-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
            </div>
            @include('inc.messages')
			<div class="table-responsive cart_info">
                
                <?php
                    $contents = Cart::content();
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="name">Name</td>
							{{-- <td class="description"></td> --}}
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
                        @foreach ($contents as $content)
                            
                        
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($content->options->image)}}" style="height: 100px;width: 100px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>${{$content->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{url('/update_cart')}}" method="POST">
										@csrf
										<input class="cart_quantity_input" type="text" name="qty" value="{{$content->qty}}" autocomplete="off" size="2">
										<input type="hidden" name="rowId" value="{{$content->rowId}}">
										<input type="submit" value="Update" class="btn btn-sm btn-default">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$content->total}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete delete" href="/delete_cart/{{$content->rowId}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
						
					</tbody>
                </table>
                <a class="btn btn-default ClearCart delete update" href="/destroy">Clear Cart</a>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>${{Cart::subtotal()}}</span></li>
							<li>Eco Tax <span>${{Cart::tax()}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>${{Cart::total()}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="
							@if (Session::get('customer_id'))
								{{URL::to('/checkout')}}
							@else
								{{URL::to('/login_check')}}
							@endif
							">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection
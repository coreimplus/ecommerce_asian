@extends('frontend.app')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="{{ route('checkout.place.order') }}" method="POST">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input value="{{ auth()->user()->name }}" name="name" class="form-control" type="text"
                                       placeholder="John" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input value="{{ auth()->user()->email }}" name="email" class="form-control" type="text"
                                       placeholder="example@email.com" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input value="{{ auth()->user()->phone_number }}" name="mobile_number"
                                       class="form-control" type="text" placeholder="+123 456 789" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input value="{{ auth()->user()->address }}" name="address" class="form-control"
                                       type="text" placeholder="123 Street" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select value="{{ auth()->user()->country }}" name="country" class="custom-select"
                                        disabled>
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input value="{{ auth()->user()->city }}" name="city" class="form-control" type="text"
                                       placeholder="New York" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input value="{{ auth()->user()->state }}" name="state" class="form-control" type="text"
                                       placeholder="New York" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input value="{{ auth()->user()->zip_code }}" name="zip_code" class="form-control"
                                       type="text" placeholder="123" disabled>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount" disabled>
                                    <label class="custom-control-label" for="newaccount">Create an account</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input name="new_shipping_address" type="checkbox" class="custom-control-input"
                                           id="shipto">
                                    <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                           data-target="#shipping-address">Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mb-5" id="shipping-address">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span>
                        </h5>
                        <div class="bg-light p-30">
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>Full Name</label>
                                    <input name="shipping_name" class="form-control" type="text" placeholder="John">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>E-mail</label>
                                    <input name="shipping_email" class="form-control" type="text"
                                           placeholder="example@email.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Mobile No</label>
                                    <input name="shipping_mobile_number" class="form-control" type="text"
                                           placeholder="+123 456 789">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address</label>
                                    <input name="shipping_address" class="form-control" type="text"
                                           placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <select name="shipping_country" class="custom-select">
                                        <option selected>United States</option>
                                        <option>Afghanistan</option>
                                        <option>Albania</option>
                                        <option>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input name="shipping_city" class="form-control" type="text" placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input name="shipping_state" class="form-control" type="text"
                                           placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>ZIP Code</label>
                                    <input name="shipping_zip_code" class="form-control" type="text" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Products</h6>
                            @foreach($cartItems as $cartItem)
                                <div class="d-flex justify-content-between">
                                    <p>{{ $cartItem->name }}</p>
                                    <p>${{ $cartItem->price * $cartItem->qty }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>${{ $subTotal }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">${{ $shipping }}</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>${{ $subTotal + $shipping }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span>
                        </h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_type"
                                           id="cash-on-delivery" value="Cash on Delivery">
                                    <label class="custom-control-label" for="cash-on-delivery">Cash on Delivery</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_type" id="stripe" value="Stripe">
                                    <label class="custom-control-label" for="stripe" value="Stripe">Stripe</label>
                                </div>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->

@endsection

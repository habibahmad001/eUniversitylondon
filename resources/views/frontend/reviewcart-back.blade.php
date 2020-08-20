@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Account Details</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/reviewcart") }}">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Shop - Addresses
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75 shop-order-received">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <article id="post-1707" class="post-1707 page type-page status-publish hentry">
                        <header class="entry-header">
                            @if(session()->has('message'))
                                <div class="woocommerce-message">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <h1 class="entry-title">Order received</h1>
                            <span class="edit-link">
										<a class="post-edit-link" href="{{ URL::to("/addressinfo") }}">Edit
											<span class="screen-reader-text"> "Checkout"
											</span>
										</a>
									</span>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-order">
                                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                                        Thank you. Your order has been received.
                                    </p>

                                    <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                                        {{--<li class="woocommerce-order-overview__order order">--}}
                                        {{--Order number: <strong>1719</strong>--}}
                                        {{--</li>--}}

                                        <li class="woocommerce-order-overview__date date">
                                            Date: <strong>{{ Carbon\Carbon::parse($datenow)->format('F d, Y') }}</strong>
                                        </li>

                                        <li class="woocommerce-order-overview__total total">
                                            Total: <strong>
                        <span class="woocommerce-Price-amount amount">
                            <span class="woocommerce-Price-currencySymbol">$</span>{{ (isset($Total)) ? $Total : 0 }}</span>
                                            </strong>
                                        </li>


                                        <li class="woocommerce-order-overview__payment-method method">
                                            Payment method: <strong>PayPal</strong>
                                        </li>


                                    </ul>


                                    <p>Pay with cash upon delivery.</p>

                                    <section class="woocommerce-order-details">

                                        <h4 class="woocommerce-order-details__title">Order details</h4>

                                        <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

                                            <thead>
                                            <tr>
                                                <th class="woocommerce-table__product-name product-name">Product</th>
                                                <th class="woocommerce-table__product-table product-total">Total</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if($CartItems != "emp")
                                                @foreach($CartItems as $v)
                                                    <tr class="woocommerce-table__line-item order_item">

                                                        <td class="woocommerce-table__product-name product-name">
                                                            <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $v[1]))) }}">{{ $v[1] }}</a> <strong
                                                                    class="product-quantity">× {{ $v[2] }}</strong>
                                                        </td>

                                                        <td class="woocommerce-table__product-total product-total">
                                                                        <span class="woocommerce-Price-amount amount">
                                                                            <span class="woocommerce-Price-currencySymbol">$</span>{{ $v[2]*$v[3] }}</span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif

                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">Subtotal:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>{{ (isset($SubTotal)) ? $SubTotal : 0 }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Payment method:</th>
                                                <td>PayPal</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>{{ (isset($Total)) ? $Total : 0 }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><a href="{{ URL::to('/paypal') }}" class="checkout-button btn btn-maincolor alt wc-forward">Proceed to pay</a></td>
                                            </tr>
                                            </tfoot>

                                        </table>


                                        <section class="woocommerce-customer-details">

                                            <h4>Customer details</h4>

                                            @if ($errors->any())
                                                <div class="woocommerce-message">
                                                    @foreach ($errors->all() as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif

                                            @guest
                                                <form id="login" class="cart-login" method="POST" action="/learnerlogin" onSubmit="return cart_login_validate('');">
                                                    {{ csrf_field() }}
                                                    <div class="form-group has-placeholder">
                                                        <label for="email-login-cart">Email:</label>
                                                        <input type="email" class="form-control" id="email-login-cart" placeholder="Your email adress" name="email">
                                                    </div>
                                                    <div class="form-group has-placeholder">
                                                        <label for="password-login-cart">Password:</label>
                                                        <input type="password" class="form-control" id="password-login-cart" placeholder="Password" name="password">
                                                    </div>
                                                    <div class="form-check">
                                                    </div>
                                                    <button type="submit" class="btn btn-maincolor log-btn">Log In</button>
                                                </form>
                                            @endguest

                                            @auth
                                                <table class="woocommerce-table woocommerce-table--customer-details shop_table customer_details">


                                                    <tbody>
                                                    <tr>
                                                        <th>Email:</th>
                                                        <td>{{ (Auth::user()) ? Auth::user()->email : "" }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Phone:</th>
                                                        <td>{{ (Auth::user()) ? Auth::user()->phone : "" }}</td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            @endauth

                                            <h4 class="woocommerce-column__title">Billing address</h4>

                                            <address>
                                                @if(count($addressData) > 0)
                                                    <p data-msg="s_msg">
                                                        {{(isset($addressData[0]->s_street_address)) ? $addressData[0]->s_street_address : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->s_country)) ? App\Http\Controllers\Front\CartController::GetCountryName($addressData[0]->s_country)->country_name : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->s_state)) ? App\Http\Controllers\Front\CartController::GetStateName($addressData[0]->s_state)->state_name : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->s_city)) ? $addressData[0]->s_city : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->s_zip)) ? $addressData[0]->s_zip : ""}}
                                                    </p>
                                                @else
                                                    <p data-msg="s_msg">
                                                        You have not set up this type of address yet.
                                                    </p>
                                                @endif
                                            </address>


                                        </section>

                                    </section>


                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>
            </div>
        </div>
    </section>

@endsection
@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Shopping Cart</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Shopping Cart
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-py-60 s-py-lg-100 shop-cart">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    @if(session()->has('message'))
                        <div class="woocommerce-message">
                            {{ session()->get('message') }} @if(strpos(session()->get('message'), "removed") !== false) <a href="{{ URL::to("/undocart") }}">Undo?</a> @endif
                        </div>
                    @endif
                    <form class="woocommerce-cart-form" name="cart-update" id="cart-update" action="{{ URL::to("/updatecart") }}" method="POST">

                        <table class="shop_table shop_table_responsive cart">
                            <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($CartItems != "emp")
                                @foreach($CartItems as $v)
                                    <tr class="cart_item">

                                        <td class="product-remove">
                                            <a href="javascript:void(0);" class="remove" aria-label="Remove this item" onclick="javascript:cart_item_submit({{ $v[4] }});" data-product_id="73" data-product_sku="">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $v[1]))) }}">
                                                <img width="180" height="180" src="{{ asset('/uploads/pavatar/' . $v[0]) }}" class="" alt="">
                                            </a>
                                        </td>

                                        <td class="product-name" data-title="Product">
                                            <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $v[1]))) }}">{{ $v[1] }}</a>
                                        </td>

                                        <td class="product-price" data-title="Price">
                                                        <span class="amount">
                                                            <span>£</span>{{ $v[3] }}.00
                                                        </span>
                                        </td>

                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity">
                                                <input type="button" value="+" class="plus">
                                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                <input type="number" class="input-text qty text" step="1" min="1" max="1000" name="quantity[]" value="{{ $v[2] }}" title="Qty" size="4">
                                                <input type="button" value="-" class="minus">
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </div>
                                        </td>

                                        <td class="product-subtotal" data-title="Total">
                                                        <span class="amount">
                                                            <span>£</span>{{ $v[2]*$v[3] }}.00
                                                        </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="cart_item">

                                    <td class="product-remove text-center" colspan="6">
                                        Cart is empty now !!!
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="6" class="actions">

                                    <div class="coupon">
                                        <label for="coupon_code">Coupon:</label>
                                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                                        <input type="submit" class="btn btn-maincolor apply" name="apply_coupon" value="Apply coupon">
                                    </div>
                                    <div id="addinput"></div>
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-maincolor update_cart" name="update_cart" value="Update cart">

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </form>

                    <div class="cart-collaterals">
                        <form method="POST" name="prod" id="prod" action="{{ URL::to("/addcart") }}">

                            <div class="cross-sells">
                                {{ csrf_field() }}
                                <h2>You may be interested in…</h2>


                                <ul class="products">
                                    @if(count($Courses) > 0)
                                        @foreach($Courses as $course)
                                            <li class="product">
                                                <a class="link-scale" href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $course->course_title))) }}">
                                                    {!! ($course->OfferData && (strtotime($course->EndDate) >= strtotime(Carbon\Carbon::now()))) ? '<span class="onsale">'.$course->OfferData.'% Off</span>' : '' !!}
                                                    <span class="onsale">Sale!</span>
                                                    <img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                                                </a>
                                                <div class="item-content ls bordered">
                                                    <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $course->course_title))) }}">
                                                        <h2>{{ $course->course_title }}</h2>
                                                    </a>
                                                    <div class="star-rating">
                                                        <span style="width:80%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                                    </div>
                                                    <span class="price">
                                                                {{--<del>--}}
                                                                    {{--<span>--}}
                                                                        {{--<span>$</span>115.00--}}
                                                                    {{--</span>--}}
                                                                {{--</del>--}}
                                                                <span>
                                                                    <span>£</span>{{ $course->course_price }}.00
                                                                </span>
                                                            </span>
                                                    <div id="itm-post-{{ $course->id }}"></div>
                                                    <a rel="nofollow" href="javascript:void(0);" onclick="javascript:product_submit({{ $course->id }});" class="btn btn-maincolor product_type_simple add_to_cart_button">
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                     @endif
                                </ul>

                            </div>

                        </form>

                        <div class="cart_totals ">


                            <h2>Cart totals</h2>

                            <table class="shop_table shop_table_responsive">

                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td data-title="Subtotal">
													<span class="amount">
														<span>£</span>{{ (isset($SubTotal)) ? $SubTotal : 0 }}.00
													</span>
                                    </td>
                                </tr>


                                <tr class="order-total">
                                    <th>Total</th>
                                    <td data-title="Total">
                                        <strong>
                        <span class="amount">
                            <span>£</span>{{ (isset($Total)) ? $Total : 0 }}.00
                        </span>
                                        </strong>
                                    </td>
                                </tr>


                                </tbody>
                            </table>

                            <div class="wc-proceed-to-checkout">

                                <a href="{{ URL::to('/reviewcart') }}" class="checkout-button btn btn-maincolor alt wc-forward">Proceed to checkout</a>
                            </div>


                        </div>
                    </div>


                </main>
            </div>
        </div>
    </section>

@endsection
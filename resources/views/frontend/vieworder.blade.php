@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Shop Single Order</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/reviewcart") }}">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Shop Single Order
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-30 s-pt-lg-95 s-pb-lg-75">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <article id="post-1708" class="post-1708 page type-page status-publish hentry">
                        <header class="entry-header">
                            <h1 class="entry-title">Order #{{ str_pad($OrderInfo->order_id, 4, '0', STR_PAD_LEFT) }}</h1>
                            {{--<span class="edit-link">--}}
                                {{--<a class="post-edit-link" href="#">Edit<span class="screen-reader-text"> "My account"</span></a>--}}
                            {{--</span>--}}
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')


                                <div class="woocommerce-MyAccount-content">
                                    <p>Order #
                                        <mark class="order-number">{{ str_pad($OrderInfo->order_id, 4, '0', STR_PAD_LEFT) }}</mark>
                                        was placed on
                                        <mark class="order-date">{{ Carbon\Carbon::parse($OrderInfo->created)->format('F d, Y') }}</mark>
                                        and is currently
                                        <mark class="order-status">{{ $OrderInfo->order_state }}</mark>
                                        .
                                    </p>


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
                                                <?php $ItemCount=1;?>
                                                @foreach($CartItems as $v)
                                                    <tr class="woocommerce-table__line-item order_item">
                                                        <td class="woocommerce-table__product-name product-name">
                                                            <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $v[1]))) }}">{{ $v[1] }} #<?php echo $ItemCount;?></a>
                                                            {{--<strong class="product-quantity">× {{ $v[2] }}</strong>--}}
                                                            <ul class="wc-item-downloads">
                                                                <li>
                                                                    <strong class="wc-item-download-label">Download:</strong>
                                                                    @if(App\Http\Controllers\Front\UserFrontController::GetCourseOnID($v[4])->pdf != NULL)<a href="{{ URL::to("/uploads/coursepdf/" . App\Http\Controllers\Front\UserFrontController::GetCourseOnID($v[4])->pdf) }}" target="_blank">File</a>@else <a href="javascript:void(0);">No PDF</a> @endif
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td class="woocommerce-table__product-total product-total">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>{{ $v[2]*$v[3] }}.00
                                                            </span>
                                                        </td>
                                                    </tr><?php $ItemCount++;?>
                                                @endforeach
                                            @endif
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">Subtotal:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>{{ ($SubTotal) ? $SubTotal : 0 }}.00</span>
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
																	<span class="woocommerce-Price-currencySymbol">$</span>{{ ($Total) ? $Total : 0 }}.00</span>
                                                </td>
                                            </tr>
                                            </tfoot>

                                        </table>


                                        <div class="order-again">
                                            <a href="{{ URL::to('/orderagain/' . $OrderInfo->id) }}" class="button btn btn-maincolor">Order again</a>
                                        </div>


                                        <section class="woocommerce-customer-details">

                                            <h4>Customer details</h4>

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
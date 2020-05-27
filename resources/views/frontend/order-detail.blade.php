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
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Shop</a>
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
                            <h1 class="entry-title">Order #1722</h1> <span class="edit-link">
										<a class="post-edit-link" href="#">Edit<span class="screen-reader-text"> "My account"</span>
										</a>
									</span>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')


                                <div class="woocommerce-MyAccount-content">
                                    <p>Order #
                                        <mark class="order-number">1722</mark>
                                        was placed on
                                        <mark class="order-date">March 8, 2018</mark>
                                        and is currently
                                        <mark class="order-status">Completed</mark>
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
                                            <tr class="woocommerce-table__line-item order_item">

                                                <td class="woocommerce-table__product-name product-name">
                                                    <a href="shop-product-right.html">Downloadable Product #1</a>
                                                    <strong class="product-quantity">× 1</strong>
                                                    <ul class="wc-item-downloads">
                                                        <li>
                                                            <strong class="wc-item-download-label">Download:</strong>
                                                            <a href="#">File</a>
                                                        </li>
                                                        <li>
                                                            <strong class="wc-item-download-label">Download:</strong>
                                                            <a href="#">File</a>
                                                        </li>
                                                    </ul>
                                                </td>

                                                <td class="woocommerce-table__product-total product-total">
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>12.00
																</span>
                                                </td>

                                            </tr>

                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">Subtotal:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>12.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Payment method:</th>
                                                <td>Cash on delivery</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>12.00</span>
                                                </td>
                                            </tr>
                                            </tfoot>

                                        </table>


                                        <div class="order-again">
                                            <a href="http://webdesign-finder.com/my-account/view-order/1722/?order_again=1722&amp;_wpnonce=8edf688805" class="button btn btn-maincolor">Order
                                                again</a>
                                        </div>


                                        <section class="woocommerce-customer-details">

                                            <h4>Customer details</h4>

                                            <table class="woocommerce-table woocommerce-table--customer-details shop_table customer_details">


                                                <tbody>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>admin@test.com</td>
                                                </tr>

                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>+1300551555</td>
                                                </tr>


                                                </tbody>
                                            </table>


                                            <h4 class="woocommerce-column__title">Billing address</h4>

                                            <address>
                                                John Doe<br>Baker Street, 231<br>London<br>Great Britain<br>12000
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
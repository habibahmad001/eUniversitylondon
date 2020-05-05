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
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Account Details
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
                            <h1 class="entry-title">Order received</h1>
                            <span class="edit-link">
										<a class="post-edit-link" href="#">Edit
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

                                        <li class="woocommerce-order-overview__order order">
                                            Order number: <strong>1719</strong>
                                        </li>

                                        <li class="woocommerce-order-overview__date date">
                                            Date: <strong>March 6, 2018</strong>
                                        </li>

                                        <li class="woocommerce-order-overview__total total">
                                            Total: <strong>
                        <span class="woocommerce-Price-amount amount">
                            <span
                                    class="woocommerce-Price-currencySymbol">$</span>45.00</span>
                                            </strong>
                                        </li>


                                        <li class="woocommerce-order-overview__payment-method method">
                                            Payment method: <strong>Cash on delivery</strong>
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
                                            <tr class="woocommerce-table__line-item order_item">

                                                <td class="woocommerce-table__product-name product-name">
                                                    <a href="shop-product-right.html">Premium Quality</a> <strong
                                                            class="product-quantity">× 1</strong>
                                                </td>

                                                <td class="woocommerce-table__product-total product-total">
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>12.00</span>
                                                </td>

                                            </tr>

                                            <tr class="woocommerce-table__line-item order_item">

                                                <td class="woocommerce-table__product-name product-name">
                                                    <a href="shop-product-right.html">Woo Ninja</a> <strong
                                                            class="product-quantity">× 1</strong>
                                                </td>

                                                <td class="woocommerce-table__product-total product-total">
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>15.00</span>
                                                </td>

                                            </tr>

                                            <tr class="woocommerce-table__line-item order_item">

                                                <td class="woocommerce-table__product-name product-name">
                                                    <a href="shop-product-right.html">Woo Album #3</a> <strong
                                                            class="product-quantity">× 2</strong>
                                                </td>

                                                <td class="woocommerce-table__product-total product-total">
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>18.00</span>
                                                </td>

                                            </tr>

                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">Subtotal:</th>
                                                <td>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>45.00</span>
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
																	<span class="woocommerce-Price-currencySymbol">$</span>45.00</span>
                                                </td>
                                            </tr>
                                            </tfoot>

                                        </table>


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
                                                John Doe<br>Baker Street, 231<br>London<br>United Kingdom<br>47000
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
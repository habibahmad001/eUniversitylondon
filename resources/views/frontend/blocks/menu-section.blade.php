<div class="header_absolute ds cover-background s-overlay">
    <!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->
    <header class="page_header ds justify-nav-center s-borderbottom container-px-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-4 col-md-5 col-11">
                    <a href="{{ URL::to('/') }}" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <span class="logo-text color-darkgrey"></span>
                    </a>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-7 col-1">
                    <div class="nav-wrap">
                        <!-- main nav start -->
                        <nav class="top-nav">
                            <ul class="nav sf-menu euniversity">

                                <li class="active">
                                    <div class="widget course-dropdown">
                                        <a class="dropdown-toggle" id="course-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Categories
                                        </a>
                                        <div class="dropdown-menu dropdown-multicol dropdown-menu-right ds" aria-labelledby="course-dropdown">
                                            <div class="row c-gutter-75">
                                                <div class=" col-lg-4 col-md-4 col-xs-12">
                                                    <?php $i=1;?>
                                                    @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                                        <a class="dropdown-item" href="{{ URL::to('/category/' . $catval->page_slug) }}">
                                                            <i class="fs-31 {{ $catval->selectedicon }}" aria-hidden="true"></i>
                                                            {{ $catval->category_title }}
                                                        </a>
                                                        <?php if($i%3 == 0) {?>
                                                            </div>
                                                            <div class=" col-lg-4 col-md-4 col-xs-12">
                                                        <?php }?>
                                                        <?php $i++;?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="widget widget_search">
                                        <form role="search" method="get" class="search-form" action="http://webdesign-finder.com/">
                                            <label for="search-form-top">
                                                <span class="screen-reader-text">Search for:</span>
                                            </label>
                                            <input type="search" id="search-form-top" class="search-field" placeholder="Search keyword" value="" name="search">
                                            <button type="submit" class="search-submit">
                                                <span class="screen-reader-text">Search</span>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <!-- eof pages -->




                            </ul>


                        </nav>
                        <!-- eof main nav -->
                        <!--hidding includes on small devices. They are duplicated in topline-->
                    </div>
                </div>
                @guest
                <div class="col-4 d-none d-xl-block">
                    <div class="top-includes main-includes">
                        <button type="button" class="sign-btn-form" data-toggle="modal" data-target="#form2"><i class="fw-900 s-16 fa fa-sign-in" aria-hidden="true"></i>Sign Up</button>
                        <button type="button" class="login-btn-form login_modal_window" data-toggle="modal" data-target="#form1"><i class="fs-16 fa fa-user" aria-hidden="true"></i>Login</button>
                    </div>
                </div>
                @endguest
                @auth
                <div class="col-4 d-none d-xl-block">
                    <div class="top-includes main-includes">
                        <div class="dropdown">
                            <a class="dropdown-toggle dropdown-shopping-cart" href="{{ URL::to("/cart") }}" role="button" id="dropdown-shopping-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-shopping-basket"></i>
                                <span class="badge bg-maincolor">3</span>
                                ${{ (App\Http\Controllers\Front\CartController::CartTotal()) ? App\Http\Controllers\Front\CartController::CartTotal() : 0 }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ls" aria-labelledby="dropdown-shopping-cart">
                                <div class="widget woocommerce widget_shopping_cart">
                                    <div class="widget_shopping_cart_content">

                                        <ul class="woocommerce-mini-cart cart_list product_list_widget">
                                            <li class="woocommerce-mini-cart-item mini_cart_item">
                                                <a href="#" class="remove" aria-label="Remove this item" data-product_id="73" data-product_sku="">×</a>
                                                <a href="shop-product-right.html">
                                                    <img src="images/shop/26.jpg" alt="">Tools of Trading: Modern Marketing
                                                </a>

                                                <span class="quantity">2 X
															<span class="woocommerce-Price-amount amount">
																<span class="woocommerce-Price-currencySymbol">$</span>
																30.00
															</span>
														</span>
                                            </li>
                                            <li class="woocommerce-mini-cart-item mini_cart_item">
                                                <a href="#" class="remove" aria-label="Remove this item" data-product_id="73" data-product_sku="">×</a>
                                                <a href="shop-product-right.html">
                                                    <img src="images/shop/21.jpg" alt="">Tools of Trading: Modern Marketing
                                                </a>

                                                <span class="quantity">2 X
															<span class="woocommerce-Price-amount amount">
																<span class="woocommerce-Price-currencySymbol">$</span>
																30.00
															</span>
														</span>
                                            </li>
                                        </ul>

                                        <p class="woocommerce-mini-cart__total total">
                                            <strong>Subtotal:</strong>
                                            <span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														27.00
													</span>
                                        </p>

                                        <p class="woocommerce-mini-cart__buttons buttons">
                                            <a href="{{ URL::to("/cart") }}" class="button btn btn-maincolor wc-forward">View cart</a>
                                            <a href="{{ URL::to("/reviewcart") }}" class="button checkout btn btn-outline-maincolor  wc-forward">Checkout</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                @endauth
            </div>
        </div>
        <!-- header toggler -->
        <span class="toggle_menu"><span></span></span>
    </header>
</div>
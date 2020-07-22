<section class="page_topline ds c-my-5 s-py-5 small-text">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-lg-left">
                <ul class="top-includes border-divided">
                    <li>
									<span class="social-icons">
										<a href="javascript:void(0);" class="fa fa-facebook color-icon border-icon rounded-icon" title="facebook"></a>
										<a href="javascript:void(0);" class="fa fa-twitter color-icon border-icon rounded-icon" title="twitter"></a>
										<a href="javascript:void(0);" class="fa fa-google color-icon border-icon rounded-icon" title="google"></a>
									</span>
                    </li>


                    <!-- <li class="dropdown-account">
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdown-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> My Account
                            </a>
                            <div class="dropdown-menu ls" aria-labelledby="dropdown-account">
                                <a href="#"><i class="fa fa-user"></i> My Account</a>
                                <a href="#"><i class="fa fa-heart-o"></i> Wishlist</a>
                                <a href="#"><i class="fa fa-shopping-basket"></i> Cart</a>
                                <a href="#"><i class="fa fa-edit"></i> Checkout</a>
                                <a href="#"><i class="fa fa-lock"></i> Logout</a>
                            </div>
                        </div>
                    </li> -->

                </ul>

            </div>
            <div class="col-md-6 text-center text-lg-right">
                <ul class="top-includes border-divided">
                    <li>
                        <a href="#"><i class="fa fa-comment"></i> Start live chat</a>
                    </li>
                    <li>
                        <i class="fa fa-phone color-darkgrey px-1"></i> <span class="color-main">1-800-123-4567</span>
                    </li>@auth
                    <li class="dropdown-account">
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdown-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> My Account
                            </a>
                            <div class="dropdown-menu ls" aria-labelledby="dropdown-account">
                                <a href="{{ URL::to("/dashboard") }}"><i class="fa fa-user"></i> My Account</a>
                                <!--a href="#"><i class="fa fa-heart-o"></i> Wishlist</a-->
                                <a href="{{ URL::to("/" . Auth::user()->user_type . "/home") }}"><i class="fa fa-user"></i>{{ Auth::user()->user_type }} Area</a>
                                <a href="{{ URL::to('/cart') }}"><i class="fa fa-shopping-basket"></i> Cart</a>
                                <!--a href="{{ URL::to('/reviewcart') }}"><i class="fa fa-edit"></i> Checkout</a-->
                                <a href="{{ URL::to('/logout') }}"><i class="fa fa-lock"></i> Logout</a>
                            </div>
                        </div>
                    </li>@endauth
                </ul>
            </div>
        </div>
    </div>
</section>
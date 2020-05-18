@extends("layouts.frontapp")
@section('content')

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
                            <a href="{{ URL::to("/cart") }}">Shop</a>
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


    <section class="ls s-pt-55 s-pb-60 s-pt-lg-95 s-pb-lg-100 shop-details">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <article>
                        <header class="entry-header">
                            <h4>Account details
                                <span class="edit-link">
                                    {{--<a class="post-edit-link" href="#">Edit--}}
                                        {{--<span class="screen-reader-text"> "My account"</span>--}}
                                    {{--</a>--}}
                                </span>
                            </h4>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')


                                <div class="woocommerce-MyAccount-content">

                                    <form class="woocommerce-EditAccountForm edit-account" action="#" method="post">


                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                            <label for="account_first_name">First name <span class="required">*</span>
                                            </label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="" placeholder="First name">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                            <label for="account_last_name">Last name <span class="required">*</span>
                                            </label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="" placeholder="Last name">
                                        </p>
                                        <div class="clear">

                                        </div>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="account_email">Email address <span class="required">*</span>
                                            </label>
                                            <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="" placeholder="Email address">
                                        </p>

                                        <fieldset>
                                            <h4 class="mb-20">Account details</h4>

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_current">Current password (leave blank to leave unchanged)</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" placeholder="Current password (leave blank to leave unchanged)">
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_1">New password (leave blank to leave unchanged)</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" placeholder="New password (leave blank to leave unchanged)">
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_2">Confirm new password</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" placeholder="Confirm new password">
                                            </p>
                                        </fieldset>
                                        <div class="clear"></div>
                                        <p>
                                            <input type="submit" class="woocommerce-Button button" name="save_account_details" value="Save changes">
                                        </p>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>
            </div>
            <div class="divider-3"></div>
        </div>
    </section>

@endsection
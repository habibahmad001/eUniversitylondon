@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Password Reset</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Password Reset
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-40 s-pt-lg-95 s-pb-lg-80">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    @if(session()->has('message'))
                        <div class="woocommerce-message">
                            {{ session()->get('message') }} @if(strpos(session()->get('message'), "removed") !== false) <a href="{{ URL::to("/undocart") }}">Undo?</a> @endif
                        </div>
                    @endif
                    <form class="woocommerce-ResetPassword lost_reset_password text-center" name="reset" id="reset" action="{{ URL::to("/resetemail") }}" method="post" onSubmit="return reset_validate('');">
                        {{ csrf_field() }}
                        <p>Lost your password? Please enter your username or email address. You will receive a link to create a new password
                            via email.</p>

                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                            <label for="account_email">Enter Email here</label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text text-center" type="email" name="account_email" id="account_email" placeholder="Enter email here">
                        </p>

                        <div class="clear"></div>


                        <p class="woocommerce-form-row form-row">
                            <input type="submit" class="woocommerce-Button button" value="Reset password">
                        </p>

                    </form>


                </main>
            </div>
        </div>
    </section>

@endsection
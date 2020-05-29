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
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/cart") }}">Shop</a>
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
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="woocommerce-ResetPassword lost_reset_password text-center" name="updatepass" id="updatepass" action="{{ URL::to("/updatepass") }}" method="post" onSubmit="return update_pass_validate('');">
                        {{ csrf_field() }}
                        <h4>Reset Password</h4>

                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                            <label for="account_email">New Password</label><input type="hidden" name="user_id" id="user_id" value="{{ $id }}">
                            <input class="woocommerce-Input woocommerce-Input--text input-text text-center" type="password" name="new_password" id="new_password" placeholder="Enter new password here">
                        </p>

                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                            <label for="account_email">Confirm Password</label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text text-center" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
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
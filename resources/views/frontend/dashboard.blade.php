@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Account - Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Account - Dashboard
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-60 s-pt-lg-95 s-pb-lg-100">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">

                    <article>
                        <header class="entry-header">
                            <h1 class="entry-title">My account</h1>
                            {{--<span class="edit-link">--}}
                                {{--<a class="post-edit-link" href="#">Edit--}}
                                    {{--<span class="screen-reader-text"> "My account"</span>--}}
                                {{--</a>--}}
                            {{--</span>--}}
                        </header><!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')


                                <div class="woocommerce-MyAccount-content">

                                    <p>Hello <strong>{{ $user->first_name }}</strong> (not <strong>admin</strong>? <a class="link-main" href="{{ URL::to("/logout") }}">Log
                                            out</a>)
                                    </p>

                                    <p>From your account dashboard you can view your <a class="link-main" href="{{ URL::to("/orders") }}">recent orders</a>,
                                        manage your <a class="link-main" href="{{ URL::to("/addressinfo") }}">shipping and billing addresses</a> and <a class="link-main" href="{{ URL::to("/accountdetail") }}">edit your password and account details</a>.
                                    </p>

                                </div>
                            </div>
                        </div><!-- .entry-content -->
                    </article>

                </main>

            </div>

        </div>
    </section>

@endsection
@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Proceed to PayPal</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/reviewcart") }}">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Proceed to PayPal
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

                    <div class="preloader_image"></div>

                    <center>Process to Paypal ...</center>
                    {{--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypalfrm" id="paypalfrm">--}}
                        {{--<input type="hidden" name="business" value="habibahmad84@yahoo.com">--}}
                        {{--<input type="hidden" name="cmd" value="_cart">--}}
                        {{--<input type="hidden" name="add" value="1">--}}
                        {{--<input type="hidden" name="item_name" value="ssss">--}}
                        {{--<INPUT TYPE="hidden" NAME="return" value="http://ims.freevar.com/detail.php">--}}
                        {{--<input type="hidden" name="amount" value="0.95">--}}
                        {{--<input type="hidden" name="currency_code" value="USD">--}}
                        {{--<input type="hidden" name="on0" value="Size">--}}
                    {{--</form>--}}

                    <form method="post" name="paypalfrm" id="paypalfrm" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                        <input type="hidden" name="cmd" value="_cart" />
                        <input type="hidden" name="upload" value="1" />
                        <input type="hidden" name="business" value="habibahmad84@yahoo.com" />
                        @if($CartItems != "emp")
                            <?php $count = 1;?>
                            @foreach($CartItems as $val)
                                <input type="hidden" name="item_name_<?php echo $count;?>" value="{{ $val[1] }}" />
                                <input type="hidden" name="quantity_<?php  echo $count;?>" value="{{ $val[2] }}" />
                                <input type="hidden" name="amount_<?php  echo $count;?>" value="0.01" />{{--{{ $val[3] }}--}}
                                    <?php $count++;?>
                            @endforeach
                        @endif
                        <input type="hidden" name="shipping_1" value="0.01" />
                        <input type="hidden" name="handling_1" value="0.01" />
                        <input type="hidden" name="tax_1" value="0.01" />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="return" value="{{ URL::to('/paypalsuccess') }}" />
                        <input type="hidden" name="cancel_return" value="{{ URL::to('/404') }}" />
                        <input type="hidden" name="lc" value="test lc country" />
                    </form>

                </main>
            </div>
        </div>
    </section>

@endsection
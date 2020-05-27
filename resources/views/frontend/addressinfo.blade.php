@extends("layouts.frontapp")
@section('content')

    <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
        <div class="divider-50"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h1>Shop - Addresses</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to("/") }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to("/reviewcart") }}">Shop</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Shop - Addresses
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </section>


    <section class="ls s-pt-55 s-pb-50 s-pt-lg-95 s-pb-lg-100">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <article>
                        @if(session()->has('message'))
                            <div class="woocommerce-message">
                                {{ session()->get('message') }} @if(strpos(session()->get('message'), "removed") !== false) <a href="{{ URL::to("/undocart") }}">Undo?</a> @endif
                            </div>
                        @endif
                        <header class="entry-header">
                            <h1 class="entry-title">Addresses</h1>
                            {{--<span class="edit-link">--}}
                                {{--<a class="post-edit-link" href="#">Edit--}}
                                    {{--<span class="screen-reader-text"> "My account"--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                            {{--</span>--}}
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')

                                <div class="woocommerce-MyAccount-content">
                                    <p>
                                        The following addresses will be used on the checkout page by default.
                                    </p>

                                    <form id="updateinfo" class="cart-login" method="POST" action="{{ URL::to("/saveaddress") }}" onSubmit="return shipping_address_validate('');">
                                        {{ csrf_field() }}

                                    <div class="u-columns woocommerce-Addresses col2-set addresses">


                                        <div class="u-column1 col-1 woocommerce-Address">
                                            <header class="woocommerce-Address-title title">
                                                <h4 class="woocommerce-title">Billing address</h4>
                                                <a href="javascript:void(0);" id="b_edit" class="edit">Edit</a>
                                            </header>
                                            <address>
                                                @if(count($addressData) > 0)
                                                    <p data-msg="b_msg">
                                                        {{(isset($addressData[0]->b_street_address)) ? $addressData[0]->b_street_address : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->b_country)) ? App\Http\Controllers\Front\CartController::GetCountryName($addressData[0]->b_country)->country_name : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->b_state)) ? App\Http\Controllers\Front\CartController::GetStateName($addressData[0]->b_state)->state_name : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->b_city)) ? $addressData[0]->b_city : ""}}
                                                        <br>
                                                        {{(isset($addressData[0]->b_zip)) ? $addressData[0]->b_zip : ""}}
                                                    </p>
                                                @else
                                                    <p data-msg="b_msg">
                                                        You have not set up this type of address yet.
                                                    </p>
                                                @endif
                                            </address>
                                            <address style="display: none;" id="b_info">
                                                <div class="form-group has-placeholder">
                                                    <label for="street">Street Address:</label>
                                                    <input type="text" class="form-control" id="street" value="{{(isset($addressData[0]->b_street_address)) ? $addressData[0]->b_street_address : old('street')}}" placeholder="Home & Street address (i.e Baker Street, 231)" name="street">
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <select name="count" id="count" onchange="javascript:pickstate($(this).val());">
                                                        <option value="">Select Country</option>
                                                        @if(count($Country) > 0)
                                                            @foreach($Country as $val)
                                                                <option value="{{ $val->id }}" {{(isset($addressData[0]->b_country) && $addressData[0]->b_country == $val->id) ? "selected" : old('count')}}>{{ $val->country_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <select name="stat" id="stat">
                                                        <option value="">Select State</option>
                                                        @if(count($State) > 0)
                                                            @foreach($State as $val)
                                                                <option value="{{ $val->id }}" {{(isset($addressData[0]->b_state) && $addressData[0]->b_state == $val->id) ? "selected" : old('stat')}}>{{ $val->state_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <label for="city">City:</label>
                                                    <input type="text" class="form-control" id="city" placeholder="City (i.e Florida)" value="{{(isset($addressData[0]->b_city)) ? $addressData[0]->b_city : old('city')}}" name="city">
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <label for="zip">Zip Code:</label>
                                                    <input type="text" class="form-control" id="zip" placeholder="Zip Code (i.e 12000)" value="{{(isset($addressData[0]->b_zip)) ? $addressData[0]->b_zip : old('zip')}}" name="zip">
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <input type="checkbox" class="form-control" id="same" name="same" style="width: 18px; display: inline-block; height: 15px;" value="1"> <div class="sameclass" style="display: inline-block;">Same as billing info.</div>
                                                </div>
                                                <button type="submit" class="btn btn-maincolor log-btn">Save</button>
                                            </address>
                                        </div>

                                        <div class="u-column2 col-2 woocommerce-Address">
                                            <header class="woocommerce-Address-title title">
                                                <h4 class="woocommerce-title">Shipping address</h4>
                                                <a href="javascript:void(0);" id="s_edit" class="edit">Edit</a>
                                            </header>
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
                                            <address style="display: none;" id="s_info">
                                                <div class="form-group has-placeholder">
                                                    <label for="street">Street Address:</label>
                                                    <input type="text" class="form-control" id="s_street" value="{{(isset($addressData[0]->s_street_address)) ? $addressData[0]->s_street_address : old('s_street')}}" placeholder="Home & Street address (i.e Baker Street, 231)" name="s_street">
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <select name="s_count" id="s_count" onchange="javascript:pickstate($(this).val(), 's_count');">
                                                        <option value="">Select Country</option>
                                                        @if(count($Country) > 0)
                                                            @foreach($Country as $val)
                                                                <option value="{{ $val->id }}" {{(isset($addressData[0]->s_country) && $addressData[0]->s_country == $val->id) ? "selected" : old('s_count')}}>{{ $val->country_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <select name="s_stat" id="s_stat">
                                                        <option value="">Select State</option>
                                                        @if(count($State) > 0)
                                                            @foreach($State as $val)
                                                                <option value="{{ $val->id }}" {{(isset($addressData[0]->s_state) && $addressData[0]->s_state == $val->id) ? "selected" : old('s_stat')}}>{{ $val->state_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <label for="city">City:</label>
                                                    <input type="text" class="form-control" id="s_city" placeholder="City (i.e Florida)" value="{{(isset($addressData[0]->s_city)) ? $addressData[0]->s_city : old('s_city')}}" name="s_city">
                                                </div>
                                                <div class="form-group has-placeholder">
                                                    <label for="zip">Zip Code:</label>
                                                    <input type="text" class="form-control" id="s_zip" placeholder="Zip Code (i.e 12000)" value="{{(isset($addressData[0]->s_zip)) ? $addressData[0]->s_zip : old('s_zip')}}" name="s_zip">
                                                </div>
                                                <button type="submit" class="btn btn-maincolor log-btn">Save</button>
                                            </address>
                                        </div>


                                    </form>


                                    </div>

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
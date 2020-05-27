@extends("layouts.frontapp")
@section('content')

    <!-- template sections -->
    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">

            <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
                <div class="divider-50"></div>
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <h1>Shop Orders</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL::to("/") }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ URL::to("/cart") }}">Shop</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Shop Orders
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
                    <article id="post-1708" class="post-1708 page type-page status-publish hentry">
                        <header class="entry-header">
                            <h4>Orders</h4>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('frontend.blocks.usernav')

                                <div class="d-block d-md-none divider-120"></div>


                                <div class="woocommerce-MyAccount-content">
                                    @if ($errors->any())
                                    <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                                        <a class="woocommerce-Button button btn btn-outline-maincolor" href="{{ URL::to("/cart") }}">Go shop </a>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                    @endif
                                    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                        <thead>
                                        <tr>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">Order</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">Date</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">Status</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total"><span class="nobr">Total</span></th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions text-center"><span class="nobr">Actions</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if(count($Orders) > 0)
                                            @foreach($Orders as $val)
                                                <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order">
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
                                                        <a href="{{ URL::to("/vieworder/" . $val->id) }}">
                                                            #{{ str_pad($val->order_id, 4, '0', STR_PAD_LEFT) }} </a>

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="Date">
                                                        <time datetime="2018-03-06T08:55:39+00:00">{{ Carbon\Carbon::parse($val->created)->format('F d, Y') }}</time>

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="Status">
                                                        {{ $val->order_state }}
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="Total">
                                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>{{ ($TotalPrice[$val->id]) ? $TotalPrice[$val->id] : 0 }}.00</span> for {{ $val->order_items }} items
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions text-right" data-title="Actions">
                                                        <a href="{{ URL::to("/vieworder/" . $val->id) }}" class="woocommerce-button btn btn-outline-maincolor view">View</a> </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order">
                                                <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" colspan="5" data-title="Order">
                                                    No record found !!!

                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><!-- .entry-content -->
                    </article>
                </main>
            </div>
        </div>
    </section>

@endsection
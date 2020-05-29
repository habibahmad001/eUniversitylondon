<nav class="woocommerce-MyAccount-navigation ls ms">
    <ul>
        <li @if(collect(request()->segments())->last()=='dashboard') class="is-active" @endif>
            <a href="{{ URL::to("/dashboard") }}">
                <p>Dashboard</p>
            </a>
        </li>
        <li @if(collect(request()->segments())->last()=='orders' or collect(request()->segments())->last()=='vieworder') class="is-active" @endif>
            <a href="{{ URL::to("/orders") }}">
                <p>Orders</p>
            </a>
        </li>

        <li @if(collect(request()->segments())->last()=='addressinfo') class="is-active" @endif>
            <a href="{{ URL::to("/addressinfo") }}">
                <p>Addresses</p>
            </a>
        </li>
        <li @if(collect(request()->segments())->last()=='accountdetail') class="is-active" @endif>
            <a href="{{ URL::to("/accountdetail") }}">
                <p>Account details</p>
            </a>
        </li>
        <li @if(collect(request()->segments())->first()=='updatepass') class="is-active" @endif>
            <a href="{{ URL::to("/updatepass/" . Auth::user()->id) }}">
                <p>Update Password</p>
            </a>
        </li>
        <li>
            <a href="{{ URL::to("/logout") }}">
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
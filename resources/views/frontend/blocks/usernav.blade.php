<nav class="woocommerce-MyAccount-navigation ls ms">
    <ul>
        <li>
            <a href="{{ URL::to("/dashboard") }}">
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="{{ URL::to("/orders") }}">
                <p>Orders</p>
            </a>
        </li>

        <li class="is-active">
            <a href="{{ URL::to("/addressinfo") }}">
                <p>Addresses</p>
            </a>
        </li>
        <li>
            <a href="{{ URL::to("/accountdetail") }}">
                <p>Account details</p>
            </a>
        </li>
        <li>
            <a href="{{ URL::to("/logout") }}">
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
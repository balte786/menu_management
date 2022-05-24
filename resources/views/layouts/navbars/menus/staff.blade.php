<ul class="navbar-nav">
    @if(config('app.ordering'))
    @if(in_array("poscloud", config('global.modules',[])))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i> {{ __('POS') }}
        </a>
    </li>
    @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.restaurants.edit',  auth()->user()->restorant->id) }}">
                <i class="ni ni-shop text-info"></i> {{ __('Restaurant') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('categories')}}">
                <i class="ni ni-collection text-pink"></i>Categories
            </a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="ni ni-collection text-pink"></i> {{ __('Menu') }}
        </a>
    </li>
    <!--<li class="nav-item">
        <a class="nav-link" href="/live">
            <i class="ni ni-basket text-success"></i> {{ __('Live Orders') }}
            <div class="blob red"></div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="ni ni-basket text-orangse"></i> {{ __('Orders') }}
        </a>
    </li>
-->
    @endif

</ul>
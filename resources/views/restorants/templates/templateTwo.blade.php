@extends('layouts.templates', ['class' => ''])

@section('extrameta')
<title>{{ $restorant->name }}</title>
<meta property="og:image" content="{{ $restorant->logom }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="590">
<meta property="og:image:height" content="400">
<meta name="og:title" property="og:title" content="{{ $restorant->name }}">
<meta name="description" content="{{ $restorant->description }}">
@endsection

@section('content')
<?php
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>
{{--@include('restorants.partials.modals')--}}


<script src="https://bestwebcreator.com/cafebiz/demo/assets/js/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<style type="text/css">
    .layout-section .container {
        z-index: 6;
    }

    .nav-tabs {
        border: 0;
    }

    .nav-tabs .nav-item {
        position: relative;
    }

    ul,
    li,
    ol {
        margin: 0;
        padding: 0;
    }

    a:hover,
    .navbar .navbar-nav>li>a.active,
    .navbar .navbar-nav>li:hover>a .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link.active,
    .nav-tabs .nav-link.active:hover {
        color: #e8272e;
    }

    .nav-tabs li.nav-item a {
        background-color: transparent;
        border: 0;
        color: #181818;
        font-size: 16px;
        font-weight: 500;
        text-align: center;
        text-transform: capitalize;
        padding: 5px 25px;
    }

    .nav-tabs li.nav-item::before {
        content: "/";
        position: absolute;
        right: -2px;
        top: 50%;
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        color: #cacaca;
    }

    .tab-content {
        margin-top: 10px;
    }

    .list_border {
        position: relative;
    }

    .menu_list {
        margin-right: -15px;
        margin-left: -15px;
        display: table;
    }

    .list_border::before {
        content: "";
        position: absolute;
        left: 0;
        top: 70px;
        height: -webkit-calc(100% - 120px);
        height: -moz-calc(100% - 120px);
        height: calc(100% - 120px);
        width: 1px;
        background-color: #ddd;
        right: 0;
        margin: 0 auto;
    }

    .menu_list li {
        padding: 0 15px;
        float: left;
        width: 50%;
    }

    .list_none li {
        list-style: none;
    }

    .menu_list li:nth-child(2n+1) .single_menu_product,
    .menu_list li:nth-child(2n+1) .menu_title_price {
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse;
    }

    .single_menu_product {
        display: -ms-flexbox;
        display: flex;
        margin-top: 30px;
    }

    .menu_list li:nth-child(2n+1) .menu_product_img {
        margin-right: 0;
        position: relative;
        padding-left: 0;
        padding-right: 10px;
        margin-left: 15px;
    }

    .menu_product_img {
        margin-right: 15px;
        position: relative;
        padding-left: 10px;
    }

    .menu_list li:nth-child(2n+1) .menu_product_img::before {
        left: 10px;
    }

    .menu_product_img::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        border: white;
        width: 90px;
        height: 90px;
        border-radius: 100%;
        transition: all 0.5s ease-in-out;
    }

    .menu_product_img img {
        border-radius: 100%;
        position: relative;
        max-width: 100px;
    }

    .menu_list li:nth-child(2n+1) .single_menu_product .menu_product_img::after {
        left: 0px;
    }

    .single_menu_product .menu_product_img::after {
        background-color: rgba(232, 39, 46, 0.7);
    }

    .single_menu_product .menu_product_img::after {
        content: "";
        position: absolute;
        left: 10px;
        right: 0;
        bottom: 0;
        top: 0;
        background-color: rgba(232, 39, 47, 0.7);
        height: 90px;
        width: 90px;
        border-radius: 100%;
        transition: all 0.5s ease-in-out;
        -moz-transform: scale(0);
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    .single_menu_product .menu_product_img::after {
        background-color: rgba(232, 39, 46, 0.7);
    }


    .menu_list li:nth-child(2n+1) .menu_product_info {
        text-align: right;
    }

    .menu_product_info {
        width: 100%;
    }

    .menu_list li:nth-child(2n+1) .single_menu_product,
    .menu_list li:nth-child(2n+1) .menu_title_price {
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse;
    }

    .menu_title_price {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .menu_title * {
        transition: all 0.5s ease-in-out;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #292b2c;
        font-family: 'Courgette', cursive;
    }

    .menu_price span {
        color: #292b2c;
        font-family: 'Courgette', cursive;
        font-size: 16px;
        transition: all 0.5s ease-in-out;
    }

    .menu_list {
        margin-right: -15px;
        margin-left: -15px;
        display: table;
    }

    .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }
</style>

<section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block">
    <!-- Circles background -->
    <img class="bg-image" loading="lazy" src="{{ $restorant->coverm }}" style="width: 100%;">
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>

<section class="section pt-lg-0 mb--3 mt--9 d-none d-md-none d-lg-block d-lx-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title white" <?php if ($restorant->description) {
                                                echo 'style="border-bottom: 1px solid #f2f2f2;"';
                                            } ?>>
                    <h1 class="display-3 text-white notranslate" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;">{{ $restorant->name }}</h1>
                    <p class="display-4" style="margin-top: 120px">{{ $restorant->description }}</p>

                    <p><i class="ni ni-watch-time"></i> @if(!empty($openingTime))<span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>@endif @if(!empty($closingTime))<span class="opened_time">{{__('Opened until')}} {{ $closingTime }}</span> @endif | @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}"><span class="notranslate">{{ $restorant->address }}</span></a> | @endif @if(!empty($restorant->phone)) <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> @endif</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('partials.flash')
            </div>
            @if (auth()->user()&&auth()->user()->hasRole('admin'))
            @include('restorants.admininfo')
            @endif
        </div>
    </div>

</section>

<section class="layout-section">

    <input type="hidden" id="rid" value="{{ $restorant->id }}" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="menu_content">
                    <ul class="nav nav-tabs justify-content-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.03s" role="tablist" style="animation-delay: 0.03s; opacity: 1;">
                        <?php $j = 0; ?>

                        @foreach ( $restorant->categories as $key => $category)
                        @if($category->active == 1)

                        @if(!$category->aitems->isEmpty())

                        <li class="nav-item">
                            <a class="nav-link <?php if ($j == 0) echo 'active'; ?>" id="{{ ''.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" data-toggle="tab" href="#{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" role="tab" aria-controls="breakfast" aria-selected="true">{{ $category->name }}</a>
                        </li>

                        @endif
                        <?php
                        $j++;
                        ?>
                        @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">

                        <?php $i = 0; ?>

                        @if(!$restorant->categories->isEmpty())
                        @foreach ( $restorant->categories as $key => $category)
                        @if($category->active == 1)
                        @if(!$category->aitems->isEmpty())


                        <div class="tab-pane <?php if ($i == 0) echo 'active show';
                                                else echo 'fade';  ?>" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" role="tabpane1">
                            <ul class="list_none menu_list list_border animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.04s" style="animation-delay: 0.04s; opacity: 1;">
                                @foreach ($category->aitems as $item)
                                <li>
                                    <div class="single_menu_product">
                                        <div class="menu_product_img">
                                            @if(!empty($item->image))
                                            <img src="{{ $item->logom }}" style="width:100px; height:90px; object-fit:cover;">
                                            @endif

                                        </div>
                                        <div class="menu_product_info">
                                            <div class="menu_title_price">
                                                <div class="menu_title">
                                                    <h6>{{ $item->name }}</h6>
                                                </div>
                                                <div class="menu_price">
                                                    <span>@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                                </div>
                                            </div>
                                            <p>{{ $item->short_description}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>


                        @endif
                        <?php
                        $i++;
                        ?>
                        @endif
                        @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
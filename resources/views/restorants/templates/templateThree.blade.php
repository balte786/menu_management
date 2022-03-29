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
@include('restorants.partials.modals')

<style type="text/css">
    body {
        margin: 0px;
        padding: 0px;
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 15px;
        line-height: 24px;
        color: #959393;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    .menu-fix-item {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin: 0 0 55px 0;
    }

    img {
        max-width: 100%;
    }

    .title {
        display: inline-block;
        width: 100%;
        margin-bottom: 50px;
    }

    .text-dark {
        color: #20202f;
    }

    h2 {
        font-size: 40px;
        font-weight: 700;
        line-height: normal;
    }

    h6 {
        font-size: 15px;
        font-family: 'Graviola-Regular';
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0 0 20px 0;
        font-family: 'Quicksand', sans-serif;
    }

    .menu-fix-list {
        float: left;
        width: 100%;
        margin-bottom: 40px;
        position: relative;
    }

    .menu-fix h5 {
        color: #372727;
        font-size: 18px;
        position: relative;
        border-bottom: 1px dashed #cccccc;
        padding-bottom: 25px;
        padding-right: 60px;
    }

    .menu-fix h5 span {
        position: absolute;
        right: 0px;
        top: 0px;
        color: #e4b95b;
    }

    p {
        margin: 0 0 25px 0;
    }
</style>

<script src="https://bestwebcreator.com/cafebiz/demo/assets/js/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="https://bestwebcreator.com/cafebiz/demo/assets/bootstrap/css/bootstrap.min.css">
<script src="https://bestwebcreator.com/cafebiz/demo/assets/bootstrap/js/bootstrap.min.js"></script>


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

<section class="section pt-lg-0 mb--5 mt--9 d-none d-md-none d-lg-block d-lx-block">
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
<section class="section section-lg d-md-block d-lg-none d-lx-none" style="padding-bottom: 0px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.flash')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="title">
                    <h1 class="display-3 text notranslate" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;">{{ $restorant->name }}</h1>
                    <p class="display-4 text">{{ $restorant->description }}</p>
                    <p><i class="ni ni-watch-time"></i> @if(!empty($openingTime))<span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>@endif @if(!empty($closingTime))<span class="opened_time">{{__('Opened until')}} {{ $closingTime }}</span> @endif @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}">{{ $restorant->address }}</a> | @endif @if(!empty($restorant->phone)) <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> @endif</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="default-section menu-fix" id="restaurant-content">

    <input type="hidden" id="rid" value="{{ $restorant->id }}">
    <div class="container">

        <div class="menu-fix-main-list wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="700ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 700ms; animation-name: fadeInDown;">
            @if(!$restorant->categories->isEmpty())

            @foreach ( $restorant->categories as $key => $category)
            @if ($category->children)
            @if($category->active == 1)
            <!-- <div class="menu-fix-item">
                <img src="{{ asset('uploads/categories/' . $category->category_img) }}" class="mx-auto d-block" alt="">
            </div> -->
            @foreach ($category->children as $child)
            <div class="title text-center" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                <h2 class="text-dark" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $child->name }}</h2>
                <!-- <h6>The role of a good cook ware in the preparation of a sumptuous meal cannot be over emphasized then one consider white bread</h6> -->
            </div>

            <div class="row">
                @foreach ($child->aitems as $item)
                <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInDown animated" data-wow-duration="1000ms" data-wow-delay="700ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 700ms; animation-name: fadeInDown;">
                    <div class="menu-fix-list">
                        <h5>{{ $item->name }} <span>@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span></h5>
                        <p>{{ $item->short_description}}</p>
                    </div>
                </div>

                @endforeach
            </div>
            @endforeach
            @endif
            @endif
            @endforeach

            @else
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <p class="text-muted mb-0">{{ __('Hmmm... Nothing found!')}}</p>
                    <br /><br /><br />
                    <div class="text-center" style="opacity: 0.2;">
                        <img src="https://www.jing.fm/clipimg/full/256-2560623_juice-clipart-pizza-box-pizza-box.png" width="200" height="200"></img>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
</body>
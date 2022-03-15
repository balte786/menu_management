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
        font-family: 'Archivo', sans-serif;
        font-size: 15px;
        font-weight: normal;
        color: #b8b8b8;
        font-style: normal;
        line-height: 25px;
        background: #111111;
    }

    .populer-meal ul {}

    ul {
        margin: 0px;
        padding: 0px;
    }

    .populer-meal li {
        display: inline-block;
        width: 49.8%;
        margin-bottom: 30px;
    }

    li {
        list-style: none;
    }

    .meal-container {
        display: flex;
    }

    .meal-container div {
        padding: 10px;
    }

    .img,
    img {
        max-width: 100%;
        transition: all 0.3s ease-out 0s;
    }

    .meal-content,
    .meal-container .line,
    .meal-price {
        margin-top: 15px;
    }

    .meal-content h5 {
        font-size: 24px;
    }

    a,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span {
        overflow-wrap: break-word;
    }

    p {
        line-height: 25px;
        margin-bottom: 15px;
    }

    .meal-container .line {
        width: 12%;
        padding: 0 !important;
    }

    .meal-container .line hr {
        color: #fff;
        border: none;
        border-top-color: currentcolor;
        border-top-style: none;
        border-top-width: medium;
        border-top: 2px dashed;
    }

    hr {
        border-bottom: 1px solid #eceff8;
        border-top: 0 none;
        margin: 30px 0;
        padding: 0;
    }

    .meal-price a {
        width: 100%;
        float: left;
        text-align: center;
        background: #ffce1c;
        color: #111;
        padding: 10px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 30px;
    }

    .meal-price span {
        width: 100%;
        text-align: center;
        display: inline-block;
        margin-top: 10px;
        text-decoration: line-through;
        font-size: 16px;
        font-weight: 600;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Oswald', sans-serif;
        color: #fff;
        margin-top: 0px;
        font-style: normal;
        font-weight: 700;
        text-transform: normal;
    }

    h1 a,
    h2 a,
    h3 a,
    h4 a,
    h5 a,
    h6 a {
        color: inherit;
    }


    element.style {}

    .breadcrumb-title h2 {
        font-size: 60px;
        margin-bottom: 25px;
        line-height: 1;
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

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title mt-100 mb-30">
                        <h2>Our Menu</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
                <div class="populer-meal">
                    <ul>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="meal-container">
                                <div class="meal-img">
                                    <img src="image2.png" alt="img">
                                </div>
                                <div class="meal-content">
                                    <h5>
                                        <a href="#">CRISPY FRIED CHICKEN</a>
                                    </h5>
                                    <p>Hot, Big, Full Plater, Cosmos</p>
                                </div>
                                <div class="line">
                                    <hr>
                                </div>
                                <div class="meal-price">
                                    <a href="#">$13.00</a>
                                    <span>$19.00</span>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>


    </div>

</body>
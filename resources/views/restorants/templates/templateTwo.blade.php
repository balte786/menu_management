<!-- @extends('layouts.front', ['class' => '']) -->
<!-- 
@section('extrameta')
<title>{{ $restorant->name }}</title>
<meta property="og:image" content="{{ $restorant->logom }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="590">
<meta property="og:image:height" content="400">
<meta name="og:title" property="og:title" content="{{ $restorant->name }}">
<meta name="description" content="{{ $restorant->description }}">
@endsection -->

<!-- @section('content') -->
<?php
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>
@include('restorants.partials.modals')
<section class="section pt-lg-0" id="restaurant-content" style="padding-top: 0px">
    <input type="hidden" id="rid" value="{{ $restorant->id }}" />
    <div class="container container-restorant" id="pdf_section">
        <h1 style="padding-top:40px; text-align:center; font-weight: bold;">Our Menu</h1>


        @if(!$restorant->categories->isEmpty())
        <nav class="tabbable sticky" style="top: {{ config('app.isqrsaas') ? 64:88 }}px;">

            <ul class="nav nav-pills bg-white mb-2">
                <li class="nav-item nav-item-category ">
                    <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href="">{{ __('All categories') }}</a>
                </li>

                @foreach ( $restorant->categories as $key => $category)
                @if(!$category->aitems->isEmpty())

                @if($category->active == 1)
                <li class="nav-item nav-item-category test" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                    <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" role="tab" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $category->name }}</a>
                </li>
                @endif
                @endif
                @endforeach
            </ul>


        </nav>


        @endif




        @if(!$restorant->categories->isEmpty())
        @foreach ( $restorant->categories as $key => $category)
        @if ($category->children)
        @if($category->active == 1)
        @foreach ($category->children as $child)
        <div id="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" class="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
            <div>
                <h2 style="font-weight:bold;">{{ $child->name }}</h2><br />
            </div>
            <div class="row">
                @foreach ($child->aitems as $item)
                <div class="col-xl-6 main-wrap">
                    <div class="card text-white" style="display: flex; border:none;">
                        @if(!empty($item->image))
                        <figure>
                            <a href=""><img src="{{ $item->logom }}" class="cardImg"></a>
                        </figure>
                        @endif
                        <div class="card-img-overlay" style="color: white; font-weight: bold; text-align: center; padding-top:140px;">
                            <div class="card-title">
                                <h2><b><a href="javascript:void(0)" style="color:white">{{ $item->name }}</a></b></h2>
                            </div>
                            <div class="card-text">{{ $item->short_description}}</div><br>
                            <div class="row" style="color: white; font-weight: bold; text-align: center;">
                                <div class="card-text">
                                    <h4 style="color: white; font-weight: bold; padding-left:250px">@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                @endforeach

            </div>
        </div>



        @endforeach
        @endif
        @else
        <div id=" {{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" class="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
            <h1></h1><br />
        </div>
        @endif
        @endforeach
        @else
        @endif
        <!-- Check if is installed -->
        @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp)

        <!-- Check if there is value -->
        @if (strlen($restorant->getConfig('impressum_value',''))>5)
        <h3>{{$restorant->getConfig('impressum_title','')}}</h3>
        <?php echo $restorant->getConfig('impressum_value', ''); ?>
        @endif
        @endif

    </div>




</section>
<!-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-2">
                        <h4 class="text-center mt-2 mb-3">{{ __('Call Waiter') }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('call.waiter') }}">
                            @csrf
                            @include('partials.fields',$fields)
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Call Now') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- @endsection -->
<!-- @if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector)
@include('googletranslate::buttons')
@endif
@if ($showLanguagesSelector)
@section('addiitional_button_1')
<div class="dropdown web-menu">
    <a href="#" class="btn btn-neutral dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
        <img src="{{ asset('images') }}/icons/flags/{{ strtoupper(config('app.locale'))}}.png" /> {{ $currentLanguage }}
<!-- </a> -->
<!-- <ul class="dropdown-menu" aria-labelledby=""> -->
<!-- @foreach ($restorant->localmenus()->get() as $language) -->
<!-- @if ($language->language!=config('app.locale')) -->
<!-- <li>
            <a class="dropdown-item" href="?lang={{ $language->language }}">
                <img src="{{ asset('images') }}/icons/flags/{{ strtoupper($language->language)}}.png" /> {{$language->languageName}}
<!-- </a> -->
<!-- </li>  -->
<!-- @endif
        @endforeach -->
<!-- </ul> -->
<!-- </div> -->
<!-- @endsection -->
@endif

@section('js')
<script>
    var CASHIER_CURRENCY = "<?php echo  config('settings.cashier_currency') ?>";
    var LOCALE = "<?php echo  App::getLocale() ?>";
    var IS_POS = false;
    var TEMPLATE_USED = "<?php echo config('settings.front_end_template', 'defaulttemplate') ?>";
</script>
<script src="{{ asset('custom') }}/js/order.js"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
    function generatePdf() {

        var HTML_Width = $("#pdf_section").width();
        var HTML_Height = $("#pdf_section").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width + 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($(".html-content")[0]).then(function(canvas) {
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
            }
            pdf.save("Your_PDF_Name.pdf");
            $("#pdf_section").hide();
        });
    }
</script>

@include('restorants.phporderinterface')
<!-- @if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector)
@include('googletranslate::scripts')
@endif
@endsection

@if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector) -->
@section('head')
<!-- Style  Google Translate -->
<link type="text/css" href="{{ asset('custom') }}/css/gt.css" rel="stylesheet">
@endsection
@endif
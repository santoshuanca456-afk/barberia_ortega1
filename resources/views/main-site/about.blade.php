@extends('layouts.main-site')

@push('styles')
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="/assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="/assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="/assets/color/theme-red.css">
@endpush

@push('scripts')
    <!-- Latest jQuery --> 
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="/assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="/assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="/assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="/assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="/assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="/assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="/assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="/assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="/assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="/assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="/assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endpush


@section('title', 'Nosotros')


@section('header')
    <!-- START HEADER -->
        <header class="header_wrap fixed-top header_with_topbar light_skin main_menu_uppercase">
        <div class="container">
            @include('partials.nav')
        </div>
    </header>
    <!-- END HEADER -->
@endsection


@section('content')

        <!-- START SECTION BREADCRUMB -->
        <div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="/assets/images/about_bg.jpg">
            <div class="container"><!-- STRART CONTAINER -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title">
                            <h1>Nosotros</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Nosotros</li>
                        </ol>
                    </div>
                </div>
            </div><!-- END CONTAINER-->
        </div>
        <!-- END SECTION BREADCRUMB -->

<!-- START SECTION ABOUT -->
<div class="section">
	<div class="container">
    	<div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about_box box_shadow1">
                    <div class="heading_s1">
                        <span class="sub_heading font_style1">Nosotros</span>
                        <h2>{{ config('site.name') }}</h2>
                    </div>
                    <p>Bienvenido a {{ config('site.name') }}, donde llevamos los sabores vibrantes y ricos de la cocina de África Occidental a tu mesa. Nuestra especialidad, el Suya, es una delicia ahumada y picante que seguramente deleitará tu paladar.</p>
                    <p>En {{ config('site.name') }}, estamos dedicados a servir platos auténticos e innovadores elaborados con los ingredientes más frescos. ¡Ven y experimenta lo mejor de la tradición culinaria de África Occidental con nosotros!</p>
                </div>
            </div>
            
        	<div class="col-lg-6">	
                <div class="fancy_style1 overlay_bg_20">
                    <img src="/assets/images/about_img5.jpg" alt="about_img5" />
                    <a href="https://www.youtube.com/watch?v=ZE2HxTmxfrI" class="btn btn-ripple ripple_center video_popup animation" data-animation="fadeInUp" data-animation-delay="0.6s"><span class="ripple"><i class="ion-play"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION ABOUT --> 
        <!-- START SECTION CTA -->
        <div class="section background_bg" data-img-src="/assets/images/cta_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <div class="heading_s1 heading_light">
                            <span class="sub_heading font_style1">Experimenta los Sabores Auténticos</span>
                            <h2>{{ config('site.name') }}: Un Sabor de Tradición</h2>
                        </div>
                        <p class="text-white">Embárcate en un viaje culinario con {{ config('site.name') }}, donde celebramos los sabores ricos y diversos de África Occidental. Nuestro Suya signature, elaborado con una mezcla de especias tradicionales, ofrece una experiencia gastronómica única e inolvidable.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION CTA -->


<!-- START SECTION FEATURES -->
<div class="section pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Comidas Africanas Tradicionales -->
            <div class="col-lg-4 col-md-6">
                <div class="icon_box icon_box_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="icon">
                        <i class="flaticon-dining-table"></i>
                    </div>
                    <div class="icon_box_content">
                        <h5 class="text-uppercase">Cocina Africana Auténtica</h5>
                        <p>Disfruta de los sabores de las comidas africanas tradicionales, preparadas con amor para preservar nuestra rica herencia culinaria.</p>
                    </div>
                </div>
            </div>

            <!-- Bondad Casera -->
            <div class="col-lg-4 col-md-6">
                <div class="icon_box icon_box_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.03s">
                    <div class="icon">
                        <i class="flaticon-contact"></i>
                    </div>
                    <div class="icon_box_content">
                        <h5 class="text-uppercase">Bondad Casera</h5>
                        <p>Nuestras comidas se preparan con cuidado, combinando recetas caseras e ingredientes frescos para hacerte sentir como en casa.</p>
                    </div>
                </div>
            </div>

            <!-- Satisfaciendo Cada Bocado -->
            <div class="col-lg-4 col-md-6">
                <div class="icon_box icon_box_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                    <div class="icon">
                        <i class="flaticon-restaurant"></i>
                    </div>
                    <div class="icon_box_content">
                        <h5 class="text-uppercase">Satisfaciendo Cada Bocado</h5>
                        <p>Disfruta de comidas que no solo son deliciosas, sino también elaboradas para dejarte completamente satisfecho con cada bocado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION FEATURES -->

         
 
@endsection
<?php

use App\Helpers\Menu;

$ministeres = Menu::getMenuFrontMinistere();
$seteursactivites = Menu::getMenuFrontSecteurActivite();
$NbLicences = Menu::getTotaldeslicence();

?>
    <!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bienvenue sur e.Licences || site de consultation des licences et permis d'affaire de la Côte d'Ivoire</title>
    <meta name="author" content="Coblat">
    <meta name="description" content="site de consultation des licences et permis d'affaire de la Côte d'Ivoire">
    <meta name="keywords" content="site de consultation des licences et permis d'affaire de la Côte d'Ivoire">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="/assetsfront/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assetsfront/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assetsfront/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assetsfront/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assetsfront/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assetsfront/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assetsfront/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assetsfront/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assetsfront/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assetsfront/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assetsfront/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assetsfront/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assetsfront/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/assetsfront/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assetsfront/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Lexend:wght@300;400;500;600;700;800;900&family=Lobster&display=swap"
        rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/assetsfront/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="/assetsfront/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/assetsfront/css/magnific-popup.min.css">
    <!-- Swiper Js -->
    <link rel="stylesheet" href="/assetsfront/css/swiper-bundle.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/assetsfront/css/style.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H8JPFP43YY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-H8JPFP43YY');
    </script>

</head>

<body>
<!-- Modal -->
<div class="modal fade" style="z-index: 1000" id="myModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Secteur d'activité</h1>
            </div>
            <div class="modal-body">
                <?php
                $ListeSA = Menu::getMenuFrontSecteurActivite();
                ?>
                <div class="menu-area">
                    <div class="row align-items-center ">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <div class="col-lg-12 btn form-control col-md-12">
                                <ul>
                                    <li class="">
                                        <a href="#">Dans quel secteur d'activité exercez-vous ?</a>
                                        <ul class="sub-menu">
                                            @foreach ($ListeSA as $listeSA)
                                                    <?php $ListeSSA = Menu::getMenuFrontSousSecteurActivite($listeSA->id_secteur_activite); ?>
                                                <li class="menu-item-has-children">
                                                    <a href="{{route('resultatsecteuractivite',\App\Helpers\Crypt::UrlCrypt($listeSA->id_secteur_activite))}}"> {{ucfirst($listeSA->libelle_secteur_activite)}}</a>

                                                    {{--<ul class="sub-menu">@foreach ($ListeSSA as $listeSSA)
                                                                <?php $ListeN = Menu::getMenuFrontNature($listeSSA->id_sous_secteur); ?>
                                                            <li>
                                                                <a href="{{route('resultatsoussecteuractivite',\App\Helpers\Crypt::UrlCrypt($listeSSA->id_sous_secteur))}}"> {{ucfirst(substr($listeSSA->libelle_sous_secteur, 0, 100))}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>--}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->


<!--********************************
       Code Start From Here
******************************** -->

<!--==============================
 Preloader
==============================-->
<div class="preloader ">
    <button class="th-btn preloaderCls">Annuler le chargement</button>
    <div class="preloader-inner">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div><!--==============================
Product Lightbox
==============================-->
<!--==============================
    Sidemenu
============================== -->
<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form method="POST" class="form" action="{{ route('resultat') }}">
        @csrf
        <input type="text" name="search" placeholder="Rechercher une licence">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>

</div><!--==============================
    Mobile Menu
  ============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="/"><img src="/assetsfront/img/logo2.png" width="200px" alt="e.Licences"></a>
        </div>
        <div class="th-mobile-menu">
            @include('menufront')
        </div>
    </div>
</div><!--==============================
	Header Area
==============================-->
<header class="th-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block">
                    <p class="header-notice">Bienvenue sur e-Licences || site de consultation des licences et permis
                        d'affaire de la Côte d'Ivoire</p>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>

                            <li>
                                <div class="social-links">
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                                </div>
                            </li>
                            <li class="d-none d-sm-inline-block "><a
                                    class="btn btn-sm btn-dark rounded-pill" href="#"> <i
                                        class="fa fa-phone-outgoing"></i> Assistances</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="/"><img src="/assetsfront/img/logo2.png" width="200px" alt="e.Licences"></a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            @include('menufront')
                        </nav>
                        <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i>
                        </button>
                    </div>
                    <div class="col-auto d-none d-xl-block">
                        <div class="header-button">
                            <button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i>
                            </button>
                            <button type="button" class="simple-icon sideMenuToggler">
                            </button>
                            <a href="#"><img src="/assetsfront/img/logo_1.png" width="80px" alt="e-Licence"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!--==============================
Hero Area
==============================-->

<div class="th-hero-wrapper hero-2" id="hero" data-bg-src="/assetsfront/img/hero/gabarit-en-tete-articles-web.png">
    <div class="swiper th-slider" id="heroSlider2" data-slider-options='{"effect":"fade"}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero-inner">
                    <div class="container">
                        <div class="hero-style2">
                            <span class="sub-title" data-ani="slideinup" data-ani-delay="0.2s"><img
                                    src="/assetsfront/img/theme-img/cercle-noir.png" alt="shape">Entreprises</span>
                            <h1 class="hero-title widget_title  ">
                                <span class="title4 " data-ani="slideinup" data-ani-delay="0.5s">Assurez-vous de posséder <br>les autorisations nécessaires  pour exercer <br>en toute légalité vos activités.</span>
                            </h1>
                            <p style="color: white">Licence - Permis d'affaire - Habilitation - Accréditation<br>
                                Attestation - Visa, - Autorisation - Certificat...</p>
                            <div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">

                                <form method="POST" class="" action="{{ route('resultat') }}">
                                    @csrf
                                    <input CLASS="btn btn-success rounded-10" type="submit"
                                           value="Rechercher vos licences">
                                </form>
                            </div>
                        </div>
                    </div>

                    {{--<div class="hero-shape4" data-ani="slidebottomright" data-ani-delay="0.5s">
                        <img src="/assetsfront/img/hero/hero_shape_2_1.png" alt="shape">
                    </div>--}}
                </div>
            </div>

        </div>
    </div>
    <div class="icon-box">
        <button data-slider-prev="#heroSlider2" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
        <button data-slider-next="#heroSlider2" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
    </div>


</div>

<!--======== / Hero Section ========-->

<section class="space">
    <div class="container z-index-common">
        <div class="row gy-4 justify-content-center">

            <div class="col-xl-12 col-md-12">
                <div class="row justify-content-center">
                    <div class="text-center">
                        <h4 class="">Dans quel secteur d'activité exercez-vous ?</h4>
                    </div>
                </div>
                <div class="offer-box mega-hover" style="background-color: #F1F1F1">

                    <form method="POST" class="form" action="{{ route('resultatsa') }}">
                        @csrf
                        <div class="row">

                            <div class="col-5">
                                <select id="id_secteur_activite" class=" "
                                        name="id_secteur_activite">
                                    <option value="0">-- Votre secteur d'activité -- &nbsp;&nbsp;&nbsp;
                                    </option>
                                    @foreach ($seteursactivites as $seteursactivite)
                                        <option
                                            value="{{ $seteursactivite->id_secteur_activite }}">{{ ucfirst($seteursactivite->libelle_secteur_activite) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <select id='id_sous_secteur' name='id_sous_secteur'>
                                    <option value='0'>-- Sous-secteur d'activité -- &nbsp;&nbsp;&nbsp;
                                    </option>
                                </select>
                            </div>
                            <div class="col-2" align="right">
                                <button type="submit" name="action" value="Rechercher_Avancer"
                                        class="btn btn-warning "><i class="fa fa-search"></i>
                                    Rechercher
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!--==============================
Category Area
==============================-->
<div class="bg-smoke2 space overflow-hidden " id="faq-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="faq-img1">
                    <div class="">
                        <img src="/assetsfront/img/normal/about_1_3_1.png" alt="Image">
                    </div>

                </div>
            </div>
            <div class="col-xl-6 text-center text-xl-start align-self-center">
                <div class="ps-xl-4">
                    <div class="title-area text-center text-xl-start">

                        <h2 class="widget_title sec-title ">Tutoriel</h2>
                    </div>
                    <p style="font-size: xx-large">Comment utiliser efficacement votre moteur de recherche
                    <div class="year-counter_number"><span class=""> e-Licences ? </span></div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="counter-sec1 background-image" style="background-image: url('/assetsfront/img/bg/copyright_bg_1.png');">
    <div class="container">
        <div class="counter-card-wrap">
            <div class="counter-card">
                <div class="box-icon">
                    <img src="/assetsfront/img/icon/counter_card_4.svg" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">{{$NbLicences->nblicence}}</span></h2>
                    <p class="box-text">Licences</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="counter-card">
                <div class="box-icon">
                    <img width="50px" src="/assetsfront/img/icon/category.png" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">13</span></h2>
                    <p class="box-text">Natures</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="counter-card">
                <div class="box-icon">
                    <img width="50px" src="/assetsfront/img/icon/category.png" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">9</span></h2>
                    <p class="box-text">Catégories</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="counter-card">
                <div class="box-icon">
                    <img width="50px" src="/assetsfront/img/icon/modern-house.png" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">22</span></h2>
                    <p class="box-text">Ministères</p>
                </div>
            </div>
            <div class="divider"></div>
        </div>
    </div>
</div>
<section class=" space">
    <div class="container z-index-common">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="title-area text-center">
                    <span class="sub-title"><img src="assetsfront/img/theme-img/cercle-noir.png"
                                                 alt="Icon">RECHERCHES PAR CATÉGORIE</span>
                    <h2 class="sec-title">Licences par catégorie</h2>
                </div>
            </div>
        </div>
        <div class="row gy-30">
            <div class="col-xxl-5 col-lg-5">
                <div class="offer-card mega-hover" data-bg-src="assetsfront/img/bg/cta_bg_2_1.jpg"> </span>
                    <h3 class="box-title">Recherches par ministère.</h3>
                    <a href="/resultat" class="th-btn">Détails<i class="fas fa-chevrons-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-xxl-7 col-lg-7">
                <div class="offer-card mega-hover" data-bg-src="assetsfront/img/bg/cta_bg_2_2.jpg"> </span>
                    <h3 class="box-title">Recherches par secteur d'activité.</h3>
                    <a href="/resultat" class="th-btn">Détails<i class="fas fa-chevrons-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="space-bottom" style="background-image: url('/assetsfront/img/bg/brand_bg_1.jpg')">
    <div class="container th-container">
        <div class="swiper th-slider" id="blogSlider1"
             data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"5"},"1400":{"slidesPerView":"6"}}}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-1.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-2.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-3.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-1.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-2.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-3.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-1.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-2.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-3.png" alt="Brand Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="brand-card">
                        <img src="assetsfront/img/brand/s-1.png" alt="Brand Logo">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('footer')

<!--********************************
        Code End  Here
******************************** -->

<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
              style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>

<!--==============================
All Js File
============================== -->
<!-- Jquery -->
<script src="/assetsfront/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Swiper Js -->
<script src="/assetsfront/js/swiper-bundle.min.js"></script>
<!-- Bootstrap -->
<script src="/assetsfront/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="/assetsfront/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="/assetsfront/js/jquery.counterup.min.js"></script>
<!-- Range Slider -->
<script src="/assetsfront/js/jquery-ui.min.js"></script>
<!-- Isotope Filter -->
<script src="/assetsfront/js/imagesloaded.pkgd.min.js"></script>
<script src="/assetsfront/js/isotope.pkgd.min.js"></script>

<!-- Main Js File -->
<script src="/assetsfront/js/main.js"></script>


<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>

<script src="/js/codelicence.js"></script>

</body>

</html>

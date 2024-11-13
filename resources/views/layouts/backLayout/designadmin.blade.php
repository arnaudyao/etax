<?php

use App\Helpers\Menu;
$idutil = Auth::user()->id;
$naroles = Menu::get_menu_profil($idutil);
if (Auth::user()->photo_profil != '') {
    $iconUser = '/photoprofile/' . Auth::user()->photo_profil;
} else {
    $iconUser = '/photoprofile/user.png';
}
?><!DOCTYPE html>
<html class="loading " lang="fr" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Application de consultation des données des contribuables relatives aux taxes de Formation Professionnelle Continue (TFC) et d'Apprentissage (TA)  .">
    <meta name="keywords" content="e-Tax ">
    <meta name="author" content="e-Tax">
    <title>e-Tax - Application de consultation des données des contribuables </title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-invoice.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body onload="startTime()" class="vertical-layout vertical-menu-modern  navbar-floating footer-static"
      data-open="click"
      data-menu="vertical-menu-modern" data-col="">
<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow bg-warning">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link bookmark-star">
                        <i data-feather='calendar'></i>
                    </a>

                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link bookmark-star">
                        <div id="clock" class="ets-clock"></div>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="#" data-bs-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name fw-bolder">{{Auth::user()->name.' '.Auth::user()->prenom_users}}</span><span
                            class="user-status">{{ $naroles }}<?php if (isset(Auth::user()->num_agce)) { ?> <em>  ({{@Auth::user()->agence->lib_agce}})</em><?php } ?></span>
                    </div>
                    <span class="avatar"><img class="round" src="{{ $iconUser }}"
                                              alt="avatar" height="40" width="40"><span
                            class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('profil')}}"> <i class="me-50" data-feather="user"> </i>
                        Mon profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('deconnexion') }}"><i class="me-50" data-feather="power"></i>
                        Déconnexion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->


@include('layouts.backLayout.menu')

<!-- BEGIN: Content-->

@yield('content')
<!-- END: Content-->


<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-start d-block d-md-inline-block mt-25">Copyright &copy; <?= date('Y')?>
            <a class="ms-25" href="#" target="_blank">FDFP</a>
            <span class="d-none d-sm-inline-block">, Tous les droits sont réservés</span>
        </span>
        <span class="float-md-end d-none d-md-block"><img width="60" src="/app-assets/images/logo/logo-fdfp.png"></span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->


<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>

<script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->

<script src="/app-assets/js/scripts/forms/form-select2.js"></script>
<script src="/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
<script src="/assets/js/jquery-3.5.1.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap5.min.js"></script>

<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- END: Page Vendor JS-->

<script src="/app-assets/js/scripts/components/components-modals.js"></script>
<script src="/app-assets/js/scripts/pages/app-invoice.js"></script>
<!-- END: Page JS-->

<script src="/js/codesearch.js"></script>
<script language="JavaScript" type="text/javascript">
    var win = null;

    function NewWindow(mypage, myname, w, h, scroll, pos, niveau) {

        if (pos == "random") {
            LeftPosition = (screen.width) ? Math.floor(Math.random() * (screen.width - w)) : 100;
            TopPosition = (screen.height) ? Math.floor(Math.random() * ((screen.height - h) - 75)) : 100;
        }
        if (pos == "center") {
            LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
            TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
        } else if ((pos != "center" && pos != "random") || pos == null) {
            LeftPosition = 0;
            TopPosition = 20
        }
        settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';

        if ((win == null || win.closed) && (mypage != '#')) {
            win = window.open(mypage, myname, settings);
            win.focus();
        } else {
            win.close();
            if ((mypage != '#')) {
                win = window.open(mypage, myname, settings);
                win.focus();
            }
        }

    }

</script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    function startTime() {
        let today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        var day = today.getDay();
        var Y = today.getFullYear();
        var dayarr = ["Dimance", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
        day = dayarr[day];
        //  let ampm = h >= 24 ; h = h % 24; h = h ? h : 24; // the hour '0' should  be '12' m = m < 10 ? '0'+m : m; h = h < 10 ? '0'+h : h; s = s < 10 ? '0'+s : s;
        document.getElementById('clock').innerHTML = day + " <?= date('d/m/Y');?> " + h + ":" + m + ":" + s;
        let t = setTimeout(startTime, 500);
    }

    $(document).ready(function () {
        $('#exampleData').DataTable();
    });
</script>
</body>
<!-- END: Body-->

</html>

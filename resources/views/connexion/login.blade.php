<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="fr" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Application de consultation des données des contribuables relatives aux taxes de Formation Professionnelle Continue (TFC) et d'Apprentissage (TA) ">
    <meta name="keywords" content="e-Tax ">
    <meta name="author" content="e-Tax">
    <title>Authentification - e-Tax </title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-cover">
                <div class="auth-inner row m-0">
                    <!-- Brand logo--><a align="center" class="brand-logo" href="#">

                        <!-- <h2 class="brand-text text-warning ms-1">Rapide auto groupe</h2>-->
                    </a>
                    <!-- /Brand logo-->
                    <!-- Left Text-->

                    <div class="d-none d-lg-flex col-lg-7 align-items-center ">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center ">
                            <img class="img-fluid" src="/app-assets/images/pages/login-v2.svg"
                                 alt="Login V2"/>
                        </div>

                    </div>

                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <a class=" " href="#"><img width="150px" src="/app-assets/images/logo/logo-fdfp.png"></a>
                            <h2 class="card-title fw-bold mb-1">Bienvenue sur <b>e-Tax </b>  👋</h2>
                            <p class="card-text mb-2"> Application de consultation des données des contribuables
                                relatives aux taxes de Formation Professionnelle Continue (TFC) et d'Apprentissage (TA)
                            </p>
                            <form class="auth-login-form mt-2" action="{{ url('connexion') }}" method="POST">
                                {{ csrf_field() }}
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            <b>Echec: </b> {{ $message }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-1">
                                    <label class="form-label" for="login-email">Email *</label>
                                    <input autocomplete="off" class="form-control" id="login-email" type="text"
                                           name="username" required
                                           placeholder="Email" aria-describedby="login-email" autofocus=""
                                           tabindex="1"/>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Mot de passe *</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input autocomplete="off" class="form-control form-control-merge"
                                               required="required"
                                               id="login-password"
                                               type="password" name="password" placeholder="············"
                                               aria-describedby="login-password" tabindex="2"/><span
                                            class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning w-100" tabindex="4">Se connecter</button>
                            </form>

                            <div class="divider my-2">
                                <div class="divider-text">Nos réseaux sociaux</div>
                            </div>
                            <div class="auth-footer-btn d-flex justify-content-center">
                                <a class="btn btn-facebook" href="#"> <i data-feather="facebook"></i></a>
                                <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>
                                <a class="btn btn-google" href="#"><i data-feather="youtube"></i></a>
                                <a class="btn btn-instagram" href="#"><i data-feather="instagram"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/app-assets/js/scripts/pages/auth-login.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>













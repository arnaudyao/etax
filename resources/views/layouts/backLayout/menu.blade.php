<!-- BEGIN: Main Menu-->
<?php

use App\Helpers\Menu;

$idutil = Auth::user()->id;
$idutilClient = Auth::user()->id_partenaire;
$tabl = Menu::get_menu($idutil);
$naroles = Menu::get_menu_profil($idutil);

?>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow expanded" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="/dashboard">
                    <img width="140" src="/app-assets/images/logo/logo-fdfp.png">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content  ps ps--active-y">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header">
                <span data-i18n="Date">Application</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <?php if (Auth::user()->flag_mdp == true){
                $i = 0;
            foreach ($tabl as $key => $tablvue) {
                $i++;
                ?>
            <li class=" nav-item  {{ Request::routeIs($tablvue[0]->sousmenu.'*') ? 'has-sub sidebar-group-active open' : '' }}   ">
                <a class="d-flex align-items-center" href="javascript:<?php echo $key; ?>;">
                        <?php if (isset($tablvue[0]->icone)) { ?>
                    {!! $tablvue[0]->icone !!}
                    <?php } else { ?>
                    <i data-feather='menu'></i>

                    <?php } ?>
                    <span class="menu-title  "
                          data-i18n="Invoice">{{ strtoupper($tablvue[0]->menu) }}</span>
                </a>
                <ul class="menu-content">
                        <?php foreach ($tablvue as $key => $vue) { ?>
                    <li {{ Request::routeIs($vue->sousmenu.'*') ? 'active' : '' }} >
                        <a class="d-flex align-items-center" href="{{ url('/'.$vue->sousmenu)}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate"
                                  data-i18n="<?= $vue->libelle; ?>"><?= $vue->libelle; ?></span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php }
            } ?>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

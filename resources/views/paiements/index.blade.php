@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Contribuable')
    @php($titre='Paiements du contribuable')
    @php($lien='')
    <?php
    if (isset($ResultContribuable) and isset($donnees)) {
        $nccVar = $donnees['ncc'];
        $date0 = trim($donnees['annee0']);
        $date1 = trim($donnees['annee1']);
    } else {
        $nccVar = '';
        $date0 = date('Y');
        $date1 = date('Y');
    }
    ?>
        <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper ">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{$titre}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{$Module}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{$titre}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ $message }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($message = Session::get('echec'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ $message }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ $error }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$titre}}</h4>

                                </div>
                                <div class="card-body">
                                    {!! Html::form()
                                    ->method('POST')
                                    ->open() !!}
                                    <div class="row">
                                        <div class="d-grid col-lg-2 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> NCC :</label>
                                                <input type="text" required
                                                       name="ncc" id="ncc"
                                                       value="<?php echo $nccVar?>"
                                                       placeholder="Saisir le NCC"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-3 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> Exercice d'imposition de début : </label>
                                                <input type="number" required
                                                       name="annee0" id="annee0"
                                                       value="<?php echo $date0?>"
                                                       min="2000"
                                                       placeholder="Saisir l'année. Ex.: 2024"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-3 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> Exercice d'imposition de fin : </label>
                                                <input type="number" required
                                                       name="annee1" id="annee1"
                                                       value="<?php echo $date1?>"
                                                       min="2000"
                                                       placeholder="Saisir l'année. Ex.: 2025"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-2 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-">
                                                <br>
                                                <button type="submit" value="Rech" name="Rech"
                                                        class="btn btn-primary btn-sm w-100 waves-effect waves-float waves-light">
                                                    Rechercher
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-2 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-">
                                                <br>
                                                <a
                                                    <?php if (!isset($ResultPaiement) and !isset($ResultContribuable)) { ?>
                                                    class="btn btn-outline-secondary  btn-sm w-100 waves-effect waves-float waves-light"
                                                    disabled="disabled"
                                                    <?php } ?>
                                                    <?php if (isset($ResultPaiement) and isset($ResultContribuable)) { ?>
                                                    class="btn btn-secondary btn-sm w-100 waves-effect waves-float waves-light"
                                                    target="_blank"
                                                    onclick="NewWindow('/etatpaiements/apercu/{{\App\Helpers\Crypt::UrlCrypt($nccVar)}}/{{\App\Helpers\Crypt::UrlCrypt($date0)}}/{{\App\Helpers\Crypt::UrlCrypt($date1)}}','',screen.width/2,screen.height,'yes','center',1);;"
                                                    <?php } ?>
                                                >
                                                    Aperçu</a>

                                            </div>
                                        </div>
                                    </div>
                                    {!! Html::form()->close() !!}
                                </div>
                            </div>
                            <?php if (isset($ResultPaiement) and isset($ResultContribuable)) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">

                                        <div class="card-content collapse show" style="">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>NCC</th>
                                                        <td>{{ $ResultContribuable->ncc }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Raison sociale</th>
                                                        <td>{{ $ResultContribuable->raison_sociale }}</td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                <br>
                                                    <?php
                                                    // Grouper les données par exercice_imposition (année)
                                                    $groupedPaiements = $ResultPaiement->groupBy('exercice_imposition');
                                                    ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Impot Origine</th>
                                                        <th>Période</th>
                                                        <th>Montant FPC Déclaré</th>
                                                        <th>Montant TAP Déclaré</th>
                                                        <th>Montant FPC Réglé</th>
                                                        <th>Montant TAP Réglé</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Variables pour accumuler les totaux généraux
                                                        $totalFpc = 0;
                                                        $totalTap = 0;
                                                        $totalFpcRegle = 0;
                                                        $totalTapRegle = 0;
                                                        ?>

                                                    @foreach ($groupedPaiements as $annee => $paiements)
                                                        <!-- Afficher l'année -->
                                                        <tr>
                                                            <td colspan="6" align="center"><strong>ANNEE
                                                                    : {{ $annee }}</strong></td>
                                                        </tr>

                                                        <!-- Afficher les détails pour cette année -->
                                                        @foreach ($paiements as $paiement)
                                                            <tr>
                                                                <td>{{ $paiement->impot_origine_id }}</td>
                                                                <td>{{ $paiement->periode_imposition }}</td>
                                                                <td align="right">{{ number_format($paiement->montant_fpc, 1, ',', ' ') }}</td>
                                                                <td align="right">{{ number_format($paiement->montant_tap, 1, ',', ' ') }}</td>
                                                                <td align="right">{{ number_format($paiement->montant_fpc_regle, 1, ',', ' ') }}</td>
                                                                <td align="right">{{ number_format($paiement->montant_tap_regle, 1, ',', ' ') }}</td>
                                                            </tr>
                                                        @endforeach

                                                        <!-- Calculer et afficher les totaux pour cette année -->
                                                            <?php
                                                            $totalFpcAnnee = $paiements->sum('montant_fpc');
                                                            $totalTapAnnee = $paiements->sum('montant_tap');
                                                            $totalFpcRegleAnnee = $paiements->sum('montant_fpc_regle');
                                                            $totalTapRegleAnnee = $paiements->sum('montant_tap_regle');

                                                            // Ajouter aux totaux généraux
                                                            $totalFpc += $totalFpcAnnee;
                                                            $totalTap += $totalTapAnnee;
                                                            $totalFpcRegle += $totalFpcRegleAnnee;
                                                            $totalTapRegle += $totalTapRegleAnnee;
                                                            ?>

                                                        <tr>
                                                            <td align="center" colspan="2"><strong>Total
                                                                    pour {{ $annee }}</strong></td>
                                                            <td align="right">
                                                                <strong>{{ number_format($totalFpcAnnee, 1, ',', ' ') }}</strong>
                                                            </td>
                                                            <td align="right">
                                                                <strong>{{ number_format($totalTapAnnee, 1, ',', ' ') }}</strong>
                                                            </td>
                                                            <td align="right">
                                                                <strong>{{ number_format($totalFpcRegleAnnee, 1, ',', ' ') }}</strong>
                                                            </td>
                                                            <td align="right">
                                                                <strong>{{ number_format($totalTapRegleAnnee, 1, ',', ' ') }}</strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <!-- Afficher les totaux généraux -->
                                                    <tr>
                                                        <td colspan="6">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" colspan="2"><strong>Total Général</strong>
                                                        </td>
                                                        <td align="right">
                                                            <strong>{{ number_format($totalFpc, 1, ',', ' ') }}</strong>
                                                        </td>
                                                        <td align="right">
                                                            <strong>{{ number_format($totalTap, 1, ',', ' ') }}</strong>
                                                        </td>
                                                        <td align="right">
                                                            <strong>{{ number_format($totalFpcRegle, 1, ',', ' ') }}</strong>
                                                        </td>
                                                        <td align="right">
                                                            <strong>{{ number_format($totalTapRegle, 1, ',', ' ') }}</strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>
    <!-- END: Content-->

@endsection



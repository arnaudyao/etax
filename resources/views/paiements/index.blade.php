@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Contribuable')
    @php($titre='Paiements du contribuable')
    @php($lien='')
    <?php
    if (isset($Result)) {
        $ncc = \App\Helpers\Crypt::UrlCrypt(trim($_POST["ncc"]));
        if ($ncc == '') $ncc = 0;
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
                                  //  ->action() // Remplacez 'votre_route' par la route souhaitée
                                    ->open() !!}
                                    <div class="row">
                                        <div class="d-grid col-lg-4 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> NCC :</label>
                                                <input type="text" required
                                                       name="ncc" id="ncc"
                                                       placeholder="Saisir le NCC"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-4 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> Exercice d'imposition:</label>
                                                <input type="text" required
                                                       name="annee" id="annee"
                                                       placeholder="Saisir l'année. Ex.: 2025"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-4 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-">
                                                <br>
                                                <button type="submit" value="Rech" name="Rech"
                                                        class="btn btn-primary btn-sm w-100 waves-effect waves-float waves-light">
                                                    Rechercher
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Html::form()->close() !!}
                                </div>
                            </div>
                            <?php if (isset($ResultPaiement)) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">

                                        <div class="card-content collapse show" style="">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>NCC</th>
                                                        <th>Raison sociale</th>
                                                        <th>Exercice d'imposition</th>
                                                        <th>Periode d'imposition</th>
                                                        <th>Type d'impot</th>
                                                        <th>FPC Déclaré</th>
                                                        <th>TAP Déclaré</th>
                                                        <th>FPC Réglé</th>
                                                        <th>TAP Réglé</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $fpcD = 0;
                                                        $tapD = 0;
                                                        $fpcR = 0;
                                                        $tapR = 0;
                                                        ?>
                                                    @foreach ($ResultPaiement as $key => $data)
                                                      <?php
                                                            $fpcD+=$data->montant_fpc;
                                                            $tapD+=$data->montant_tap;
                                                            $fpcR+=$data->montant_fpc_regle;
                                                            $tapR+=$data->montant_tap_regle;
                                                       ?>
                                                        <tr>
                                                            <td>{{ $data->ncc }}</td>
                                                            <td>{{ $data->raison_sociale }}</td>
                                                            <td>{{ $data->exercice_imposition }}</td>
                                                            <td>{{ $data->periode_imposition }}</td>
                                                            <td>{{ $data->impot_origine_id }}</td>
                                                            <td nowrap="nowrap"
                                                                align="right">{{ number_format($data->montant_fpc, 0, ' ', ' ') }}</td>
                                                            <td nowrap="nowrap"
                                                                align="right">{{ number_format($data->montant_tap, 0, ' ', ' ') }}</td>
                                                            <td nowrap="nowrap"
                                                                align="right">{{ number_format($data->montant_fpc_regle, 0, ' ', ' ') }}</td>
                                                            <td nowrap="nowrap"
                                                                align="right">{{ number_format($data->montant_tap_regle, 0, ' ', ' ') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="9">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Total</td>
                                                        <td colspan="nowrap"
                                                            align="right">{{ number_format($fpcD, 0, ' ', ' ') }}
                                                        </td>
                                                        <td colspan="nowrap"
                                                            align="right">{{  number_format($tapD, 0, ' ', ' ') }}
                                                        </td>
                                                        <td colspan="nowrap"
                                                            align="right">{{  number_format($fpcR, 0, ' ', ' ') }}
                                                        </td>
                                                        <td colspan="nowrap"
                                                            align="right">{{  number_format($tapR, 0, ' ', ' ') }}
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



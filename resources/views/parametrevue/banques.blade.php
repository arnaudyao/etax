@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Parametrage')
    @php($titre='Liste des banques')
    @php($lien='')

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

                <section id="multiple-column-form">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$titre}}</h4>

                                </div>

                                <div class="table">
                                    <!--begin: Datatable-->
                                    <table class="table table-bordered table-striped table-hover table-sm "
                                           id="exampleData"
                                           style="margin-top: 13px !important">

                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Libellés</th>
                                            <th>Sigle</th>
                                            <th>Swift</th>
                                            <th>Statut</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach ($resultat  as $key => $item)
                                            <tr>
                                                <td>{{ $item->banque_id }}</td>
                                                <td>{{ $item->libelle }}</td>
                                                <td>{{ $item->sigle }}</td>
                                                <td>{{ $item->swift }}</td>
                                                <td align="center">
                                                        <?php if ($item->acte_statut_id == 'Actif'){ ?>
                                                    <span class="badge badge-light-success">Actif</span>
                                                    <?php } else { ?>
                                                    <span class="badge badge-light-danger">Inactif</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                    <!--end: Datatable-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>
    <!-- END: Content-->

@endsection



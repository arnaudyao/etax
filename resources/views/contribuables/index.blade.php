@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Contribuables')
    @php($titre='Liste des contribuables')
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
                                        <div class="d-grid col-lg-6 col-md-12 mb-2 mb-lg-0">
                                            <div class="mb-1">
                                                <label> NCC :</label>
                                                <input type="text" required
                                                       name="ncc" id="ncc"
                                                       placeholder="Saisir le NCC"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="d-grid col-lg-6 col-md-12 mb-2 mb-lg-0">
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
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Le contribuable</h4>
                                            <div class="heading-elements">

                                            </div>
                                        </div>
                                        <div class="card-content collapse show" style="">
                                            <div class="card-body">
                                                <table class="table table-bordered">

                                                    <tbody>
                                                    <tr>
                                                        <th>NCC</th>
                                                        <td>Collapse card  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Raison social</th>
                                                        <td>Remove card from page using remove card action</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sigle</th>
                                                        <td>Remove card  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Forme juridique</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>N°d'identification fiscale</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Code regime</th>
                                                        <td>Remove card from  </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Adresse</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Telephone</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Code postale</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Activité</th>
                                                        <td>Remove card from  </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Etat</th>
                                                        <td>Remove card from  </td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Paiements par années <em>(F CFA)</em></h4>
                                                    <div class="heading-elements">

                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">

                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Années</th>
                                                                <th>FPC</th>
                                                                <th>TAP</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>NCC</td>
                                                                <td>Collapse</td>
                                                                <td>Collapse</td>
                                                                <td>Collapse</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Historique des formes juridiques</h4>
                                                    <div class="heading-elements">

                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Ancienne</th>
                                                                <th>Nouvelle</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>NCC</td>
                                                                <td>Collapse</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Activités secondaires</h4>
                                                    <div class="heading-elements">

                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Ancienne</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>NCC</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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



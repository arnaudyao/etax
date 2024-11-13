@extends('layouts.backLayout.designadmin')
@can('role-create')
    @section('content')

        @php($Module='Paramétrage')
        @php($titre='Liste des profils')
        @php($soustitre='Ajouter un profil')
        @php($lien='roles')


        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper ">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">{{$soustitre}}</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">{{$Module}}</a></li>
                                        <li class="breadcrumb-item"><a href="/{{$lien}}">{{$titre}}</a></li>
                                        <li class="breadcrumb-item active">{{$soustitre}}  </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="content-body">


                    @if ($errors->any())

                        <div class="alert alert-custom alert-danger fade show" role="alert">
                            <div class="alert-text">
                                <strong>Echec :</strong> Veuillez renseigner les informations du formulaire !
                            </div>
                            <div class="alert-close">
                                <button type="button" class="btn-sx close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!--end::Notice-->
                    <!--begin::Card-->
                    <section id="multiple-column-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{$soustitre}} </h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" class="form" action="{{ route($lien.'.store') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label>Code:</label>
                                                    <input type="text" name="code_roles" id="code_roles"
                                                           class="form-control form-control-sm"
                                                           placeholder="Code">
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Libellé </label>
                                                    <input type="text" name="name" id="name"
                                                           class="form-control form-control-sm"
                                                           placeholder="Libellé " required>
                                                </div>


                                            </div>
                                            <div class="col-12" align="right">
                                                <hr>
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary me-1 waves-effect waves-float waves-light">
                                                    Enregistrer
                                                </button>
                                                <a class="btn btn-sm btn-outline-secondary waves-effect"
                                                   href="/{{$lien }}">
                                                    Retour</a>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>

    @endsection

@endcan

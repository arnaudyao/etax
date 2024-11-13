@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Configuration')
    @php($titre='Liste des paramètres généraux')
    @php($soustitre='Modifier un paramètre')
    @php($lien='parametresysteme')



    <!-- BEGIN: Content-->
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ $message }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$soustitre}} </h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" class="form" action="{{ route('modifierparametresysteme',\App\Helpers\Crypt::UrlCrypt($id))}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label>Titre </label>
                                                    <input type="text" name="titre_logo" id="titre_logo"
                                                           class="form-control form-control-sm"
                                                           placeholder="Titre" value="{{$logo->titre_logo}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label>Types valeur </label>
                                                    <select name="valeur"  required  id="smallSelect" class="form-select form-select-sm">
                                                        <option value="{{ $logo->valeur }}">{{ $logo->valeur }}</option>
                                                        <option value="LOGO">LOGO</option>
                                                        <option value="EMAIL">EMAIL</option>
                                                        <option value="CONTACT">CONTACT</option>
                                                        <option value="RESEAUX SOCIAUX">RESEAUX SOCIAUX</option>
                                                        <option value="HEURE OUVERTURE">HEURE OUVERTURE</option>
                                                        <option value="LOCALISATION">LOCALISATION</option>
                                                        <option value="CONTACT INFO">CONTACT INFO</option>
                                                        <option value="MAP LATITUDE">MAP LATITUDE</option>
                                                        <option value="MAP LONGUEUR">MAP LONGUEUR</option>
                                                        <option value="NEWSLETTER">NEWSLETTER</option>
                                                        <option value="COULEUR MENU HAUT">COULEUR</option>
                                                        <option value="IMAGE ACCEUIL">IMAGE ACCEUIL</option>
                                                        <option value="IMAGE DASHBORD">IMAGE DASHBORD</option>
                                                        <option value="SITEVITRINE">ACTIVE LE SITE VITIRNE</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label>Fichier </label><br>

                                                    <input type="file" class="form-control form-control-sm" placeholder="ajouter un  fichier" name="logo_logo"  />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                @if(!empty($logo->logo_logo))
                                                    <img src="{{ asset('/frontend/logo/'. $logo->logo_logo)}}" alt="" width="150px" >
                                                @endif
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label>Statut </label><br>
                                                    <input type="checkbox" class="form-check-input" name="flag_logo"
                                                           id="colorCheck1" {{  ($logo->flag_logo == 1 ? ' checked' : '') }}>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label>Valeur du mot clé </label>
                                                    <textarea class="form-control form-control-sm"  name="mot_cle" id="mot_cle" rows="6">{{  $logo->mot_cle  }}</textarea>
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
                                        </div>
                                    </form>

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
















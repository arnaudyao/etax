@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Configuration')
    @php($titre='Liste des modules')
    @php($soustitre='Modifier un module')
    @php($lien='menus')





    @can($lien.'-edit')
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
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ $error }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                                    <form method="POST" class="form"
                                          action="{{ route($lien.'.update', $menu->id_menu) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-5 col-12">
                                                <div class="mb-1">
                                                    <label>Libellé </label>
                                                    <input type="text" name="menu" id="menu" value="{{$menu->menu}}"
                                                           class="form-control form-control-sm"
                                                           placeholder="Libellé du module" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label>Icone </label>
                                                    <input type="text" name="icone" id="icone" value="{{$menu->icone}}"
                                                           class="form-control form-control-sm"
                                                           placeholder="Icone">
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label>Priorité </label>
                                                    <input type="text" name="priorite_menu" id="priorite_menu"
                                                           value="{{$menu->priorite_menu}}"
                                                           class="form-control form-control-sm" min="0"
                                                           placeholder="Priorité" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label>Statut </label><br>
                                                    <input type="checkbox" class="form-check-input" name="is_valide"
                                                           id="colorCheck1" {{  ($menu->is_valide == true ? ' checked' : '') }}>
                                                </div>
                                            </div>
                                            <div class="col-12" align="right">
                                                <hr>
                                                <button type="submit"
                                                        class="btn  btn-sm btn-primary me-1 waves-effect waves-float waves-light">
                                                    Enregistrer
                                                </button>
                                                <a class="btn btn-sm btn-outline-secondary waves-effect" href="/{{$lien }}">
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
    @endcan






@endsection

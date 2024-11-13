@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Paramétrage')
    @php($titre='Liste des profils')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper ">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
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

                <!--begin::Entry-->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <!--end::Notice-->
                <!--begin::Card-->
                <section id="multiple-column-form">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$titre}}</h4>
                                    <span align="right">
                                         @can('role-create')
                                            <a href="{{ route('roles.create') }}"
                                               class="btn btn-primary waves-effect waves-float waves-light">
                                               <i data-feather='plus'></i> Ajouter </a>
                                        @endcan
                                    </span>
                                </div>

                                <div class="table">
                                    <table id="exampleData"
                                           class="table  table-bordered table-striped table-hover table-sm ">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nom</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td align="center">
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit',$role->id) }}"
                                                           class="btn btn-icon btn-sm rounded-circle btn-outline-primary waves-effect "
                                                           title="Modifier"><i data-feather='edit'></i></a>

                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.backLayout.designadmin')

@section('content')

    @php($Module='Configuration')
    @php($titre='Attribution')
    @php($lien='menus')

    <!-- BEGIN: Content-->
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ $message }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <form action="{{ route('menuprofillayout',$role->id) }}" method="POST">
                    @csrf
                    <section id="multiple-column-form">
                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{$titre}} / Profil : {{$role->name}}</h4>
                                        <span align="right">

                                                <button type="submit"
                                                        class="btn btn-primary waves-effect waves-float waves-light"><i
                                                        class="la la-plus"></i>Attribuer</button>
                                </span>
                                    </div>
                                    <!-- Accordion with margin start -->
                                    <section id="accordion-with-border">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                    <div class="card">
                                                        <div class="card-body">
                                                                <?php $i = 0; ?>

                                                            @foreach($tablsm as $key=>$tablvue)
                                                                @foreach($tablvue as $key_vue=>$vue)
                                                                        <?php
                                                                        $i++;
                                                                        ?>
                                                                    <div class="accordion accordion-border accordion-margin"
                                                                         id="accordionBorder">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="headingBorderOne{{$i}}">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#accordionBorderOne{{$i}}"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="accordionBorderOne{{$i}}">
                                                                                 Module :   {{$key_vue}}
                                                                                </button>
                                                                            </h2>
                                                                            <div id="accordionBorderOne{{$i}}"
                                                                                 class="accordion-collapse collapse"
                                                                                 aria-labelledby="headingBorderOne"
                                                                                 data-bs-parent="#accordionBorder">
                                                                                @foreach($vue as $key_new_vue=>$new_vue)
                                                                                    <div class="accordion-body">
                                                                                        <div class="checkbox-list">
                                                                                            <label class="checkbox">
                                                                                                &nbsp;&nbsp; Menu :
                                                                                                <input type="checkbox"
                                                                                                       @foreach($new_vue as $permission_key => $permission)
                                                                                                           value="{{$permission->id_sous_menu}}"
                                                                                                       <?php if (in_array($permission->id_sous_menu, $roleSousmenus)) {
                                                                                                           echo 'checked';
                                                                                                       } ?>
                                                                                                       name="route[{{$permission->id_sous_menu}}]"
                                                                                                       id="route{{$permission->id_sous_menu}}"
                                                                                                    @endforeach
                                                                                                />
                                                                                                <span
                                                                                                    class="h5 mb-0"> {{$key_new_vue}}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-2">
                                                                                        </div>

                                                                                        @foreach($new_vue as $permission_key=>$permission)
                                                                                            @isset($permission->lib_permission)

                                                                                                <div class="col-2">
                                                                                                    Permission :
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        <?php if (in_array($permission->id, $role_permission)) {
                                                                                                            echo 'checked';
                                                                                                        } ?>

                                                                                                        value="<?php echo $permission->id;?>"
                                                                                                        name="permission[<?php echo $permission->id;?>]"
                                                                                                        id="permission<?php echo $permission->id;?>">
                                                                                                    <span
                                                                                                        class="custom-option-header">
                                                                            <span
                                                                                class="h6 mb-0">{{$permission->lib_permission}}</span> |
                                                                        </span>
                                                                                                </div>
                                                                                            @endisset
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <hr>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Accordion with margin end -->
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>


        </div>
    </div>
    <!-- END: Content-->

@endsection









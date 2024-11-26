<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->

        <div class="col-12 col-md-12 card-separator">
            <h3 class="text text-dark"> Bonjour {{Auth::user()->name.' '.Auth::user()->prenom_users}} , 👋🏻</h3>
            <div class="col-12 col-lg-12">
                <div class="alert alert-info">
                    <div class="alert-body d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-info me-50">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>Bienvenue sur notre application de consultation  des contribuables relatives aux taxes de
                    Formation Professionnelle Continue (TFC) et d'Apprentissage (TAP) .</span>
                    </div>
                </div>

            </div>

        </div>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Les 20 paiements les plus récents</h4>

                        </div>

                        <div class="table">
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-striped table-hover table-sm "
                                   id="exampleData"
                                   style="margin-top: 13px !important">

                                <thead>
                                <tr>
                                    <th>Date de paiement</th>
                                    <th>NCC</th>
                                    <th>Raison sociale</th>
                                    <th>Impot Origine</th>
                                    <th>Période</th>
                                    <th>FPC Déclaré</th>
                                    <th>TAP Déclaré</th>
                                    <th>FPC Réglé</th>
                                    <th>TAP Réglé</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ResultPaiement20 as $paiement)
                                    <tr>
                                        <td>{{ $paiement->date_paiement }}</td>
                                        <td>{{ $paiement->ncc }}</td>
                                        <td>{{ $paiement->raison_sociale }}</td>
                                        <td>{{ $paiement->impot_origine_id }}</td>
                                        <td>{{ $paiement->periode_imposition }}</td>
                                        <td align="right">{{ number_format($paiement->montant_fpc, 1, ',', ' ') }}</td>
                                        <td align="right">{{ number_format($paiement->montant_tap, 1, ',', ' ') }}</td>
                                        <td align="right">{{ number_format($paiement->montant_fpc_regle, 1, ',', ' ') }}</td>
                                        <td align="right">{{ number_format($paiement->montant_tap_regle, 1, ',', ' ') }}</td>
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

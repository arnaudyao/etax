<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->

        <div class="col-12 col-md-12 card-separator">
            <h3 class="text text-dark"> Bonjour {{Auth::user()->name.' '.Auth::user()->prenom_users}}  , 👋🏻</h3>
            <div class="col-12 col-lg-7">
                <p>Bienvenue sur notre application web ! Nous sommes ravis de vous avoir parmi nous. Nous espérons que
                    vous apprécierez votre expérience avec nous !</p>
            </div>

        </div>


        <div class=" ">
            <div class="card">
                <img class="card-img-top" src="/app-assets/images/pages/coming-soon.svg" alt=" ">

            </div>
        </div>


        <!--/ Medal Card -->
{{--
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Statistics Card -->
        <div class="col-xl-6 col-md-6 col-12">
            <div class="col-lg-12 col-12">
                <div class="row match-height">
                    <div class="col-lg-6 col-md-6 col-6">
                            <div class="col-lg-12 col-12">
                                <div align="center">
                                    <canvas id="myChart"></canvas>
                                    Etats des factures client
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-lg-12 col-12">
                            <div align="center">
                                <canvas id="myChartFoun"></canvas>
                                Etats des factures fournisseur
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php $numbtotal = count($dataFactClient); $l2 = 0; if ($dataFactClient != null) foreach ($dataFactClient as $resultat2) :$l2++; ?><?php echo("'" . $resultat2->lib_assureur . "'");
                    if ($l2 != $numbtotal) {
                        echo ',';
                    } ?><?php endforeach; ?>],
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# F CFA ',
                    data: [<?php  $l = 0; if ($dataFactClient != null) foreach ($dataFactClient as $resultat) :$l++; ?><?php echo round(($resultat->mtt), 0);
                        if ($l != $numbtotal) {
                            echo ',';
                        } ?><?php endforeach; ?>],

                    //data: [12, 19, 3, 5, 2, 3],
                    // borderWidth: 1
                }],
                // hoverOffset: 4
            },
            /* options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }*/
        });
    </script>
    <script>
        const ctx2 = document.getElementById('myChartFoun');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: [<?php $numbtotal2 = count($dataFactfounisseur); $l20 = 0; if ($dataFactfounisseur != null) foreach ($dataFactfounisseur as $resultat20) :$l20++; ?><?php echo("'" . $resultat20->lib_fourn . "'");
                    if ($l20 != $numbtotal2) {
                        echo ',';
                    } ?><?php endforeach; ?>],
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# F CFA ',
                    data: [<?php  $l0 = 0; if ($dataFactfounisseur != null) foreach ($dataFactfounisseur as $resultat0) :$l++; ?><?php echo round(($resultat0->mtt), 0);
                        if ($l0 != $numbtotal2) {
                            echo ',';
                        } ?><?php endforeach; ?>],

                    //data: [12, 19, 3, 5, 2, 3],
                    // borderWidth: 1
                }],
                // hoverOffset: 4
            },
            /* options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }*/
        });
    </script>--}}
</section>

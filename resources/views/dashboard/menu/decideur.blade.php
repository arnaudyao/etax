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
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($ResultPaiement->montant_tap_regle, 0, ' ', ' ') }}</h2>
                        <p class="card-text">Montant TAP total</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign' class="feather feather-alert-octagon font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($ResultPaiement->montant_fpc_regle, 0, ' ', ' ') }}</h2>
                        <p class="card-text">Montant FPC total</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign' class="feather feather-alert-octagon font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($ResultPaiement->montant_fpc_regle+$ResultPaiement->montant_tap_regle, 0, ' ', ' ') }}</h2>
                        <p class="card-text">Montant total</p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign' class="feather feather-alert-octagon font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ number_format($ResultContrib->nccnb, 0, ' ', ' ')  }}</h2>
                        <p class="card-text">Contribuables</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='home' class="feather feather-alert-octagon font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
            )
            window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
            )
            window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
            )
        </script>


        <script src="https://cdn.jsdelivr.net/npm/react@16.12/umd/react.production.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/react-dom@16.12/umd/react-dom.production.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prop-types@15.7.2/prop-types.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/react-apexcharts@1.3.6/dist/react-apexcharts.iife.min.js"></script>


        <script>
            // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
            // Based on https://gist.github.com/blixt/f17b47c62508be59987b
            var _seed = 42;
            Math.random = function () {
                _seed = _seed * 16807 % 2147483647;
                return (_seed - 1) / 2147483646;
            };
        </script>
        <div class="col-lg-7 col-12">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h4 class="card-title">Répartition des paiements par années</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div id="appRa"></div>

                    <script type="text/babel">
                        class ApexChart extends React.Component {
                            constructor(props) {
                                super(props);

                                this.state = {
                                    series: [
                                        {
                                            name: "Montants  (F CFA)",
                                            type: "bar",
                                            data: {!! json_encode($montants) !!} // Montants bruts injectés
                                        }
                                    ],
                                    options: {
                                        colors: ['#2a6b9b', '#f9a867', '#6a6ba5'],
                                        chart: {
                                            height: 350,
                                            width: '100%',
                                            type: 'line',
                                            stacked: true,
                                            zoom: {
                                                enabled: true,
                                                type: 'x'
                                            }
                                        },
                                        title: {
                                            text: '',
                                            align: 'center',
                                            floating: true
                                        },
                                        tooltip: {
                                            followCursor: true,
                                            shared: false,
                                            y: {
                                                formatter: function (value) {
                                                    // Ajouter des séparateurs de milliers dans l'info-bulle
                                                    return value.toLocaleString('fr-FR', {
                                                        style: 'decimal',
                                                        minimumFractionDigits: 0
                                                    });
                                                }
                                            }
                                        },
                                        xaxis: {
                                            categories: {!! json_encode($categories) !!} // Années injectées
                                        },
                                        yaxis: [
                                            {
                                                seriesName: 'Montants',
                                                title: {
                                                    text: 'Montants totaux',
                                                    style: {color: '#2a6b9b'}
                                                },
                                                labels: {
                                                    formatter: function (value) {
                                                        // Ajouter des séparateurs de milliers sur l'axe Y
                                                        return value.toLocaleString('fr-FR', {
                                                            style: 'decimal',
                                                            minimumFractionDigits: 0
                                                        });
                                                    }
                                                }
                                            }
                                        ],
                                        legend: {showForSingleSeries: true},
                                        fill: {opacity: 1}
                                    }
                                };
                            }

                            render() {
                                return (
                                    <div>
                                        <div id="chart">
                                            <ReactApexChart
                                                options={this.state.options}
                                                series={this.state.series}
                                                type="line"
                                            />
                                        </div>
                                    </div>
                                );
                            }
                        }

                        const domContainer = document.querySelector('#appRa');
                        ReactDOM.render(React.createElement(ApexChart), domContainer);
                    </script>

                </div>
            </div>
        </div>
        <div class="col-lg-5 col-12">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h4 class="card-title">Répartition des Montants Réglés</h4>
                    </div>

                </div>
                <div class="card-body">

                    <div id="app"></div>


                    <script type="text/babel">
                        class ApexChart extends React.Component {
                            constructor(props) {
                                super(props);

                                this.state = {
                                    series: [{{ implode(',', $series) }}], // Montants sans guillemets
                                    options: {
                                        chart: {
                                            type: 'donut',
                                        },
                                        labels: {!! json_encode($labels) !!}, // Labels dynamiques
                                        responsive: [{
                                            breakpoint: 480,
                                            options: {
                                                chart: {
                                                    width: 200
                                                },
                                                legend: {
                                                    position: 'bottom'
                                                }
                                            }
                                        }]
                                    },


                                };
                            }


                            render() {
                                return (
                                    <div>
                                        <div id="chart">
                                            <ReactApexChart options={this.state.options} series={this.state.series}
                                                            type="donut"/>
                                        </div>
                                        <div id="html-dist"></div>
                                    </div>
                                );
                            }
                        }

                        const domContainer = document.querySelector('#app');
                        ReactDOM.render(React.createElement(ApexChart), domContainer);
                    </script>


                </div>
            </div>
        </div>
    </div>

</section>

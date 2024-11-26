<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aperçu </title>
    <style>
        body {
            family: Arial, Helvetica;
            font-size: 15px;
        }
    </style>
</head>
<style>
    @media print {
        .visuel_bouton {
            display: none;
        }

        @page {
            margin-top: 0.3in !important;
            margin-bottom: 0.3in !important;
        }
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1;
        font-size: 12px;
        margin: 0;
        padding: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 3px;
    }

    th {
        background-color: #f2f2f2;
    }


    @media print {
        /* Crée un saut de page avant le deuxième paragraphe */
        .page-break {
            page-break-before: always;
        }
    }
</style>
<body>


<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tbody>
    <tr>
        <td width="25%" rowspan="2">
            <img alt="Logo" src="/app-assets/images/logo/logo-fdfp.png" height="50"
                 style="margin:2px; padding: 2px"/>
        </td>
        <td width="50%" align="center" valign="middle" style="font-size: 20px; text-align:center">
            <strong> Etat des paiements<br> du contribuable</strong></td>
        <td width="25%" rowspan="2">Abidjan, le {!! date('d/m/Y') !!}</td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="font-size: 16px; text-align:center">Période d'imposition de :
            <strong>{!! $annee01 !!}</strong> à: <strong>{!! $annee11 !!}</strong></td>
    </tr>
    </tbody>
</table>

<br/>
<p align="right"><input type="button" name="Submit" value="Imprimer" class="ecran visuel_bouton"
                        onclick="window.print();"/>
</p>
<?php if (isset($ResultPaiement) and isset($ResultContribuable)) { ?>

<table class="table ">
    <thead>
    <tr>
        <th>NCC</th>
        <td>{{ $ResultContribuable->ncc }}</td>
    </tr>
    <tr>
        <th>Raison sociale</th>
        <td>{{ $ResultContribuable->raison_sociale }}</td>
    </tr>
    </thead>
</table>
<br>
    <?php
    // Grouper les données par exercice_imposition (année)
    $groupedPaiements = $ResultPaiement->groupBy('exercice_imposition');
    ?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Impot Origine</th>
        <th>Période</th>
        <th>Montant FPC Déclaré</th>
        <th>Montant TAP Déclaré</th>
        <th>Montant FPC Réglé</th>
        <th>Montant TAP Réglé</th>
    </tr>
    </thead>
    <tbody>
        <?php
        // Variables pour accumuler les totaux généraux
        $totalFpc = 0;
        $totalTap = 0;
        $totalFpcRegle = 0;
        $totalTapRegle = 0;
        ?>

    @foreach ($groupedPaiements as $annee => $paiements)
        <!-- Afficher l'année -->
        <tr>
            <td colspan="6" align="center"><strong>ANNEE
                    : {{ $annee }}</strong></td>
        </tr>

        <!-- Afficher les détails pour cette année -->
        @foreach ($paiements as $paiement)
            <tr>
                <td>{{ $paiement->impot_origine_id }}</td>
                <td>{{ $paiement->periode_imposition }}</td>
                <td align="right">{{ number_format($paiement->montant_fpc, 1, ',', ' ') }}</td>
                <td align="right">{{ number_format($paiement->montant_tap, 1, ',', ' ') }}</td>
                <td align="right">{{ number_format($paiement->montant_fpc_regle, 1, ',', ' ') }}</td>
                <td align="right">{{ number_format($paiement->montant_tap_regle, 1, ',', ' ') }}</td>
            </tr>
        @endforeach

        <!-- Calculer et afficher les totaux pour cette année -->
            <?php
            $totalFpcAnnee = $paiements->sum('montant_fpc');
            $totalTapAnnee = $paiements->sum('montant_tap');
            $totalFpcRegleAnnee = $paiements->sum('montant_fpc_regle');
            $totalTapRegleAnnee = $paiements->sum('montant_tap_regle');

            // Ajouter aux totaux généraux
            $totalFpc += $totalFpcAnnee;
            $totalTap += $totalTapAnnee;
            $totalFpcRegle += $totalFpcRegleAnnee;
            $totalTapRegle += $totalTapRegleAnnee;
            ?>

        <tr>
            <td align="center" colspan="2"><strong>Total
                    pour {{ $annee }}</strong></td>
            <td align="right">
                <strong>{{ number_format($totalFpcAnnee, 1, ',', ' ') }}</strong>
            </td>
            <td align="right">
                <strong>{{ number_format($totalTapAnnee, 1, ',', ' ') }}</strong>
            </td>
            <td align="right">
                <strong>{{ number_format($totalFpcRegleAnnee, 1, ',', ' ') }}</strong>
            </td>
            <td align="right">
                <strong>{{ number_format($totalTapRegleAnnee, 1, ',', ' ') }}</strong>
            </td>
        </tr>
    @endforeach

    <!-- Afficher les totaux généraux -->
    <tr>
        <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" colspan="2"><strong>Total Général</strong>
        </td>
        <td align="right">
            <strong>{{ number_format($totalFpc, 1, ',', ' ') }}</strong>
        </td>
        <td align="right">
            <strong>{{ number_format($totalTap, 1, ',', ' ') }}</strong>
        </td>
        <td align="right">
            <strong>{{ number_format($totalFpcRegle, 1, ',', ' ') }}</strong>
        </td>
        <td align="right">
            <strong>{{ number_format($totalTapRegle, 1, ',', ' ') }}</strong>
        </td>
    </tr>
    </tbody>
</table>


<?php } ?>
<br/>


</body>
</html>



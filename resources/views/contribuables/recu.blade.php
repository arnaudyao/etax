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
        .ecran {
            display: none;
        }
    }
</style>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td width="46%" align="center"><img src="/logoAgence/{{ $ResAgence->logo_agce}}"
                                            height="45"><br>{{ $ResAgence->lib_agce }}  </td>
    </tr>
    <tr>
        <td align="center">{{ $ResAgence->adresse_agce }} / {{ $ResAgence->bp_agce }}
            {{ 'Tel.: '.$ResAgence->tel_agce}} / {{'Fax: '.$ResAgence->fax_agce }}</td>
    </tr>
    <tr>
        <td align="right">
            <input type="button" name="Submit" value="Imprimer" class="ecran visuel_bouton" onclick="window.print();"/>
        </td>
    </tr>

    </tbody>
</table>

<table width="100%" border="1" cellpadding="6" cellspacing="0">
    <tbody>
    <td width="34%" align="center"> Chiffres d'affaire client</td>
    <td width="33%" align="center"> Période <br>du : {{$date1}} <br>Au : {{$date2}}</td>
    </tr>


    </tbody>
</table>
<br/>

<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0">
    <thead>
    <tr>
        <th>No</th>
        <th>Entité</th>
        <th align="right">Montant tva</th>
        <th align="right">Montant ht</th>
        <th align="right">Montant ttc</th>
        <th align="right">Montant reglé</th>
    </tr>
    </thead>
    <tbody>
    @php($totalFact=0)
    @php($totalReg=0)
    @php($totaltva=0)
    @php($totalht=0)
    @php($i=0)
    @foreach ($Result  as $key => $val)
        @php($i++ )
        @php($totalFact+=$val->mtt_ttc_fact)
        @php($totaltva+=$val->mtt_tva_fact)
        @php($totalht+=$val->mtt_net_brut_fact)
        @php($totalReg+=$val->mtt_reglement_fact)
        <tr>
            <td>{{$i}}</td>
            <td>{{ $val->lib_agce }} </td>
            <td align="right">{{number_format($val->mtt_tva_fact, 0, ',', ' ') }}</td>
            <td align="right">{{number_format($val->mtt_net_brut_fact, 0, ',', ' ') }}</td>
            <td align="right">{{number_format($val->mtt_ttc_fact, 0, ',', ' ') }}</td>
            <td align="right">{{number_format($val->mtt_reglement_fact, 0, ',', ' ') }}</td>
        </tr>
    @endforeach
    <tr>
        <td align="right" colspan="6"> &nbsp;</td>
    </tr>
    <tr>
        <td align="right" colspan="2">Total</td>
        <td align="right">{{number_format($totaltva, 0, ',', ' ') }}</td>
        <td align="right">{{number_format($totalht, 0, ',', ' ') }}</td>
        <td align="right">{{number_format($totalFact, 0, ',', ' ') }}</td>
        <td align="right">{{number_format($totalReg, 0, ',', ' ') }}</td>
    </tr>
    </tbody>
</table>
<br/>


</body>
</html>



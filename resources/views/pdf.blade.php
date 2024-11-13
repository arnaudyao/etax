<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Détails de la licence || e-Licences, site de consultation des licences et permis d'affaire de la Côte
        d'Ivoire</title>
    <meta name="author" content="Coblat">
    <meta name="description" content="site de consultation des licences et permis d'affaire de la Côte d'Ivoire">
    <meta name="keywords" content="site de consultation des licences et permis d'affaire de la Côte d'Ivoire">
    <meta name="robots" content="e-Licence,Côte d'Ivoire">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="/assetsfront/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assetsfront/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assetsfront/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assetsfront/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assetsfront/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assetsfront/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assetsfront/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assetsfront/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assetsfront/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assetsfront/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assetsfront/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assetsfront/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assetsfront/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/assetsfront/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assetsfront/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Lexend:wght@300;400;500;600;700;800;900&family=Lobster&display=swap"
        rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/assetsfront/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="/assetsfront/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/assetsfront/css/magnific-popup.min.css">
    <!-- Swiper Js -->
    <link rel="stylesheet" href="/assetsfront/css/swiper-bundle.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/assetsfront/css/style.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H8JPFP43YY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-H8JPFP43YY');
    </script>
</head>

<body>
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
    <tr class="wishlist_item">
        <td align="center"  class="product-name">e.Licences </td>
        <td align="center"   class="product-name"><h2><b>Fiche signalétique </b></h2></td>
        <td align="center"   class="product-name">Date : {{ date('d/m/Y')}}</td>
    </tr>
	<tr class="wishlist_item">
        <td align="center" colspan="3" class="product-name"><h2><b>{{@$licence->libelle_licences}} </b></h2></td>
    </tr>
	</table>
<p>&nbsp;</p>

<table width="100%" border="1" cellpadding="3" cellspacing="0" >
    <thead>
    <tr class="wishlist_item">
        <td align="center" colspan="4" class="product-name"><h2><b>Informations détaillées </b></h2></td>
    </tr>
    </thead>
    <tbody>
    <tr class="wishlist_item">
        <td width="41%" class="product-name"><b>Nature </b></td>
        <td width="59%" colspan="3"
            class="product-name">{{ @$licence->libelle_nat_licence }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Type </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->libelle_type_licence }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Catégorie </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->description_categorie_licence }}
            ({{ @$licence->libelle_categorie_licence }})
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Secteur d’activité</b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->libelle_secteur_activite }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Sous secteur d’activité </b>
        </td>
        <td colspan="3"
            class="product-name">{{ @$licence->libelle_sous_secteur }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Formes juridique </b></td>
        <td colspan="3"
            class="product-name">
            {{ @$licence->form_juridique_licence }}
            @foreach ($licencesformejuridique as $licencesformejuridiqu)
                {{ @$licencesformejuridiqu->libelle_forme_juridique.', ' }}
            @endforeach
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Nature de l'Actionnariat </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->libelle_nat_actionnariat }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Capital imposé (FCFA) </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->capital_licence }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Délai de délivrance </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->delai_delivrance_licence }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Frais administratif (FCFA) </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->frais_admin_montt_cfa_licence }}
        </td>
    </tr>

    <tr class="wishlist_item">
        <td class="product-name"><b>Montant de la Caution (FCFA) si
                applicable </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->montant_caution_licence }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Périodicité de renouvellement </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->periodicite_renouvelement_licen }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Renouvellement soumis à inspection </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->inspection_renouvelement_licenc }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Délai de délivrance (jours) –
                renouvellement </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->delai_de_delivrance }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Frais administratif lié à la demande de
                renouvellement (FCFA) </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->frais_demande_de_renouvellement }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Ces frais administratifs liés à la demande
                de
                renouvellement (FCFA) sont-ils ? </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->frais_demande_de_renouv_rembour }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>Période spécifique de dépôt des
                dossiers </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->periode_specifique_de_depot }}
        </td>
    </tr>
    <tr class="wishlist_item">
        <td class="product-name"><b>L’investisseur peut-il exercer un droit de
                recours en cas de rejet ou d’avis défavorable de sa demande de
                licence ? </b></td>
        <td colspan="3"
            class="product-name">{{ @$licence->droit_de_recours_apeciser }}
        </td>
    </tr>

    </tbody>
</table>

<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" class="tinvwl-table-manage-list">
	   <thead>
    <tr class="wishlist_item">
        <td align="center" colspan="2" class="product-name"><h2><b>Contact de l'autorité émettrice </b></h2></td>
    </tr>
    </thead>
  <tbody>
    <tr class="wishlist_item">
      <td width="41%" class="product-name"><b>Ministère </b></td>
      <td width="59%"
                                        class="product-name">{{@$licence->libelle_ministere}} </td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Structure</b></td>
      <td
                                        class="product-name">{{@$licence->libelle_structure}} </td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Autorité émettrice </b></td>
      <td
                                        class="product-name">{{@$licence->libelle_autorite_deliv}} </td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Situation géographique </b></td>
      <td
                                        class="product-name">{{@$licence->situatio_geo_licences}} </td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Tél.Fixe </b></td>
      <td class="product-name">{{@$licence->tel_licences}}</td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Adresse Mail </b></td>
      <td class="product-name">{{@$licence->email_licences}}</td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Site Internet </b></td>
      <td
                                        class="product-name"><?php if ($licence->site_internet_licences != 'Non disponible') { ?>
        <a target="_blank"
                                           href="{{@$licence->site_internet_licences}}">{{@$licence->site_internet_licences}}</a>
        <?php } else { ?>
        {{@$licence->site_internet_licences}}
        <?php } ?></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>

<table width="100%" border="1" cellpadding="3" cellspacing="0" class="tinvwl-table-manage-list">
                               	   <thead>
    <tr class="wishlist_item">
        <td align="center" class="product-name"><h2><b>Pièces à fournir </b></h2></td>
    </tr>
    </thead>
  <tr class="wishlist_item">
                                        <?php
                                        $caracteres_a_traiter = array(';', ':');
                                        foreach ($caracteres_a_traiter as $caractere) {
                                            $texte = str_replace($caractere, ',', @$licence->pieces_licence);
                                        }
                                        $texte_final = nl2br($texte);
                                        ?>
                                    <td class="product-name"> <?php echo $texte_final; ?>  </td>
                                </tr>


                            </table>

<p>&nbsp;</p>

<table width="100%" border="1" cellpadding="3" cellspacing="0" class="tinvwl-table-manage-list">
	              	   <thead>
    <tr class="wishlist_item">
        <td align="center" colspan="2" class="product-name"><h2><b>Pénalités </b></h2></td>
    </tr>
    </thead>
  <tbody>
    <tr class="wishlist_item">
      <td width="45%" class="product-name"><b>La règlementation soumet-elle le requérant à
        des pénalités en cas de non-respect des dispositions en vigueur
        ?</b></td>
      <td width="55%" class="product-name">{{ @$licence->cas_de_non_respect_des_disposit }} </td>
    </tr>
    <tr class="wishlist_item">
      <td class="product-name"><b>Si oui, quel est le montant de la pénalité
        ou le mode d’évaluation du montant de la pénalité</b></td>
      <td class="product-name"> {{ @$licence->cas_non_respect_penalite_apecis }} </td>
    </tr>
    <tr class="wishlist_item">
      <th class="product-name"><b>Les principaux motifs
        d’application de la pénalité </b></th>
      <?php
                                        $caracteres_a_traiter2 = array(';', ':', '');
                                        foreach ($caracteres_a_traiter2 as $caractere2) {
                                            $texte2 = str_replace($caractere2, '<br>', @$licence->motif_penalite_licence);
                                        }
                                        $texte_final = nl2br($texte2);
                                        ?>
      <td class="product-name"><?php echo $texte_final; ?></td>
    </tr>

  </tbody>

</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" class="tinvwl-table-manage-list">
	              	   <thead>
    <tr class="wishlist_item">
        <td align="center" colspan="2" class="product-name"><h2><b>Documents à télécharger </b></h2></td>
    </tr>
  @foreach ($documenttelecharger as $documenttelecharge)
  <tr class="wishlist_item">
    <td class="product-name"><a target="_blank"
                                               onclick="NewWindow('{{ asset("/document/fichier_document_licence/". @$documenttelecharge->fichier_document_licence)}}','',screen.width,screen.height,'yes','center',1);">
      {{@$documenttelecharge->libelle_document_licence}} </a></td>
    <td><a target="_blank" class="btn btn-sm btn-warning"
                                               onclick="NewWindow('{{ asset("/document/fichier_document_licence/". @$documenttelecharge->fichier_document_licence)}}','',screen.width,screen.height,'yes','center',1);"> <i class="fa fa-download"></i> Télécharger </a></td>
  </tr>
  @endforeach
</table>
<p>&nbsp;</p>

</body>

</html>

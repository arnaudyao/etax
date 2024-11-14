<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Html\Elements\Form;

class ContribuablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $date1 = null, $date2 = null)
    {
        $ResultContribuable = null;
        $ResultHistoFormeJurid = null;
        $ResultPaiement = null;
        $ResultHistoStatu = null;
        $ResultHistoActiveSecond = null;
        if ($request->isMethod('post') and $request->input('Rech') == "Rech") {
            $this->validate($request, [
                'ncc' => 'required'
            ], [
                'ncc.required' => 'Veuillez saisir le NCC du contribuable.',
            ]);
            $ncc = trim($request->input('ncc'));
            //-----Le contribuable----------------------
            $ResultContribuable = DB::table('vm_contribuable')
                ->leftjoin('vm_ville', 'vm_contribuable.ville_id', '=', 'vm_ville.ville_id')
                ->leftjoin('vm_commune', 'vm_contribuable.commune_id', '=', 'vm_commune.commune_id')
                ->leftjoin('vm_activite', 'vm_contribuable.activite_id', '=', 'vm_activite.activite_id')
                ->leftjoin('vm_postes_comptables', 'vm_contribuable.poste_comptable_id', '=', 'vm_postes_comptables.poste_comptable_id')
                ->leftjoin('vm_contribuable_statut', 'vm_contribuable.contribuable_statut_id', '=', 'vm_contribuable_statut.contribuable_statut_id')
                ->join('vm_forme_juridique', 'vm_contribuable.forme_juridique_id', '=', 'vm_forme_juridique.forme_juridique_id')
                ->select([
                    'vm_contribuable.ncc',
                    'vm_contribuable.raison_sociale',
                    'vm_contribuable.sigle',
                    'vm_contribuable.contribuable_statut_id',
                    'vm_contribuable.forme_juridique_id',
                    'vm_contribuable.localisation',
                    'vm_contribuable.adresse_postale',
                    'vm_contribuable.ville_id',
                    'vm_contribuable.telephone',
                    'vm_contribuable.cellulaire',
                    'vm_contribuable.poste_comptable_id',
                    'vm_activite.libelle as activite',
                    'vm_contribuable.dirigeant',
                    'vm_contribuable.email',
                    'vm_contribuable.commune_id',
                    'vm_contribuable.section',
                    'vm_contribuable.parcelle',
                    'vm_contribuable.lot',
                    'vm_contribuable.ilot',
                    'vm_contribuable.nombre_employe',
                    'vm_contribuable.date_immatriculation',
                    'vm_contribuable.date_modification',
                    'vm_contribuable.date_cessation',
                    'vm_contribuable.date_debut_activite',
                    'vm_contribuable.classification_dgi',
                    'vm_contribuable_statut.libelle as contribuable_statut',
                    'vm_forme_juridique.libelle as forme_juridique',
                    'vm_forme_juridique.code_libelle as code_forme_juridique',
                    'vm_postes_comptables.libelle as postes_comptables',
                    'vm_ville.libelle as ville_nom',        // Remplacez 'nom' par le nom de la colonne voulue de la table ville
                    'vm_commune.libelle as commune_nom'     // Remplacez 'nom' par le nom de la colonne voulue de la table commune
                ])
                ->where('vm_contribuable.ncc', '=', $ncc)
                ->first();
            //----- Liste de l'historique des forme juridique----------------------
            $ResultHistoFormeJurid = DB::table('vm_histo_forme_juridiques')
                ->leftjoin('vm_forme_juridique', 'vm_histo_forme_juridiques.forme_juridique_id_avant', '=', 'vm_forme_juridique.forme_juridique_id')
                ->leftjoin('vm_forme_juridique as apres', 'vm_histo_forme_juridiques.forme_juridique_id_apres', '=', 'apres.forme_juridique_id')
                ->select(['vm_forme_juridique.code_libelle as forme_juridique_avant',
                            'apres.code_libelle as forme_juridique_apres','vm_histo_forme_juridiques.date_creation'])
                ->where('ncc', '=', $ncc)
                ->get();

            //-----Les activités secondaires----------------------
            $ResultHistoActiveSecond = DB::table('vm_activites_secondaires')
                ->leftjoin('vm_activite', 'vm_activites_secondaires.activite_id', '=', 'vm_activite.activite_id')
                ->select(['vm_activite.libelle as activite',
                    'localisation_etablissement'])
                ->where('ncc', '=', $ncc)
                ->get();
            //-----Les activités secondaires----------------------
            $ResultHistoStatu = DB::table('vm_histo_contribuale_statut')
                ->select(['contribuable_statut_id_avant', 'contribuable_statut_id_apres'])
                ->where('ncc', '=', $ncc)
                ->get();
            //-----Liste des paiements par annees----------------------
            $ResultPaiement = DB::table('vm_paiements', 'vf')
                ->select(['vf.exercice_imposition',
                    DB::raw('SUM(vf.montant_fpc_regle) as montant_fpc_regle'),
                    DB::raw('SUM(vf.montant_tap_regle) as montant_tap_regle'),
                ])
                ->where([['ncc', '=', $ncc], ['paiement_statut_id', '=', '3']])
                ->groupBy('vf.exercice_imposition')
                ->orderByDesc('vf.exercice_imposition')
                ->get();

            if (!isset($ResultContribuable)) {
                return redirect()->route('contribuables')->with('echec', 'Aucune information trouvée.');
            }
        }
        return view('contribuables.index', compact('ResultContribuable', 'ResultHistoStatu', 'ResultPaiement', 'ResultHistoFormeJurid', 'ResultHistoActiveSecond'));
    }


    public function recu($agce = null, $date1 = null, $date2 = null)
    {
        $idAgceCon = Auth::user()->num_agce;
        $Agce = Crypt::UrldeCrypt($agce);
        $date1 = Crypt::UrldeCrypt($date1);
        $date2 = Crypt::UrldeCrypt($date2);
        $ValReqDate = [];
        if (($date1 != '') and ($date2 != '')) $ValReqDate = [['date_edition_fact', '>=', $date1], ['date_edition_fact', '<=', $date2]];
        $ValReqAgce = [];
        if (($Agce != '')) $ValReqAgce = [['num_agce', '=', $Agce]];
        $ReqOk = array_merge($ValReqDate, $ValReqAgce);
        $Result = DB::table('vue_facture', 'vf')
            ->select(['vf.lib_agce',
                DB::raw('SUM(vf.mtt_reglement_fact) as mtt_reglement_fact'),
                DB::raw('SUM(vf.mtt_tva_fact) as mtt_tva_fact'),
                DB::raw('SUM(vf.mtt_net_brut_fact) as mtt_net_brut_fact'),
                DB::raw('SUM(vf.mtt_ttc_fact) as mtt_ttc_fact')
            ])
            ->where($ReqOk)
            ->groupBy('vf.lib_agce')
            ->orderByDesc('vf.lib_agce')
            ->get();

        $ResAgence = DB::table('agence as f')
            ->where('f.num_agce', '=', $idAgceCon)
            ->first();
        return view('etats.contribuables.recu', compact('ResAgence', 'Result', 'date1', 'date2'));
    }

}

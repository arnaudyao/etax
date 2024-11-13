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
                ->select(['ncc', 'raison_sociale', 'sigle', 'adresse', 'forme_juridique_id', 'num_identification_fiscale', 'telephone', 'email',
                    'site_web', 'code_postale', 'code_regime', 'num_piece', 'annee_imposition', 'periode_imposition', 'num_declaration',
                    'date_imposition', 'montant_payer', 'date_paiement', 'banque_paiement', 'etablissement_bancaire', 'num_compte',
                    'numero_employe', 'activite_id', 'date_creation', 'date_modification', 'etat_actif', 'classification_activite'])
                ->where('ncc', '=', $ncc)
                ->first();
            //----- Liste de l'historique des forme juridique----------------------
            $ResultHistoFormeJurid = DB::table('vm_contribuable')
                ->select(['ncc', 'raison_sociale', 'sigle'])
                ->where('ncc', '=', $ncc)
                ->get();

            //-----Les activités secondaires----------------------
            $ResultHistoActiveSecond = DB::table('vm_contribuable')
                ->select(['ncc', 'raison_sociale', 'sigle'])
                ->where('ncc', '=', $ncc)
                ->get();

            //-----Liste des paiements par annees----------------------
            $Result = DB::table('vm_paiements','vf')
                ->select(['vf.exercice_imposition',
                    DB::raw('SUM(vf.mtt_reglement_fact) as mtt_reglement_fact'),
                    DB::raw('SUM(vf.mtt_tva_fact) as mtt_tva_fact'),
                ])
                ->where('ncc', '=', $ncc)
                ->groupBy('vf.lib_agce')
                ->orderByDesc('vf.lib_agce' )
                ->get();

            if (!isset($ResultContribuable)) {
                return redirect()->route('contribuables')->with('echec', 'Aucune information trouvée.');
            }
        }
        return view('contribuables.index', compact('ResultContribuable','ResultHistoFormeJurid','ResultHistoActiveSecond'));
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

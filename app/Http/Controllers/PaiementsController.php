<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Html\Elements\Form;

class PaiementsController extends Controller
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
                'ncc' => 'required',
                'annee' => 'required'
            ], [
                'ncc.required' => 'Veuillez saisir le NCC du contribuable.',
                'annee.required' => 'Veuillez saisir l\'exercice d\'imposition du contribuable.',
            ]);
            $ncc = trim($request->input('ncc'));
            $annee = trim($request->input('annee'));
            //-----Le contribuable----------------------

            //-----Liste des paiements par annees----------------------
            $ResultPaiement = DB::table('vm_declarations', 'vd')
                ->leftJoin('vm_paiements as vf', 'vd.impot_id', '=', 'vf.impot_id')
                ->join('vm_contribuable as vc', 'vc.ncc', '=', 'vf.ncc')
                ->select(['vf.exercice_imposition', 'vc.ncc', 'vf.periode_imposition', 'vc.raison_sociale',
                    'montant_fpc_regle', 'montant_tap_regle', 'montant_fpc', 'montant_tap', 'impot_origine_id'
                ])
                ->where([['vf.ncc', '=', $ncc], ['vf.exercice_imposition', '=', $annee], ['vf.paiement_statut_id', '=', '3']])
                ->orderByDesc('vf.exercice_imposition')
                ->get();
//dd($ResultPaiement);
            if (!isset($ResultPaiement)) {
                return redirect()->route('paiements')->with('echec', 'Aucune information trouvée.');
            }
        }
        return view('paiements.index', compact('ResultContribuable', 'ResultHistoStatu', 'ResultPaiement', 'ResultHistoFormeJurid', 'ResultHistoActiveSecond'));
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

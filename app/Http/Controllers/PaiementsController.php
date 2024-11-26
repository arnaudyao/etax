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
        $donnees = null;
        if ($request->isMethod('post') and $request->input('Rech') == "Rech") {
            $this->validate($request, [
                'ncc' => 'required',
                'annee0' => 'required',
                'annee1' => 'required'
            ], [
                'ncc.required' => 'Veuillez saisir le NCC du contribuable.',
                'annee0.required' => 'Veuillez saisir l\'exercice d\'imposition du contribuable.',
                'annee1.required' => 'Veuillez saisir l\'exercice d\'imposition du contribuable.',
            ]);
            $donnees = $request->all();
            $ncc = trim(strtoupper($donnees['ncc']));
            $annee0 = trim($donnees['annee0']);
            $annee1 = trim($donnees['annee1']);
            if ($annee0 > $annee1) {
                return redirect()->route('paiements')->with('echec', 'Echec : L\'exercice d\'imposition de début doit etre infèrieur à l\'exercice d\'imposition de fin  .');
            }
            //-----Le contribuable----------------------
            $ResultContribuable = DB::table('vm_contribuable', 'vc')
                ->select(['vc.raison_sociale', 'vc.ncc'])
                ->where([['vc.ncc', '=', $ncc]])
                ->first();
            //-----Liste des paiements par annees----------------------
            $ResultPaiement = DB::table('vm_declarations as vd')
                ->leftJoin('vm_paiements as vf', 'vd.impot_id', '=', 'vf.impot_id')
                ->select([
                    'vf.exercice_imposition',
                    'vf.periode_imposition',
                    'vf.montant_fpc_regle',
                    'vf.montant_tap_regle',
                    'vd.montant_fpc',
                    'vd.montant_tap',
                    'vd.impot_origine_id'
                ])
                ->where([
                    ['vf.ncc', '=', $ncc],
                    ['vf.exercice_imposition', '>=', $annee0],
                    ['vf.exercice_imposition', '<=', $annee1],
                    ['vf.paiement_statut_id', '=', '3']
                ])
                ->orderByRaw("
        vf.exercice_imposition desc,
                CASE
            WHEN vf.periode_imposition LIKE 'Janvier%' THEN 1
            WHEN vf.periode_imposition LIKE 'Février%' THEN 2
            WHEN vf.periode_imposition LIKE 'Mars%' THEN 3
            WHEN vf.periode_imposition LIKE 'Avril%' THEN 4
            WHEN vf.periode_imposition LIKE 'Mai%' THEN 5
            WHEN vf.periode_imposition LIKE 'Juin%' THEN 6
            WHEN vf.periode_imposition LIKE 'Juillet%' THEN 7
            WHEN vf.periode_imposition LIKE 'Août%' THEN 8
            WHEN vf.periode_imposition LIKE 'Septembre%' THEN 9
            WHEN vf.periode_imposition LIKE 'Octobre%' THEN 10
            WHEN vf.periode_imposition LIKE 'Novembre%' THEN 11
            WHEN vf.periode_imposition LIKE 'Décembre%' THEN 12
        END
                ")
                ->get();


            if (!isset($ResultPaiement)) {
                return redirect()->route('paiements')->with('echec', 'Echec : Aucune information trouvée.');
            }
        }
        return view('paiements.index', compact('donnees', 'ResultContribuable', 'ResultHistoStatu', 'ResultPaiement', 'ResultHistoFormeJurid', 'ResultHistoActiveSecond'));
    }


    public function recu($ncc = null, $annee0 = null, $annee1 = null)
    {
        $ncc1 = trim(strtoupper(Crypt::UrldeCrypt($ncc)));
        $annee01 = trim(Crypt::UrldeCrypt($annee0));
        $annee11 = trim(Crypt::UrldeCrypt($annee1));

        if ($annee01 > $annee11) {
            return redirect()->route('paiements')->with('echec', 'Echec : L\'exercice d\'imposition de début doit etre infèrieur à l\'exercice d\'imposition de fin  .');
        }
        if ($ncc1==null) {
            return redirect()->route('paiements')->with('echec', 'Echec : Le NCC est non disponible .');
        }
        //-----Le contribuable----------------------
        $ResultContribuable = DB::table('vm_contribuable', 'vc')
            ->select(['vc.raison_sociale', 'vc.ncc'])
            ->where([['vc.ncc', '=', $ncc1]])
            ->first();

        //-----Liste des paiements par annees----------------------
        $ResultPaiement = DB::table('vm_declarations as vd')
            ->leftJoin('vm_paiements as vf', 'vd.impot_id', '=', 'vf.impot_id')
            ->select([
                'vf.exercice_imposition',
                'vf.periode_imposition',
                'vf.montant_fpc_regle',
                'vf.montant_tap_regle',
                'vd.montant_fpc',
                'vd.montant_tap',
                'vd.impot_origine_id'
            ])
            ->where([
                ['vf.ncc', '=', $ncc1],
                ['vf.exercice_imposition', '>=', $annee01],
                ['vf.exercice_imposition', '<=', $annee11],
                ['vf.paiement_statut_id', '=', '3']
            ])
            ->orderByRaw("
        vf.exercice_imposition desc,
                CASE
            WHEN vf.periode_imposition LIKE 'Janvier%' THEN 1
            WHEN vf.periode_imposition LIKE 'Février%' THEN 2
            WHEN vf.periode_imposition LIKE 'Mars%' THEN 3
            WHEN vf.periode_imposition LIKE 'Avril%' THEN 4
            WHEN vf.periode_imposition LIKE 'Mai%' THEN 5
            WHEN vf.periode_imposition LIKE 'Juin%' THEN 6
            WHEN vf.periode_imposition LIKE 'Juillet%' THEN 7
            WHEN vf.periode_imposition LIKE 'Août%' THEN 8
            WHEN vf.periode_imposition LIKE 'Septembre%' THEN 9
            WHEN vf.periode_imposition LIKE 'Octobre%' THEN 10
            WHEN vf.periode_imposition LIKE 'Novembre%' THEN 11
            WHEN vf.periode_imposition LIKE 'Décembre%' THEN 12
        END
                ")
            ->get();

        return view('paiements.recu', compact('ResultContribuable', 'ResultPaiement','annee01','annee11'));

    }

}

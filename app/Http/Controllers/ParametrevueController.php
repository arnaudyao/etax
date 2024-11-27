<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Html\Elements\Form;

class ParametrevueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function activites(Request $request,)
    {
        $resultat = DB::table('vm_activite', 'va')
            ->leftJoin('vm_type_activite as ta', 'ta.type_activite_id', '=', 'va.activite_type_id')
            ->select(['va.activite_id', 'va.libelle', 'va.activite_statut', 'ta.libelle as typeactivite'])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.activites', compact('resultat',));

    }

    public function banques(Request $request,)
    {
        $resultat = DB::table('vm_banques', 'va')
            ->select(['va.banque_id', 'va.libelle', 'va.sigle', 'va.swift', 'va.acte_statut_id'])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.banques', compact('resultat',));

    }

    public function pcomptables(Request $request,)
    {
        $resultat = DB::table('vm_postes_comptables', 'va')
            ->leftJoin('vm_ville as vv', 'vv.ville_id', '=', 'va.ville_id')
            ->leftJoin('vm_structure_region as ta', 'ta.structure_region_id', '=', 'va.structure_region_id')
            ->select(['va.poste_comptable_id', 'va.libelle', 'va.code',
                'va.statut', 'vv.libelle as ville', 'ta.libelle_court as structure_region'])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.pcomptables', compact('resultat',));
    }

    public function modepaiement(Request $request,)
    {
        $resultat = DB::table('vm_mode_paiement', 'va')
            ->select(['va.mode_paiement_id', 'va.libelle'])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.modepaiement', compact('resultat',));

    }

    public function formejuridiques(Request $request,)
    {
        $resultat = DB::table('vm_forme_juridique', 'va')
            ->select(['va.forme_juridique_id', 'va.libelle', 'va.code_libelle'])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.formejuridiques', compact('resultat',));

    }

    public function communes(Request $request,)
    {
        $resultat = DB::table('vm_commune', 'va')
            ->leftJoin('vm_ville as vv', 'vv.ville_id', '=', 'va.ville_id')
            ->leftJoin('vm_departement as vd', 'vd.departement_id', '=', 'vv.departement_id')
            ->leftJoin('vm_region_administrative as vr', 'vr.region_administrative_id', '=', 'vd.region_id')
            ->leftJoin('vm_district as vi', 'vi.district_id', '=', 'vr.district_id')
            ->select(['va.commune_id', 'va.libelle',
                      'vv.libelle as ville',
                      'vd.libelle as departement',
                      'vr.libelle as region',
                      'vi.libelle as district'
            ])
            ->orderByDesc('va.libelle')
            ->get();
        return view('parametrevue.communes', compact('resultat',));
    }
}

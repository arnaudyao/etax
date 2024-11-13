<?php

namespace App\Http\Controllers;

use App\Helpers\Fonction;
use App\Models\DocumentLicenceTelecharger;
use App\Models\FondementLegale;
use App\Models\Licences;
use App\Models\LicencesFormeJuridique;
use App\Models\MotifPenalite;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Hash;
use Auth;
use Psy\Util\Str;
use Session;
use Image;
use File;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function statistiques()
    {
        $RsMinistere = \Illuminate\Support\Facades\DB::table('vue_recherche_general','v')
            ->select(['v.id_ministere','v.code_ministere','v.libelle_ministere', DB::raw('count(*) as nb')])
            ->leftJoin('ministere', 'ministere.id_ministere', '=', 'v.id_ministere')
            ->groupBy('v.id_ministere','v.libelle_ministere','ministere.priorite_ministere','v.code_ministere')
            ->orderBy('ministere.priorite_ministere' )
            ->get();
        $RsSa = \Illuminate\Support\Facades\DB::table('vue_recherche_general','v')
            ->select(['v.id_secteur_activite','v.libelle_secteur_activite', DB::raw('count(*) as nb')])
            ->leftJoin('secteur_activite', 'secteur_activite.id_secteur_activite', '=', 'v.id_secteur_activite')
            ->groupBy('v.id_secteur_activite','v.libelle_secteur_activite','secteur_activite.priorite_secteur_activite')
            ->orderBy('secteur_activite.priorite_secteur_activite' )
            ->get();

        $RsNa = \Illuminate\Support\Facades\DB::table('vue_recherche_general','v')
            ->select(['v.id_nat_licence','v.libelle_nat_licence', DB::raw('count(*) as nb')])
            ->leftJoin('nature_licences', 'nature_licences.id_nat_licence', '=', 'v.id_nat_licence')
            ->groupBy('v.id_nat_licence','v.libelle_nat_licence','nature_licences.libelle_nat_licence')
            ->orderBy('nature_licences.libelle_nat_licence' )
            ->get();

        $RsCa = \Illuminate\Support\Facades\DB::table('vue_recherche_general','v')
            ->select(['v.id_categorie_licence','v.libelle_categorie_licence','categorie_licence.description_categorie_licence', DB::raw('count(*) as nb')])
            ->leftJoin('categorie_licence', 'categorie_licence.id_categorie_licence', '=', 'v.id_categorie_licence')
            ->groupBy('v.id_categorie_licence','v.libelle_categorie_licence','categorie_licence.description_categorie_licence','categorie_licence.libelle_categorie_licence')
            ->orderBy('categorie_licence.libelle_categorie_licence' )
            ->get();
        return view('statistiques',compact('RsMinistere','RsSa','RsNa','RsCa'));
    }
    public function resultat(Request $request)
    {
        $resultats = [];
        if ($request->isMethod('post')) {
            $valRech = trim($request->search);
            $resultats= Fonction::getRecherche($valRech);
        }
        return view('resultat', compact('resultats'));
    }

    public function resultatsa(Request $request)
    {
        $resultats = [];
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['id_secteur_activite'] == 0) {
                $id_secteur_activite = '0';
            } else {
                $id_secteur_activite = $data['id_secteur_activite'];
            }
            if ($data['id_sous_secteur'] == 0) {
                $id_sous_secteur = '0';
            } else {
                $id_sous_secteur = $data['id_sous_secteur'];
            }
            $ValReqSa = [];
            if (($id_secteur_activite != 0)) $ValReqSa = [['id_secteur_activite', '=', $id_secteur_activite]];
            $ValReqSsa = [];
            if (($id_sous_secteur != 0)) $ValReqSsa = [['id_sous_secteur', '=', $id_sous_secteur]];

            $ReqOk = array_merge($ValReqSsa, $ValReqSa);
            //  DB::connection()->enableQueryLog();

            $resultats = DB::table('vue_recherche_general', 'vf')
                ->where($ReqOk)
                ->orderBy('vf.libelle_licences')
                ->get();
        }
        return view('resultat', compact('resultats'));
    }

    public function resultatavancer(Request $request)
    {
        $resultats = [];
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['id_ministere'] == 0) {
                $id_ministere = '0';
            } else {
                $id_ministere = $data['id_ministere'];
            }
            if ($data['id_structure'] == 0) {
                $id_structure = '0';
            } else {
                $id_structure = $data['id_structure'];
            }
            if ($data['id_secteur_activite'] == 0) {
                $id_secteur_activite = '0';
            } else {
                $id_secteur_activite = $data['id_secteur_activite'];
            }
            if ($data['id_sous_secteur'] == 0) {
                $id_sous_secteur = '0';
            } else {
                $id_sous_secteur = $data['id_sous_secteur'];
            }
            if ($data['id_nature_licence'] == 0) {
                $id_nature_licence = '0';
            } else {
                $id_nature_licence = $data['id_nature_licence'];
            }
            if ($data['id_categorie_licence'] == 0) {
                $id_categorie_licence = '0';
            } else {
                $id_categorie_licence = $data['id_categorie_licence'];
            }
            $ValReqMi = [];
            if (($id_ministere != 0)) $ValReqMi = [['id_ministere', '=', $id_ministere]];
            $ValReqS = [];
            if (($id_structure != 0)) $ValReqS = [['id_structure', '=', $id_structure]];
            $ValReqSa = [];
            if (($id_secteur_activite != 0)) $ValReqSa = [['id_secteur_activite', '=', $id_secteur_activite]];
            $ValReqSsa = [];
            if (($id_sous_secteur != 0)) $ValReqSsa = [['id_sous_secteur', '=', $id_sous_secteur]];
            $ValReqN = [];
            if (($id_nature_licence != 0)) $ValReqN = [['id_nat_licence', '=', $id_nature_licence]];
            $ValReqC = [];
            if (($id_categorie_licence != 0)) $ValReqC = [['id_categorie_licence', '=', $id_categorie_licence]];
            $valRech = trim($request->search);

            $ReqOk = array_merge($ValReqMi, $ValReqC, $ValReqN, $ValReqSsa, $ValReqSa, $ValReqS);
            if ($valRech != '') {

                $resultats= Fonction::getRecherche($valRech);
            } else {
                $resultats = DB::table('vue_recherche_general', 'vf')
                    ->where($ReqOk)
                    ->orderBy('vf.libelle_licences')
                    ->get();
            }
        }
        return view('resultat', compact('resultats'));
    }

    public function resultatsecteuractivite(Request $request, $id)
    {
        $id = \App\Helpers\Crypt::UrldeCrypt($id);
        $resultats = [];
        $resultats = DB::table('vue_recherche_general')
            ->Where('id_secteur_activite', '=', $id)
            ->get();
        return view('resultat', compact('resultats'));
    }

    public function resultatsoussecteuractivite(Request $request, $id)
    {
        $id = \App\Helpers\Crypt::UrldeCrypt($id);
        $resultats = [];
        $resultats = DB::table('vue_recherche_general')
            ->Where('id_sous_secteur', '=', $id)
            ->get();
        return view('resultat', compact('resultats'));
    }

    public function resultatdetail(Request $request, $id, $onglet = null)
    {

        $id = \App\Helpers\Crypt::UrldeCrypt($id);
        $licence = Licences::join('nature_licences', 'licences.id_nat_licence', 'nature_licences.id_nat_licence')
            ->join('type_licence', 'licences.id_type_licence', 'type_licence.id_type_licence')
            ->join('categorie_licence', 'licences.id_categorie_licence', 'categorie_licence.id_categorie_licence')
            ->join('sous_secteur_activite', 'licences.id_sous_secteur', 'sous_secteur_activite.id_sous_secteur')
            ->join('nature_actionnariat', 'licences.id_nat_actionnariat', 'nature_actionnariat.id_nat_actionnariat')
            ->join('autorite_de_delivrance', 'licences.id_autorite_deliv', 'autorite_de_delivrance.id_autorite_deliv')
            ->join('structure', 'autorite_de_delivrance.id_structure', 'structure.id_structure')
            ->join('ministere', 'structure.id_ministere', 'ministere.id_ministere')
            ->join('secteur_activite', 'sous_secteur_activite.id_secteur_activite', 'secteur_activite.id_secteur_activite')
            ->where([['id_licences', '=', $id]])
            ->first();
        $documenttelecharger = DocumentLicenceTelecharger::where([['id_licences', '=', $id]])->get();
        $motifpenalite = MotifPenalite::where([['id_licences', '=', $id]])->get();
        $fondementlegale = FondementLegale::where([['id_licences', '=', $id]])->get();
        $licencesformejuridique = LicencesFormeJuridique::join('forme_juridique', 'licences_forme_juridique.id_forme_juridique', 'forme_juridique.id_forme_juridique')
            ->where([['id_licences', '=', $id]])->get();
        return view('detail',
            compact('licence', 'documenttelecharger', 'onglet',
                'motifpenalite', 'fondementlegale', 'licencesformejuridique'
            )
        );
    }

    public function downloadPDF($id)
    {
        $id = \App\Helpers\Crypt::UrldeCrypt($id);
        $licence = Licences::join('nature_licences', 'licences.id_nat_licence', 'nature_licences.id_nat_licence')
            ->join('type_licence', 'licences.id_type_licence', 'type_licence.id_type_licence')
            ->join('categorie_licence', 'licences.id_categorie_licence', 'categorie_licence.id_categorie_licence')
            ->join('sous_secteur_activite', 'licences.id_sous_secteur', 'sous_secteur_activite.id_sous_secteur')
            ->join('nature_actionnariat', 'licences.id_nat_actionnariat', 'nature_actionnariat.id_nat_actionnariat')
            ->join('autorite_de_delivrance', 'licences.id_autorite_deliv', 'autorite_de_delivrance.id_autorite_deliv')
            ->join('structure', 'autorite_de_delivrance.id_structure', 'structure.id_structure')
            ->join('ministere', 'structure.id_ministere', 'ministere.id_ministere')
            ->join('secteur_activite', 'sous_secteur_activite.id_secteur_activite', 'secteur_activite.id_secteur_activite')
            ->where([['id_licences', '=', $id]])
            ->first();
        $documenttelecharger = DocumentLicenceTelecharger::where([['id_licences', '=', $id]])->get();
        $motifpenalite = MotifPenalite::where([['id_licences', '=', $id]])->get();
        $fondementlegale = FondementLegale::where([['id_licences', '=', $id]])->get();
        $licencesformejuridique = LicencesFormeJuridique::join('forme_juridique', 'licences_forme_juridique.id_forme_juridique', 'forme_juridique.id_forme_juridique')
            ->where([['id_licences', '=', $id]])->get();        //$show = Disneyplus::find($id);
        $pdf = PDF::loadView('pdf', compact('licence', 'documenttelecharger', 'motifpenalite', 'fondementlegale', 'licencesformejuridique'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Fiche_signaletique_' . $id . '.pdf');
    }
}

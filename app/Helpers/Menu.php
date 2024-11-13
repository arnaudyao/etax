<?php


namespace App\Helpers;
use App\Models\Logo;
use App\Models\Ministere;

use Illuminate\Support\Facades\DB;

class Menu
{
    public static function get_menu($idutil)
    {
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->orderBy('menu.priorite_menu', 'ASC')
            ->orderBy('sousmenu.priorite_sousmenu', 'ASC')
            ->get();
        $tabl = [];
        foreach ($resulat as $ligne) {
            $tabl[$ligne->id_menu][] = $ligne;
        }
        return (isset($tabl) ? $tabl : '');
    }

    public static function get_menu_profil($idutil)
    {
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        $naroles = $roles->name;
        return (isset($naroles) ? $naroles : '');
    }

    public static function get_code_menu_profil($idutil)
    {
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        $coderoles = $roles->code_roles;
        return (isset($coderoles) ? $coderoles : '');
    }

    public  static function randStrGen($mode = null, $len = null)
        {
            $result = "";
            if($mode == 1):
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            elseif($mode == 2):
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            elseif($mode == 3):
                $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
            elseif($mode == 4):
                $chars = "0123456789";
            endif;

            $charArray = str_split($chars);
            for($i = 0; $i < $len; $i++) {
                    $randItem = array_rand($charArray);
                    $result .="".$charArray[$randItem];
            }
            return $result;
        }

      public static function get_logo()
      {
          $logof = Logo::where([['flag_logo','=',true],['valeur','=','LOGO']])->first();
          return (isset($logof) ? $logof : '');
      }

    public static function get_info_couleur()
    {
        $logof = Logo::where([['flag_logo','=',true],['valeur','=','COULEUR MENU HAUT']])->first();
        return (isset($logof) ? $logof : '');
    }

    public static function getMenuFrontSecteurActivite()
    {
        $liste1 = DB::table('secteur_activite','v')
            ->select(['v.id_secteur_activite', 'v.libelle_secteur_activite'])
            ->orderBy('v.priorite_secteur_activite' )
            ->get();
        return (isset($liste1) ? $liste1 : '');
    }
    public static function getMenuFrontSousSecteurActivite($idSA)
    {
        $liste2 = DB::table('sous_secteur_activite','v')
            ->select(['v.id_secteur_activite','v.id_sous_secteur', 'v.libelle_sous_secteur'])
            ->where([['v.id_secteur_activite', '=', $idSA]])
            ->orderBy('v.priorite_sous_secteur' )
            ->get();
        return (isset($liste2) ? $liste2 : '');
    }
    public static function getMenuFrontNature($idSSA)
    {
          $liste3 = DB::table('nature_licences','v')
            ->select(['v.id_nat_licence', 'v.libelle_nat_licence'])
            ->orderBy('v.libelle_nat_licence' )
            ->get();
        return (isset($liste3) ? $liste3 : '');
    }

    public static function getMenuFrontMinistere()
    {
        $liste4 = DB::table('ministere','v')
            ->select(['v.id_ministere', 'v.libelle_ministere'])
            ->orderBy('v.priorite_ministere' )
            ->get();
        return (isset($liste4) ? $liste4 : '');
    }
    public static function getTotaldeslicence()
    {
        $liste110 = DB::table('vue_recherche_general','v')
            ->select(DB::raw('count(*) as nbLicence'))
            ->first();

        return (isset($liste110) ? $liste110 : '');
    }
    public static function getMenuFrontStructure($idM)
    {
        $liste5 = DB::table('vue_recherche_general','v')
            ->select(['v.id_ministere','v.id_structure','v.libelle_structure'])
            ->orderByDesc('v.libelle_structure' )
            ->where([['v.id_ministere', '=', $idM]])
            ->groupBy('v.id_ministere','v.id_structure','v.libelle_structure')
            ->get();
        return (isset($liste5) ? $liste5 : '');
    }

    public static function getMinstereListes(){
        $ministeres = Ministere::where('flag_ministere', '=', true)->orderBy('priorite_ministere',)->get();
        return (isset($ministeres) ? $ministeres : '');
    }

    public static function getMenuFrontMinistereListe($idSS)
    {
        $liste8 = DB::table('vue_recherche_general','v')
            ->select(['v.id_ministere', 'v.libelle_ministere'])
            ->where([['v.id_secteur_activite', '=', $idSS]])
            ->groupBy('v.id_ministere','v.libelle_ministere')
            ->orderByDesc('v.libelle_ministere' )
            ->get();
        return (isset($liste8) ? $liste8 : '');
    }

    public static function getMenuFrontSaListe($idSa)
    {
        $liste1000 = DB::table('vue_recherche_general','v')
            ->select(['v.id_secteur_activite', 'v.libelle_secteur_activite'])
            ->where('v.id_ministere', '=', $idSa)
            ->groupBy('v.id_secteur_activite','v.libelle_secteur_activite')
            ->orderBy('v.libelle_secteur_activite' )
            ->get();
        return (isset($liste1000) ? $liste1000 : '');
    }
    public static function getMenuFrontNatureLicence()
    {
        $liste7 = DB::table('nature_licences','v')
            ->select(['v.id_nat_licence', 'v.libelle_nat_licence'])
            ->orderBy('v.libelle_nat_licence' )
            ->get();
        return (isset($liste7) ? $liste7 : '');
    }
    public static function getMenuFrontCatLicence()
    {
        $liste8 = DB::table('categorie_licence','v')
            ->select(['v.id_categorie_licence', 'v.libelle_categorie_licence', 'v.description_categorie_licence'])
            ->orderBy('v.libelle_categorie_licence' )
            ->get();

        return (isset($liste8) ? $liste8 : '');
    }
}

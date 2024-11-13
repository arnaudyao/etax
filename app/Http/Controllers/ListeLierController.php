<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSelect;
use App\Helpers\Menu;

class ListeLierController extends Controller
{
    public function getSecteurActiviteListe($secteur = 0)
    {
        $Salistes = Menu::getMenuFrontSaListe($secteur);
        return $Salistes;
    }
    public function getMinistereListe($soussecteur = 0)
    {
        $struturelistes = Menu::getMenuFrontMinistereListe($soussecteur);
        return $struturelistes;
    }

    public function getStructureListe($ministere = 0)
    {
        $struturelistes = Menu::getMenuFrontStructure($ministere);
        return $struturelistes;
    }

    public function getSousSecteurliste($secteur = 0)
    {
        $services = Menu::getMenuFrontSousSecteurActivite($secteur);
        return $services;

    }
}

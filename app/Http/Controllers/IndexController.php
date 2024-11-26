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
    public function downloadPDF($id)
    {
    }
}

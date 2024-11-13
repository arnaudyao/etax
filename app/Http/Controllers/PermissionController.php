<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;


class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Permissions::all();
        return view('permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SousMenu = DB::table('sousmenu')->where('is_valide', '=', true)->orderBy('libelle',)->get();
        $SousMenuList = "<option value='' > -- Sélectionner --</option>";
        foreach ($SousMenu as $comp) {
            $SousMenuList .= "<option value='" . $comp->id_sousmenu . "'   >" . strtoupper($comp->libelle) . " </option>";
        }
        return view('permissions.create', compact('SousMenuList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            if($request->input('is_valide') == true){
                $valide = 1;
            }else{
                $valide = 0;
            }
        request()->validate([
            'name' => 'required',
            'lib_permission' => 'required',
            'id_sousmenu' => 'required',
        ]);
        Permissions::create([
            'name' => $request->input('name'),
            'lib_permission' => $request->input('lib_permission'),
            'id_sousmenu' => $request->input('id_sousmenu'),
            'is_valide' => $valide,
            'guard_name' => 'web'
        ]);
        return redirect()->route('permissions.index')
            ->with('success', 'Succes : Enregistrement réussi.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Permissions $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Permissions $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissions $permission)
    {
        $SousMenu = DB::table('sousmenu')->orderBy('libelle',)->get();
        $SousMenuList = "<option value='' > -- Sélectionner --</option>";
        foreach ($SousMenu as $comp) {
            if ($comp->id_sousmenu == $permission->id_sousmenu) {$val = 'selected=selected';} else { $val = '';}
            $SousMenuList .= "<option value='" . $comp->id_sousmenu . "'  $val >" . strtoupper($comp->libelle) . " </option>";
        }
        return view('permissions.edit', compact('permission', 'SousMenuList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permissions $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permissions $permission)
    {

                if($request->input('is_valide') == true){
                    $valide = 1;
                }else{
                    $valide = 0;
                }
        request()->validate([
            'name' => 'required',
            'lib_permission' => 'required',
            'id_sousmenu' => 'required',
        ]);
        $permission->update([
            'name' => $request->input('name'),
            'lib_permission' => $request->input('lib_permission'),
            'id_sousmenu' => $request->input('id_sousmenu'),
            'is_valide' => $valide
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Succes : Mise à jour réussie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Permissions $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissions $permission)
    {
        //$permission->delete();


        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}

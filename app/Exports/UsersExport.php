<?php

namespace App\Exports;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       /*$result = DB::select(
                DB::raw(
                    'select vspf.num_prod , vspf.lib_prod , vspf.code_prod , vspf.code_barre_prod , 
                    vspf.lib_sousfam , vspf.lib_fam , vspf.niveau_alert ,  sum(vspf.qte_sortie) as qte_sortie,
                    sum(vspf.qte_entree)  as qte_entree, (sum(vspf.qte_entree)-sum(vspf.qte_sortie)) as stock  
                    from vue_stock_prod_fam vspf 
                    group by vspf.num_prod , vspf.lib_prod , vspf.code_prod , vspf.code_barre_prod , 
                    vspf.lib_sousfam , vspf.lib_fam , vspf.niveau_alert
                            ')
                    );*/
//dd($result);exit;
       // return $result;
        return DB::table('vue_stock_prod_reel')->get();
        
        /*DB::table('vue_stock_prod_fam')
        ->select( 'num_prod','code_prod','code_barre_prod', 'lib_prod','lib_sousfam','lib_fam',
            DB::raw('SUM(qte_sortie) as qte_sortie' ),
            DB::raw('SUM(qte_entree) as qte_entree' ) )
        ->groupBy('num_prod', 'lib_prod','code_prod', 'code_barre_prod','lib_sousfam','lib_fam' )
        ->get();*/        
        
        
    }
}

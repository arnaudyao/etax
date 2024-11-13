<?php

namespace App\Imports;

use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProduitImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produit([
            'num_sousfam' => $row['num_sousfam'],
            'code_prod' => $row['code_prod'],
            'lib_prod' => $row['lib_prod'],
            'prix_ht' => $row['prix_ht'],
            'flag_prod' => $row['flag_prod'],
            'code_barre_prod' => $row['code_barre_prod'],
            'flag_tva_prod' => $row['flag_tva_prod']
        ]);
    }
}

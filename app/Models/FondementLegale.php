<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_fondement_legale
 * @property float $id_licences
 * @property string $libelle_fondement_legale
 * @property string $fichier_fondement_legale
 * @property boolean $flag_fondement_legale
 * @property string $updated_at
 * @property string $created_at
 * @property Licence $licence
 */
class FondementLegale extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fondement_legale';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_fondement_legale';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'float';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_licences', 'libelle_fondement_legale', 'fichier_fondement_legale', 'flag_fondement_legale', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licence()
    {
        return $this->belongsTo('App\Models\Licence', 'id_licences', 'id_licences');
    }
}

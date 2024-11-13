<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_motif_penalite
 * @property float $id_licences
 * @property string $libelle_motif_penalite
 * @property boolean $flag_motif_penalite
 * @property string $updated_at
 * @property string $created_at
 * @property Licence $licence
 */
class MotifPenalite extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'motif_penalite';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_motif_penalite';

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
    protected $fillable = ['id_licences', 'libelle_motif_penalite', 'flag_motif_penalite', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licence()
    {
        return $this->belongsTo('App\Models\Licence', 'id_licences', 'id_licences');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_lfj
 * @property float $id_forme_juridique
 * @property float $id_licences
 * @property string $updated_at
 * @property string $created_at
 * @property FormeJuridique $formeJuridique
 * @property Licences $licence
 */
class LicencesFormeJuridique extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'licences_forme_juridique';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_lfj';

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
    protected $fillable = ['id_forme_juridique', 'id_licences', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formeJuridique()
    {
        return $this->belongsTo('App\Models\FormeJuridique', 'id_forme_juridique', 'id_forme_juridique');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licence()
    {
        return $this->belongsTo('App\Models\Licences', 'id_licences', 'id_licences');
    }
}

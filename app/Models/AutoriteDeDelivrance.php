<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_autorite_deliv
 * @property float $id_structure
 * @property float $id_user
 * @property string $libelle_autorite_deliv
 * @property boolean $flag_autorite_deliv
 * @property string $created_at
 * @property string $updated_at
 * @property Licence[] $licences
 * @property Structure $structure
 */
class AutoriteDeDelivrance extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'autorite_de_delivrance';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_autorite_deliv';

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
    protected $fillable = ['id_structure', 'id_user', 'libelle_autorite_deliv', 'flag_autorite_deliv', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\Licence', 'id_autorite_deliv', 'id_autorite_deliv');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure()
    {
        return $this->belongsTo('App\Models\Structure', 'id_structure', 'id_structure');
    }
}

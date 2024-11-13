<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_structure
 * @property float $id_ministere
 * @property float $id_user
 * @property string $libelle_structure
 * @property boolean $flag_structure
 * @property string $updated_at
 * @property string $created_at
 * @property Ministere $ministere
 * @property AutoriteDeDelivrance[] $autoriteDeDelivrances
 */
class Structure extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'structure';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_structure';

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
    protected $fillable = ['id_ministere', 'id_user', 'libelle_structure', 'flag_structure', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ministere()
    {
        return $this->belongsTo('App\Models\Ministere', 'id_ministere', 'id_ministere');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function autoriteDeDelivrances()
    {
        return $this->hasMany('App\Models\AutoriteDeDelivrance', 'id_structure', 'id_structure');
    }
}

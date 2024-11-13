<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_nat_actionnariat
 * @property string $libelle_nat_actionnariat
 * @property boolean $flag_nat_actionnariat
 * @property string $updated_at
 * @property string $created_at
 * @property Licence[] $licences
 */
class NatureActionnariat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nature_actionnariat';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_nat_actionnariat';

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
    protected $fillable = ['libelle_nat_actionnariat', 'flag_nat_actionnariat', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\Licence', 'id_nat_actionnariat', 'id_nat_actionnariat');
    }
}

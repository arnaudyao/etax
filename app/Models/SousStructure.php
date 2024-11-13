<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_sous_structure
 * @property float $id_structure
 * @property string $libelle_sous_structure
 * @property float $id_user
 * @property boolean $flag_sous_structure
 * @property string $updated_at
 * @property string $created_at
 * @property Licence[] $licences
 * @property Structure $structure
 */
class SousStructure extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sous_structure';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sous_structure';

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
    protected $fillable = ['id_structure', 'libelle_sous_structure', 'id_user', 'flag_sous_structure', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\Licence', 'id_sous_structure', 'id_sous_structure');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure()
    {
        return $this->belongsTo('App\Models\Structure', 'id_structure', 'id_structure');
    }
}

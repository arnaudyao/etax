<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_forme_juridique
 * @property string $libelle_forme_juridique
 * @property boolean $flag_forme_juridique
 * @property string $updated_at
 * @property string $created_at
 * @property LicencesFormeJuridique[] $licencesFormeJuridiques
 */
class FormeJuridique extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'forme_juridique';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_forme_juridique';

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
    protected $fillable = ['libelle_forme_juridique', 'flag_forme_juridique', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licencesFormeJuridiques()
    {
        return $this->hasMany('App\Models\LicencesFormeJuridique', 'id_forme_juridique', 'id_forme_juridique');
    }
}

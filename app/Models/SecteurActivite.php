<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_secteur_activite
 * @property string $libelle_secteur_activite
 * @property float $id_user
 * @property boolean $flag_secteur_activite
 * @property string $updated_at
 * @property string $created_at
 * @property SousSecteur[] $sousSecteurs
 */
class SecteurActivite extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'secteur_activite';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_secteur_activite';

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
    protected $fillable = ['libelle_secteur_activite', 'id_user', 'flag_secteur_activite', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sousSecteurs()
    {
        return $this->hasMany('App\Models\SousSecteur', 'id_secteur_activite', 'id_secteur_activite');
    }
}

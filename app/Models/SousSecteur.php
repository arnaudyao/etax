<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_sous_secteur
 * @property float $id_secteur_activite
 * @property string $libelle_sous_secteur
 * @property boolean $flag_sous_secteur
 * @property string $updated_at
 * @property string $created_at
 * @property SecteurActivite $secteurActivite
 * @property Licence[] $licences
 */
class SousSecteur extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sous_secteur_activite';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sous_secteur';

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
    protected $fillable = ['id_secteur_activite', 'libelle_sous_secteur', 'flag_sous_secteur', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secteurActivite()
    {
        return $this->belongsTo('App\Models\SecteurActivite', 'id_secteur_activite', 'id_secteur_activite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\Licence', 'id_sous_secteur', 'id_sous_secteur');
    }
}

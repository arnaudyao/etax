<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_categorie_licence
 * @property string $libelle_categorie_licence
 * @property string $description_categorie_licence
 * @property float $id_user
 * @property boolean $flag_categorie_licence
 * @property string $updated_at
 * @property string $created_at
 * @property Licence[] $licences
 */
class CategorieLicence extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_licence';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_categorie_licence';

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
    protected $fillable = ['libelle_categorie_licence', 'description_categorie_licence', 'id_user', 'flag_categorie_licence', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\Licence', 'id_categorie_licence', 'id_categorie_licence');
    }
}

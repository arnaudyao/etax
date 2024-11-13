<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_nat_licence
 * @property string $libelle_nat_licence
 * @property boolean $flag_nat_licence
 * @property string $updated_at
 * @property string $created_at
 * @property LicenceS[] $licences
 */
class NatureLicences extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_nat_licence';

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
    protected $fillable = ['libelle_nat_licence', 'flag_nat_licence', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences()
    {
        return $this->hasMany('App\Models\LicenceS', 'id_nat_licence', 'id_nat_licence');
    }
}

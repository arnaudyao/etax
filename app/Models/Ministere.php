<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_ministere
 * @property float $id_user
 * @property string $libelle_ministere
 * @property string $code_ministere
 * @property boolean $flag_ministere
 * @property string $updated_at
 * @property string $created_at
 * @property Structure[] $structures
 */
class Ministere extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ministere';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ministere';

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
    protected $fillable = ['id_user', 'libelle_ministere','code_ministere', 'flag_ministere', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function structures()
    {
        return $this->hasMany('App\Models\Structure', 'id_ministere', 'id_ministere');
    }
}

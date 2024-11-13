<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_type_document
 * @property string $libelle_type_document
 * @property float $id_user
 * @property boolean $flag_type_document
 * @property string $updated_at
 * @property string $created_at
 * @property DocumentLicenceTelecharger[] $documentLicenceTelechargers
 */
class TypeDocument extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'type_document';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_type_document';

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
    protected $fillable = ['libelle_type_document', 'id_user', 'flag_type_document', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentLicenceTelechargers()
    {
        return $this->hasMany('App\Models\DocumentLicenceTelecharger', 'id_type_document', 'id_type_document');
    }
}

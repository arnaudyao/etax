<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_document_licence
 * @property float $id_licences
 * @property string $libelle_document_licence
 * @property string $fichier_document_licence
 * @property string $type_document_licence
 * @property boolean $flag_document_licence
 * @property string $updated_at
 * @property string $created_at
 * @property Licence $licence
 */
class DocumentLicenceTelecharger extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'document_licence_telecharger';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_document_licence';

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
    protected $fillable = ['id_licences', 'libelle_document_licence',  'type_document_licence','fichier_document_licence', 'flag_document_licence', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licence()
    {
        return $this->belongsTo('App\Models\Licence', 'id_licences', 'id_licences');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_licences
 * @property float $id_nat_licence
 * @property float $id_type_licence
 * @property float $id_categorie_licence
 * @property float $id_sous_secteur
 * @property float $id_nat_actionnariat
 * @property float $id_autorite_deliv
 * @property string $libelle_licences
 * @property string $situatio_geo_licences
 * @property float $tel_licences
 * @property string $email_licences
 * @property string $site_internet_licences
 * @property string $frais_admin_montt_cfa_licence
 * @property string $capital_licence
 * @property string $caution_licence
 * @property float $montant_caution_licence
 * @property float $delai_delivrance_licence
 * @property string $periodicite_renouvelement_licen
 * @property string $inspection_renouvelement_licenc
 * @property string $delai_de_delivrance
 * @property float $frais_demande_de_renouvellement
 * @property string $frais_demande_de_renouv_rembour
 * @property string $periode_specifique_de_depot
 * @property string $periode_spec_de_depot_apeciser
 * @property string $cas_de_non_respect_des_disposit
 * @property string $cas_non_respect_penalite_apecis
 * @property string $droit_de_recours_en_cas_de_reje
 * @property string $droit_de_recours_apeciser
 * @property string $pieces_licence
 * @property string $motif_penalite_licence
 * @property string $form_juridique_licence
 * @property boolean $flag_licences
 * @property boolean $flag_valide_licence
 * @property boolean $flag_publier
 * @property AutoriteDeDelivrance $autoriteDeDelivrance
 * @property CategorieLicence $categorieLicence
 * @property NatureActionnariat $natureActionnariat
 * @property NatureLicences $natureLicence
 * @property SousSecteur $sousSecteurActivite
 * @property TypeLicence $typeLicence
 * @property MotifPenalite[] $motifPenalites
 * @property LicencesFormeJuridique[] $licencesFormeJuridiques
 * @property FondementLegale[] $fondementLegales
 * @property DocumentLicenceTelecharger[] $documentLicenceTelechargers
 */
class Licences extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_licences';

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
    protected $fillable = ['id_nat_licence', 'id_type_licence', 'id_categorie_licence',
        'id_sous_secteur', 'id_nat_actionnariat', 'id_autorite_deliv', 'libelle_licences', 'situatio_geo_licences',
        'tel_licences', 'email_licences', 'site_internet_licences', 'frais_admin_montt_cfa_licence',
        'capital_licence', 'caution_licence', 'montant_caution_licence', 'delai_delivrance_licence',
        'periodicite_renouvelement_licen', 'inspection_renouvelement_licenc', 'delai_de_delivrance',
        'frais_demande_de_renouvellement', 'frais_demande_de_renouv_rembour', 'periode_specifique_de_depot',
        'periode_spec_de_depot_apeciser', 'cas_de_non_respect_des_disposit', 'cas_non_respect_penalite_apecis',
        'droit_de_recours_en_cas_de_reje', 'droit_de_recours_apeciser', 'flag_licences', 'flag_valide_licence',
        'pieces_licence','motif_penalite_licence','form_juridique_licence','flag_publier'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autoriteDeDelivrance()
    {
        return $this->belongsTo('App\Models\AutoriteDeDelivrance', 'id_autorite_deliv', 'id_autorite_deliv');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorieLicence()
    {
        return $this->belongsTo('App\Models\CategorieLicence', 'id_categorie_licence', 'id_categorie_licence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natureActionnariat()
    {
        return $this->belongsTo('App\Models\NatureActionnariat', 'id_nat_actionnariat', 'id_nat_actionnariat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natureLicence()
    {
        return $this->belongsTo('App\Models\NatureLicences', 'id_nat_licence', 'id_nat_licence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sousSecteurActivite()
    {
        return $this->belongsTo('App\Models\SousSecteur', 'id_sous_secteur', 'id_sous_secteur');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeLicence()
    {
        return $this->belongsTo('App\Models\TypeLicence', 'id_type_licence', 'id_type_licence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function motifPenalites()
    {
        return $this->hasMany('App\Models\MotifPenalite', 'id_licences', 'id_licences');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licencesFormeJuridiques()
    {
        return $this->hasMany('App\Models\LicencesFormeJuridique', 'id_licences', 'id_licences');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fondementLegales()
    {
        return $this->hasMany('App\Models\FondementLegale', 'id_licences', 'id_licences');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentLicenceTelechargers()
    {
        return $this->hasMany('App\Models\DocumentLicenceTelecharger', 'id_licences', 'id_licences');
    }
}

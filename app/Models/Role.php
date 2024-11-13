<?php

namespace App\Models;

use App\ModelHasRole;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 * @property ModelHasRole[] $modelHasRoles
 * @property \App\Permissions[] $permissions
 */
class Role extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelHasRoles()
    {
        return $this->hasMany('App\ModelHasRole');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_has_permissions','role_id','permission_id');
    }
     /**
     * The sousmenus that belong to the user.
     */
    public function sousmenus()
    {
        return $this->belongsToMany('App\Models\Sousmenus', 'role_has_sousmenus');
    }
}

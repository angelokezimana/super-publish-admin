<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function publications()
    {
        return $this->hasMany('App\Models\Publication', 'created_by');
    }

    public function hasPermissionTo($permission)
    {
        $permission = Permission::with('roles')->whereName($permission)->get();

        foreach ($permission as $perm_name) {
            return $this->hasPermissionThroughRole($perm_name);
        }
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->role->name == $role->name) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyPermission(array $permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {

            if ($this->hasPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }
}

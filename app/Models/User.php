<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'user_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['permissions', 'user_avatar_full_path'];

    //========== Appends Attributes ======================\\
    public function getPermissionsAttribute()
    {
        return optional($this->loadMissing('role')->role)->permissions;
    }

    public function getEmailAttribute()
    {
        return $this->user_email;
    }

    public function getUserAvatarFullPathAttribute()
    {
        $avatar = $this->user_avatar ?? getOptionValue('default_avatar');

        return asset("storage/$avatar");
    }
    //========== #END# Appends Attributes ===================\\


    //========== Relations ======================\\
    public function role()
    {
        return $this->belongsTo(Role::class, 'fk_role_id', 'role_id')->roleDescription();
    }
    public function personalInfo()
    {
        return $this->hasOne(Profile::class, 'fk_user_id', 'user_id')
                    ->join('flags', 'fk_user_country', '=', 'flag_id');
    }
    //========== #END# Relations ======================\\

    //=========== Scopes =============================\\
    public function scopeSearch($query, $request)
    {
        if ($s = $request->query('s')) {
            return $query->where('user_name', 'LIKE', '%' . $s . '%')->orWhere('user_email', 'LIKE', '%' . $s . '%');
        }
    }
    //=========== #END# Scopes =============================\\

    public function hasPermissions($permission)
    {
        $permissions = is_array($permission) ? $permission : [$permission];
        $userPermissions = $this->permissions;
        foreach ($permissions as $per) {
            if (!in_array($per, $userPermissions)) {
                return false;
            }
        }
        return true;
    }
}

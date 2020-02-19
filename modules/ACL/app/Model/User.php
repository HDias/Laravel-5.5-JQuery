<?php

namespace ACL\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Artesaos\Defender\Traits\HasDefender;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use App\Model\Scope\SoftDeleting;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mailer\Notification\ResetPasswordNotification;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable implements Auditable, UserResolver
{
    use Notifiable, \OwenIt\Auditing\Auditable, SoftDeletes, HasDefender, SoftCascadeTrait, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * http://laravel-auditing.com/docs/5.0/general-configuration
     *
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeleting());
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function finAllUserWithoutDeveloper()
    {
        return self::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name', 'NOT LIKE', 'Desenvolvedor')
            ->orWhereNull('roles.name')
            ->select('users.*');
    }
}

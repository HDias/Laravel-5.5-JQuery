<?php

namespace Mailer\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 */
class MailActivation extends Model
{
    protected $primaryKey   = null;
    public $incrementing    = false;

    protected $fillable = [
        'email',
        'token'
    ];

    protected $casts = [
        'email' => 'string',
        'token' => 'string'
    ];

    public function getActivationByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getActivationByToken($token)
    {
        return $this->where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        return $this->where('token', $token)->delete();
    }
}

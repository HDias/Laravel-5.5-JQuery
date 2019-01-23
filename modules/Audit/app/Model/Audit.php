<?php

namespace Audit\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $event
 * @property int $auditable_id
 * @property string $auditable_type
 * @property string $old_values
 * @property string $new_values
 * @property string $url
 * @property string $ip_address
 * @property string $user_agent
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Audit extends Model
{
    use SoftDeletes;

    public function userName()
    {
        $result = $this->select('users.name')
            ->join('users', 'audits.user_id', '=', 'users.id')
            ->where('audits.id', $this->id)
            ->first();
            
        return $result ? $result->name : '';
    }

    public function audits()
    {
        return $this->morphMany(Audit::class, 'auditable');
    }

}

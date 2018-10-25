<?php

namespace App\Model;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use App\Model\Scope\SoftDeleting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @property \Carbon\Carbon $deleted_at
 */
class BaseModel extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable, SoftCascadeTrait;

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeleting());
    }
}

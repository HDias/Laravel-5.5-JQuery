<?php

namespace App\Model\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftDeleting extends SoftDeletingScope
{
    protected $userType;

    public function __construct()
    {
        $this->userType = $this->verifyUser();
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($this->userType) {
            $builder->whereNull($model->getQualifiedDeletedAtColumn());
        }
    }

    // Se Usuário for Desenvolvedor ou Suporte não adicionar deleted_at IS NULL
    private function verifyUser()
    {
        return !\Defender::hasRoles([config('defender.restore_role'), config('defender.superuser_role')]);
    }
}

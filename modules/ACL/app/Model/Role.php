<?php

namespace ACL\Model;

use ACL\Service\SuperUser;
use Artesaos\Defender\Facades\Defender;
use Artesaos\Defender\Role as BaseRole;

class Role extends BaseRole
{
    use SuperUser;

    protected $table = 'defender.roles';

    public static function selectOption()
    {
        $model = self::select(['id', 'name AS text'])->orderBy('text');
        if (!Defender::hasRole($superUserRole = config('defender.superuser_role'))) {
            return $model->where('name', '<>', $superUserRole)->pluck('text', 'id');
        }

        return $model->pluck('text', 'id');
    }

    public function findAllByPermissionOrUser(int $permission = null, int $user = null)
    {
        $query = $this->select('defender.roles.*')->orderBy('defender.roles.updated_at', 'DESC');

        if (!$this->isSuperUser()) {
            $query = $this->where('defender.roles.name', '<>', config('defender.superuser_role'));
        }

        if (!$permission && !$user) {
            return $query;
        }

        !$permission ?: $query = $this->findByPermission($permission);
        !$user ?: $query = $this->findByUser($user);

        return $query;
    }

    /**
     * Retorna a Roles relacionadas a uma Permission
     *
     * @param int $permissionId
     * @return mixed
     */
    public function findByPermission(int $permissionId)
    {
        return $this->join('defender.permission_role', 'defender.roles.id', '=', 'defender.permission_role.role_id')
            ->where('defender.permission_role.permission_id', $permissionId);
    }

    public function findByUser(int $userId)
    {
        return $this->join('defender.role_user', 'defender.roles.id', '=', 'defender.role_user.role_id')
            ->where('defender.role_user.user_id', $userId);
    }

    public function findToSelect(int $userId)
    {
        return $this->select('defender.roles.id', 'defender.roles.name as label')
            ->join('defender.role_user', 'defender.roles.id', '=', 'defender.role_user.role_id')
            ->where('defender.role_user.user_id', $userId);
    }
}

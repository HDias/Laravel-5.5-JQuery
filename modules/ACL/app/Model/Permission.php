<?php

namespace ACL\Model;

use Artesaos\Defender\Permission as BasePermission;

class Permission extends BasePermission
{
    protected $table = 'defender.permissions';

    public static function selectOption()
    {
        return self::select(['id', 'readable_name AS text'])->orderBy('text')->pluck('text', 'id');
    }

    public function findAllByRoleOrUser(int $limit, int $role = null, int $user = null)
    {
        $query = $this->orderBy('defender.permissions.updated_at', 'DESC');

        if (!$role && !$user) {
            return $query->paginate($limit);
        }

        !$role ?: $query = $this->findByRole($role);
        !$user ?: $query = $this->findByUser($user);

        return $query->paginate($limit);
    }

    public function findByRole(int $roleId)
    {
        return $this->join('defender.permission_role', 'defender.permissions.id', '=', 'defender.permission_role.permission_id')
            ->where('permission_role.role_id', $roleId);
    }

    public function findByUser(int $userId)
    {
        return $this->join('defender.permission_user', 'defender.permissions.id', '=', 'defender.permission_user.permission_id')
            ->where('defender.permission_user.user_id', $userId);
    }
}

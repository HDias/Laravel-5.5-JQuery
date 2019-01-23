<?php

namespace ACL\Service;

use ACL\Model\Role;
use GeDuc\Model\User;

class UserService
{
    public function allUserCheckRoles()
    {
        if (\Defender::hasRoles([config('defender.superuser_role')])) {
            return app('acl.model.user')->orderBy('name');
        }

        return app('acl.model.user')->finAllUserWithoutDeveloper();
    }

    public function allRoleWithoutDeveloper()
    {
        if (\Defender::hasRoles([config('defender.superuser_role')])) {
            return Role::select('id', 'name as label');
        }

        return Role::select('id', 'name as label')
            ->whereNotIn('name', ['Desenvolvedor','Estudante']);
    }
}

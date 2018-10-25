<?php

if (!function_exists('isChecked')) {

    function isChecked(int $id, array $listIds)
    {
        return in_array($id, $listIds) ? 'checked' : '';
    }
}

if (!function_exists('transAcl')) {
    /**
     * Retorna a tracução para permission da ACl
     * Se of rsuper user retorna o shield
     *
     * @param string $prefix
     * @param string value
     * @param boolean $force
     * @return string | \Illuminate\Contracts\Translation\Translator|null|string
     */
    function transAcl(string $prefix, string $value, bool $force = false)
    {
        $key = 'acl.' . $prefix . '.' . $value;

        if ($force) {
            return trans($key);
        }

        // Se for superuser ou não existir tradução retorna a informação do banco
        if (\Defender::hasRole(config('defender.superuser_role')) || !\Lang::has($key)) {
            return $value;
        }

        return trans($key);
    }
}

if (!function_exists('getId')) {

    /**
     * Se o usuário for desenvolvedor (superuser) retorna o ID do objeto
     * Se o usuário não for desenvolvedor (superuser) retorna o indice passado
     *
     * @param int $id
     * @param int $index
     * @return int
     */
    function getId(int $id, int $index)
    {
        // Se for superuser ou não existir tradução retorna a informação do banco
        if (\Defender::hasRole(config('defender.superuser_role'))) {
            return $id;
        }

        return $index;
    }
}

// Já existe no helper de app
// if (!function_exists('flash')) {

//     /**
//      * @param string $type
//      * @param string $message
//      * @param string|null $exceptionMessage
//      * @return mixed
//      */
//     function flash(string $type, string $message, string $exceptionMessage = null)
//     {
//         *
//          * Se for na env local e existir message de exception exibe-a
         
//         if (\App::environment('local') && !is_null($exceptionMessage)) {
//             request()->session()->flash('alert', ['type' => $type, 'message' => $exceptionMessage]);

//             return true;
//         }

//         request()->session()->flash('alert', ['type' => $type, 'message' => $message]);
//     }
// }

if (!function_exists('isEnv')) {

    /**
     * Retorna true se o env for o passado
     *
     * @param string $envName
     * @return bool
     */
    function isEnv(string $envName)
    {
        if (\App::environment($envName)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('acl_path')) {
    /**
     * Retorna o caminho para a pasta raiz da ACL
     * @param null $path
     * @return string
     */
    function acl_path($path = null)
    {
        return $path ? __DIR__ . DIRECTORY_SEPARATOR . $path : __DIR__;
    }
}

if (! function_exists('hasPermission')) {
    /**
     * Check if the current user has some permissions.
     *
     * @param string|array $permissions
     *
     * @return bool
     */
    function hasPermission($permissions)
    {
        if (! is_array($permissions)) {
            $permissions = func_get_args();
        }

        $user = defender()->getUser();

        if ($user->isSuperUser()) {
            return true;
        }

        if (is_null($user)) {
            return false;
        }

        $userPermissions = $user->getPermissions($user->id);

        $matches = array_intersect($permissions, $userPermissions);

        return count($matches) > 0;
    }
}

if (!function_exists('menuActive')) {
    /**
     * @param array $routeName
     * @param $currentRoute
     * @param int $level
     * @return string
     */
    function menuActive(array $routeName, $currentRoute, $level = 3)
    {
        $isCurrentRoute = in_array($currentRoute, $routeName);

        if ($level == 1 && !$isCurrentRoute) {
            return 'collapsed';
        }

        if ($level == 2 && $isCurrentRoute) {
            return 'show';
        }

        if ($level == 3 && $isCurrentRoute) {
            return 'active';
        }

        return '';
    }
}
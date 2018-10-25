<?php

namespace ACL\Service;

use Artesaos\Defender\Facades\Defender;

trait SuperUser
{
    /**
     * Verifica se Usuário logado é superadmin
     * Perfil de superadmin está no arquivo de configuração em config/audith.php
     *
     * @return bool
     */
    private function isSuperUser() : bool
    {
        return Defender::hasRole(config('defender.superuser_role'));
    }


    /**
     * Verifica se Usuário logado é suporte
     * Perfil de suporte está no arquivo de configuração em config/audith.php
     *
     * @return bool
     */
    private function isSuporte() : bool
    {
        return Defender::hasRole(config('defender.restore_role'));
    }
}

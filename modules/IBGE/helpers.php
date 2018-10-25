<?php

if (!function_exists('ibge_path')) {
    /**
     * Retorna o caminho para a pasta raiz de ibge
     * @param null $path
     * @return string
     */
    function ibge_path($path = null)
    {
        return $path ? __DIR__ . DIRECTORY_SEPARATOR . $path : __DIR__;
    }
}

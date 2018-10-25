<?php

if (!function_exists('audit_path')) {
    /**
     * Retorna o caminho para a pasta raiz de Select
     * @param null $path
     * @return string
     */
    function audit_path($path = null)
    {
        return $path ? __DIR__ . DIRECTORY_SEPARATOR . $path : __DIR__;
    }
}

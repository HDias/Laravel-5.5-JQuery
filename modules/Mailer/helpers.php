<?php

if (!function_exists('mailer_path')) {
    /**
     * Retorna o caminho para a pasta raiz de Select
     * @param null $path
     * @return string
     */
    function mailer_path($path = null)
    {
        return $path ? __DIR__ . DIRECTORY_SEPARATOR . $path : __DIR__;
    }
}
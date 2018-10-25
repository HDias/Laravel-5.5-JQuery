<?php

if (!function_exists('select_path')) {
    /**
     * Retorna o caminho para a pasta raiz de Select
     * @param null $path
     * @return string
     */
    function select_path($path = null)
    {
        return $path ? __DIR__ . DIRECTORY_SEPARATOR . $path : __DIR__;
    }
}

if (!function_exists('getOptions')) {

    function getOptions(string $slug, $orderBy = 'label', $order = 'ASC')
    {
        return app('select.model.option')->findBySlug($slug, $orderBy, $order)->get();
    }
}

if (!function_exists('getOption')) {

    function getOption(string $slug, $id)
    {
        if(! $id) {
            return '';
        }

        return app('select.model.option')
            ->select('label')
            ->where('slug', $slug)
            ->where('id', $id)
            ->first();
    }
}

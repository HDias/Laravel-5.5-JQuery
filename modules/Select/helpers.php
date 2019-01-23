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

    /**
     * Retorna uma array de Option para o select
     *
     * @param string $className
     * @param string $orderBy
     * @param string $order
     * @return array
     */
    function getOptions(string $className, $orderBy = 'Value', $order = 'ASC')
    {
        $class = 'Select\\Model\\' . ucfirst($className);
        $method = '::orderBy' . ucfirst($orderBy);

        return call_user_func_array($class . $method, [$order]);
    }
}

if (!function_exists('getOption')) {

    /**
     * O valor salvo no Banco deve ser o VALUE do array
     * Por isso aqui retonna somente o value para conseguir setar a option no select
     *
     * @param string $className
     * @param $value
     * @return mixed|string
     */
    function getOption(string $className, $value)
    {
        if(! $value) {
            return '';
        }

        $class = 'Select\\Model\\' . ucfirst($className);

        return call_user_func_array($class . '::findKeyByValue', [$value]);
    }
}

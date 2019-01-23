<?php

namespace Select\Model;

interface BasicEnum
{
    /**
     * Ordena pela key do array
     *
     * @return array
     */
    public static function orderByKey();

    /**
     * Ordena pelo value do array
     *
     * @return array
     */
    public static function orderByValue();

    /**
     * Retorna uma KEY  de um elemento do array
     *
     * @param string $value
     * @return mixed
     */
    public static function findKeyByValue(string $value);
}

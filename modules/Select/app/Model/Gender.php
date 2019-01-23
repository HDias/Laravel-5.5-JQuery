<?php

namespace Select\Model;

final class Gender implements BasicEnum
{
    private const MASCULINO = 1;
    private const FEMININO = 2;

    private const TEXTS = [
        self::MASCULINO => 'Masculino',
        self::FEMININO => 'Feminino'
    ];

    /**
     * Ordena pela key do array
     *
     * @return array
     */
    public static function orderByKey($type = "ASC")
    {
        $array = self::TEXTS;

        if ($type == 'ASC') {
            ksort($array);
        }
        if ($type == 'DESC') {
            krsort($array);
        }

        return $array;
    }

    /**
     * Ordena pelo value do array
     *
     * @return array
     */
    public static function orderByValue($type = "ASC")
    {
        $array = self::TEXTS;

        if ($type == 'ASC') {
            asort($array);
        }
        if ($type == 'DESC') {
            arsort($array);
        }

        return $array;
    }
}
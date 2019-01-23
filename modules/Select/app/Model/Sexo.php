<?php

namespace Select\Model;

final class Sexo implements BasicEnum
{
    private const MASCULINO = 1;
    private const FEMININO = 2;

    private const TEXTS = [
        self::MASCULINO => 'Masculino',
        self::FEMININO => 'Feminino'
    ];

    /**
     * @inheritdoc
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
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
    public static function findKeyByValue(string $value)
    {
        return array_search($value, self::TEXTS);;
    }
}
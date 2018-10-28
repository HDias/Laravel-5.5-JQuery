<?php
/**
 * Created by PhpStorm.
 * User: horecio
 * Date: 12/04/18
 * Time: 22:56
 */

namespace App\Http\Controllers;

trait Paginator
{
    /**
     * Para Utilizar como limit de paginação
     * Retorna o valor do query param per_page
     * Se não houver retorna o valor default
     *
     * @param int $default
     * @return integer
     */
    private function getLimit($default = 10)
    {
        // Evita que retorne valor null ou que págine em mais de 100
        if (!app('request')->input("per_page") || app('request')->input("per_page") > 100) {
            return $default;
        }

        return app('request')->input("per_page");
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: horecio
 * Date: 25/04/18
 * Time: 18:03
 */

namespace Mailer;

trait Tokenizer
{
    /**
     * Gera Token
     * @return string
     */
    public function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

}
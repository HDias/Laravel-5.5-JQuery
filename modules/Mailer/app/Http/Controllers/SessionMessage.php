<?php

namespace Mailer\Http\Controllers;

trait SessionMessage
{
    private function setMessage($user)
    {
        $body = "<p><strong>Olá</strong> {$user->name}, enviamos um email para <strong>{$user->email}.</strong></p><p>Acesse seu email e clique em ATIVAR</p><p>Obrigado!</p>";
        request()->session()->flash('message', [
            'title' => 'Sucesso!',
            'message' => $body
        ]);
    }
}
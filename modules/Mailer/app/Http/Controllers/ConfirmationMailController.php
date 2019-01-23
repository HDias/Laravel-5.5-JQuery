<?php

namespace Mailer\Http\Controllers;

class ConfirmationMailController extends Controller
{
    public function emailNotConfirmed()
    {
        if(\Auth::user()->status_cad == '2-Email Confirmado') {
            return redirect()->route('cars');
        }

        return view('mailer.confirmationMail.valide-email');
    }

    public function showRegisterUser($token)
    {
        $user = app('mailer.login_activation')->activateUser($token);

        if (!$user) {
            $body = "<p>Usuário não encontrado ou talvez você já o ativou.</p>";
            request()->session()->flash('message', [
                'title' => 'OPS!',
                'message' => $body
            ]);
        } else {
            $body = "<p><strong>Olá</strong> {$user->name}, seu cadastro foi ativado.</p><p>Obrigado!</p>";
            request()->session()->flash('message', [
                'title' => 'Sucesso!',
                'message' => $body
            ]);
        }

        return redirect()->route('login');
    }
}

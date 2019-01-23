<?php

namespace Mailer;

class LoginActivation
{
    use Tokenizer;

    protected $resendAfter = 1;

    private $subject = 'Ativação do cadastro - TrocarFacil.online';

    private $templatePath = 'vendor.mailer.activation';

    private static $attributes = [];

    /**
     * Envia email de ativação de conta para SystemUser
     *
     * @param $user
     * @return array
     */
    public function sendActivationMail($user)
    {
        // Evita enviar uma serie de email seguidos por uma mesmo user
        if (! $this->shouldSend($user)) {
            return [
                'success' => false,
                'message' => "Enviou um email a menos de {$this->resendAfter} minutos(s)"
            ];
        }

        $mailActivation = $this->createToken($user);

        $user->sendConfirmMailNotification($mailActivation->token);
    }

    /**
     * Insere dado Dados na tabela logan_activation
     *
     * @param $user
     * @return mixed
     */
    public function createToken(EmailInterface $user) // NO lugar de CreateActivation
    {
        app('mailer.model.mail_activation')->where('email', $user->getEmail())->delete();

        return app('mailer.model.mail_activation')->create([
            'email' => $user->getEmail(),
            'token' => $this->getToken()
        ]);
    }

    /**
     * Ativa Usuário
     * @param $token
     * @return null
     */
    public function activateUser($token)
    {
        $activation = app('mailer.model.mail_activation')->getActivationByToken($token);

        if ($activation === null) {
            return false;
        }

        $user = app('model.user')->where('email', $activation->email)->first();
        $user->status_cad = '2-Email Confirmado';
        $user->save();

        app('mailer.model.mail_activation')->deleteActivation($token);

        return $user;
    }

    /**
     * Verifica se já foi enviado em email de atiavação nas ultimas $resendAfter minutos
     *
     * @param EmailInterface $user
     * @return bool
     */
    private function shouldSend(EmailInterface $user)
    {
        $activation = app('mailer.model.mail_activation')->getActivationByEmail($user->getEmail());

        return $activation === null || strtotime($activation->created_at . $this->resendAfter . 'minute') < time();
    }
}

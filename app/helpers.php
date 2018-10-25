<?php


if (!function_exists('flash')) {

    /**
     * @param string $type
     * @param string $message
     * @param string|null $exceptionMessage
     * @return mixed
     */
    function flash(string $type, string $message, string $exceptionMessage = null)
    {
        /**
         * Se for na env local e existir message de exception exibe-a
         */
        if (\App::environment('local') && !is_null($exceptionMessage)) {
            request()->session()->flash('alert', ['type' => $type, 'message' => $exceptionMessage]);

            return true;
        }

        request()->session()->flash('alert', ['type' => $type, 'message' => $message]);
    }
}

if (!function_exists('isInvalid')) {

    function isInvalid($errors, $inputName)
    {
        return $errors->has($inputName) ? ' is-invalid' : '';
    }
}

if (!function_exists('isCardInvalid')) {

    function isCardInvalid($errors, $inputName)
    {
        return $errors->has($inputName) ? ' alert-danger' : '';
    }
}

if (!function_exists('fone')) {
    /**
     * Formata uma string segundo a máscara de telefone
     * caso o tamanho da string seja diferente de 10 ou 11, a string será retornada sem formatação
     * @param string $fone
     * @return string
     */
    function fone($fone)
    {

        if (!$fone) {
            return '';
        }

        if (strlen($fone) == 10) {
            return '(' . substr($fone, 0, 2) . ')' . substr($fone, 2, 4) . '-' . substr($fone, 6);
        }

        if (strlen($fone) == 11) {
            return '(' . substr($fone, 0, 2) . ')' . substr($fone, 2, 5) . '-' . substr($fone, 7);
        }

        return $fone;
    }
}

if (!function_exists('cpf')) {
    /**
     * Formata uma string segundo a máscara de CPF
     * caso o tamanho da string seja diferente de 11, a string será retornada sem formatação
     * @param string $cpf
     * @return string
     */
    function cpf($cpf)
    {
        if (!$cpf) {
            return '';
        }

        if (strlen($cpf) == 11) {
            return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
        }

        return $cpf;
    }
}

if (!function_exists('selectMutipleToArray')) {

    /**
     * Coloca sequência de caracteres em um array
     * @param $old
     * @return string
     */
    function selectMutipleToArray($values, $old, $fild)
    {
        $convertArray = explode(',', $old);
        $result = [];
        if (empty(old($fild)) == false) {
            for ($i = 0; $i < count($convertArray); $i++) {
                array_push($result, $values[$i]);
            }
        }
        return json_encode($result);
    }
}

if (!function_exists('showMessage')) {
    /**
     * Verifica a quantidade de vezes que logou
     *
     * @return bool
     */
    function showMessage($max = 5)
    {
        if (auth()->user()->access_count < $max) {
            return true;
        }

        return false;
    }
}

if (!function_exists('deleted_at')) {
    function deletedAt($deleted_at, $type)
    {
        if ($deleted_at != null && $type == 1) {
            return 'bg-pink-light';
        } elseif ($deleted_at != null && $type == 2) {
            return true;
        }
        return false;
    }
}

if (!function_exists('stateSelected')) {
    function stateSelected($stateID)
    {
        if (!empty($stateID)) {
            return app('model.estados')
                ->select('id', 'nome as label')
                ->where('id', $stateID)
                ->first();
        } else {
            return null;
        }

    }
}

if (!function_exists('citySelected')) {
    function citySelected($cityIBGECode)
    {
        if (!empty($cityIBGECode)) {
            return app('model.cidades')
                ->select('codigo_ibge as id', 'nome as label')
                ->where('codigo_ibge', $cityIBGECode)
                ->first();
        } else {
            return null;
        }

    }
}

if (!function_exists('valueCheck')) {
    function valueCheck($client, $old)
    {
        if ($old != null) {
            return $old;
        } elseif ($client != null) {
            return $client;
        }
        return '';
    }
}

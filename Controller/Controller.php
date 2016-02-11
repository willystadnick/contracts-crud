<?php

namespace App\Controller;

use App\View\View;

class Controller
{
    /**
     * Inicializa a aplicacao.
     */
    public function executa()
    {
        if (isset($_GET['modelo'])) {
            $classe = 'App\Controller\\' . ucfirst($_GET['modelo']);
            $modelo = new $classe();
            $acao   = 'listar';

            if (isset($_GET['acao'])) {
                $acao = $_GET['acao'];
            }

            if (!in_array($acao, get_class_methods($modelo))) {
                die('Acao nao encontrada: ' . $classe . '->' . $acao);
            }

            return $modelo->$acao();
        }

        return View::exibe('index');
    }

}

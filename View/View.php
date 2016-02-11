<?php

namespace App\View;

class View
{

    /**
     * Exibe o template com as variaveis.
     */
    public function exibe($template, $variaveis = array())
    {
        $folder = 'layout';

        if (strpos($template, '.')) {
            list($folder, $template) = explode('.', $template);
        }

        $file = __DIR__ . '/' . ucfirst($folder) . '/' . $template . '.php';

        if (!file_exists($file)) {
            die('Template nao encontrado: ' . $file);
        }

        extract($variaveis);

        include $file;
    }

}

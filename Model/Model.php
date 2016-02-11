<?php

namespace App\Model;

class Model
{
    /**
     * Conecta ao banco de dados.
     */
    public function conecta()
    {
        $link = mysql_connect(__CFG_DB_HOST__, __CFG_DB_USER__, __CFG_DB_PASS__);

        if (!$link) {
            die('Nao foi possivel conectar ao banco de dados: ' . mysql_error());
        }

        if (!mysql_select_db(__CFG_DB_BASE__)) {
            die('Nao foi possivel selecionar o banco de dados: ' . mysql_error());
        }

        return $link;
    }

    /**
     * Desconecta do banco de dados.
     */
    public function desconecta($link)
    {
        mysql_close($link);
    }

    /**
     * Executa comando no banco de dados.
     */
    public function executa($query)
    {
        $link = self::conecta();

        $resultado = mysql_query($query, $link);

        if (!$resultado) {
            die('Nao foi possivel executar no banco de dados: ' . $query . '(' . mysql_error() . ')');
        }

        $retorno = $resultado;

        if (is_resource($resultado)) {
            $retorno = array();

            while ($row = mysql_fetch_assoc($resultado)) {
                $retorno[] = $row;
            }

            mysql_free_result($resultado);
        }

        self::desconecta($link);

        return $retorno;
    }

    /**
     * Escapa os dados para o banco de dados.
     */
    public function escapa(&$dados)
    {
        $link = self::conecta();

        foreach ($dados as &$dado) {
            if (is_string($dado)) {
                $dado = mysql_real_escape_string($dado, $link);
            }
        }

        self::desconecta($link);
    }

    /**
     * Formata data para o banco de dados e tela.
     */
    public function data($data, $para)
    {
        switch ($para) {
            case 'banco':
                if (strpos($data, '/')) {
                    list($dia, $mes, $ano) = explode('/', $data);

                    return $ano . '-' . $mes . '-' . $dia;
                }
                return $data;
                break;
            case 'tela':
                if (strpos($data, '-')) {
                    list($ano, $mes, $dia) = explode('-', $data);

                    return $dia . '/' . $mes . '/' . $ano;
                }
                return $data;
                break;
            default:
                die('Formato de data invalido!');
                break;
        }

    }

    /**
     * Formata valor para o banco de dados e tela.
     */
    public function valor($valor, $para)
    {
        switch ($para) {
            case 'banco':
                if (substr($valor, -3, 1) == ',') {
                    return str_replace(',', '.', str_replace('.', '', $valor));
                }
                return $valor;
                break;
            case 'tela':
                if (substr($valor, -3, 1) == '.') {
                    return number_format($valor, 2, ',', '.');
                }
                return $valor;
                break;
            default:
                die('Formato de valor invalido!');
                break;
        }

    }

}

<?php

namespace App\Model;

use App\Model\Model;

class Contrato extends Model
{

    /**
     * Garante existencia da tabela do modelo.
     */
    public function garante()
    {
        self::executa(
            'create table if not exists `contratos` (
                `id` int(10) not null auto_increment,
                `codigo` varchar(255) not null,
                `cliente_id` int(10) not null,
                `valor` numeric(20,2) not null,
                `cadastro` date not null,
                primary key (`id`),
                unique key `contratos_codigo_unique` (`codigo`),
                key `contratos_cliente_foreign` (`cliente_id`),
                constraint `contratos_cliente_foreign` foreign key (`cliente_id`) references `clientes` (`id`)
            )'
        );
    }

    /**
     * Retorna um novo contrato.
     */
    public function novo()
    {
        return array(
            'id'         => 0,
            'codigo'     => null,
            'cliente_id' => null,
            'valor'      => '0,00',
            'cadastro'   => date('Y-m-d'),
        );
    }

    /**
     * Retorna a listagem de contratos.
     */
    public function lista()
    {
        return self::executa('select * from contratos');
    }

    /**
     * Busca contratos pelo filtro
     */
    public function busca($filtro)
    {
        return self::executa('select * from contratos where ' . $filtro);
    }

    /**
     * Acusa a existencia de contratos pelo filtro
     */
    public function existe($filtro)
    {
        $contratos = self::busca($filtro);

        if (count($contratos) > 0) {
            return true;
        }

        return false;
    }

    /**
     * Retorna o primeiro contrato pelo filtro
     */
    public function primeiro($filtro)
    {
        $contratos = self::busca($filtro);

        if (count($contratos) > 0) {
            return $contratos[0];
        }

        return false;
    }

    /**
     * Exclui o contrato pelo filtro.
     */
    public function exclui($filtro)
    {
        return self::executa('delete from contratos where ' . $filtro);
    }

    /**
     * Valida dados de contratos.
     */
    public function valida($dados)
    {
        if (!isset($dados['codigo']) || empty($dados['codigo'])) {
            $_SESSION['erro'] = 'Código invalido!';

            return false;
        }

        if (self::existe('codigo="' . $dados['codigo'] . '" and id<>' . $dados['id'])) {
            $_SESSION['erro'] = 'Código duplicado!';

            return false;
        }

        if (!isset($dados['cliente_id']) || empty($dados['cliente_id'])) {
            $_SESSION['erro'] = 'Cliente invalido!';

            return false;
        }

        if (!isset($dados['valor']) || empty($dados['valor'])) {
            $_SESSION['erro'] = "Valor invalido!";

            return false;
        }

        if (!isset($dados['cadastro']) || empty($dados['cadastro'])) {
            $_SESSION['erro'] = "Cadastro invalido!";

            return false;
        }

        return true;
    }

    /**
     * Salva dados de contratos.
     */
    public function salva($dados)
    {
        if (!self::valida($dados)) {
            return false;
        }

        self::escapa($dados);

        if ($dados['id'] > 0) {
            $query = 'UPDATE contratos SET
                codigo="' . $dados['codigo'] . '",
                cliente_id=' . $dados['cliente_id'] . ',
                valor=' . self::valor($dados['valor'], 'banco') . ',
                cadastro="' . self::data($dados['cadastro'], 'banco') . '"
                WHERE
                id=' . $dados['id'];
        } else {
            $query = 'insert into contratos (
                codigo,
                cliente_id,
                valor,
                cadastro
                ) values (
                "' . $dados['codigo'] . '",
                ' . $dados['cliente_id'] . ',
                ' . self::valor($dados['valor'], 'banco') . ',
                "' . self::data($dados['cadastro'], 'banco') . '"
                )';
        }

        return self::executa($query);
    }
}

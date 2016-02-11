<?php

namespace App\Model;

use App\Model\Model;

class Cliente extends Model
{

    /**
     * Garante existencia da tabela do modelo.
     */
    public function garante()
    {
        self::executa(
            'create table if not exists `clientes` (
                `id` int(10) not null auto_increment,
                `nome` varchar(255) not null,
                `cpf` varchar(255) not null,
                `cidade` varchar(255) not null,
                `estado` varchar(255) not null,
                `telefone` varchar(255) not null,
                `nascimento` date not null,
                primary key (`id`),
                unique key `clientes_cpf_unique` (`cpf`)
            )'
        );
    }

    /**
     * Retorna um novo cliente.
     */
    public function novo()
    {
        return array(
            'id'         => 0,
            'nome'       => null,
            'cpf'        => null,
            'cidade'     => null,
            'estado'     => null,
            'telefone'   => null,
            'nascimento' => date('Y-m-d'),
        );
    }

    /**
     * Retorna a listagem de clientes.
     */
    public function lista()
    {
        return self::executa('select * from clientes');
    }

    /**
     * Busca clientes pelo filtro
     */
    public function busca($filtro)
    {
        return self::executa('select * from clientes where ' . $filtro);
    }

    /**
     * Acusa a existencia de clientes pelo filtro
     */
    public function existe($filtro)
    {
        $clientes = self::busca($filtro);

        if (count($clientes) > 0) {
            return true;
        }

        return false;
    }

    /**
     * Retorna o primeiro cliente pelo filtro
     */
    public function primeiro($filtro)
    {
        $clientes = self::busca($filtro);

        if (count($clientes) > 0) {
            return $clientes[0];
        }

        return false;
    }

    /**
     * Exclui o cliente pelo filtro.
     */
    public function exclui($filtro)
    {
        return self::executa('delete from clientes where ' . $filtro);
    }

    /**
     * Valida dados de clientes.
     */
    public function valida($dados)
    {
        if (!isset($dados['nome']) || empty($dados['nome'])) {
            $_SESSION['erro'] = 'Nome invalido!';

            return false;
        }

        if (!isset($dados['cpf']) || empty($dados['cpf'])) {
            $_SESSION['erro'] = 'CPF invalido!';

            return false;
        }

        if (self::existe('cpf="' . $dados['cpf'] . '" and id<>' . $dados['id'])) {
            $_SESSION['erro'] = 'CPF duplicado!';

            return false;
        }

        if (!isset($dados['cidade']) || empty($dados['cidade'])) {
            $_SESSION['erro'] = "Cidade invalida!";

            return false;
        }

        if (!isset($dados['estado']) || empty($dados['estado'])) {
            $_SESSION['erro'] = 'Estado invalido!';

            return false;
        }

        if (!isset($dados['telefone']) || empty($dados['telefone'])) {
            $_SESSION['erro'] = 'Telefone invalido!';

            return false;
        }

        if (!isset($dados['nascimento']) || empty($dados['nascimento'])) {
            $_SESSION['erro'] = "Nascimento invalido!";

            return false;
        }

        return true;
    }

    /**
     * Salva dados de clientes.
     */
    public function salva($dados)
    {
        if (!self::valida($dados)) {
            return false;
        }

        self::escapa($dados);

        if ($dados['id'] > 0) {
            $query = 'UPDATE clientes SET
                nome="' . $dados['nome'] . '",
                cpf="' . $dados['cpf'] . '",
                cidade="' . $dados['cidade'] . '",
                estado="' . $dados['estado'] . '",
                telefone="' . $dados['telefone'] . '",
                nascimento="' . self::data($dados['nascimento'], 'banco') . '"
                WHERE
                id=' . $dados['id'];
        } else {
            $query = 'insert into clientes (
                nome,
                cpf,
                cidade,
                estado,
                telefone,
                nascimento
                ) values (
                "' . $dados['nome'] . '",
                "' . $dados['cpf'] . '",
                "' . $dados['cidade'] . '",
                "' . $dados['estado'] . '",
                "' . $dados['telefone'] . '",
                "' . self::data($dados['nascimento'], 'banco') . '"
                )';
        }

        return self::executa($query);
    }
}

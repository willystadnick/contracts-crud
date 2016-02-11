<?php

namespace App\Controller;

use App\Model\Cliente as ClienteModel;
use App\Model\Contrato as ContratoModel;
use App\View\View;

class Cliente
{
    /**
     * Construtor do controlador.
     */
    public function __construct()
    {
        ClienteModel::garante();
    }

    /**
     * Exibe a listagem de clientes.
     */
    public function listar()
    {
        $clientes = ClienteModel::lista();

        return View::exibe('cliente.index', compact('clientes'));
    }

    /**
     * Exibe formulario de criacao do cliente.
     */
    public function criar()
    {
        $cliente = ClienteModel::novo();

        return View::exibe('cliente.form', compact('cliente'));
    }

    /**
     * Armazena o cliente criado.
     */
    public function armazenar()
    {
        $resultado = ClienteModel::salva($_POST);

        if (!$resultado) {
            $cliente = $_POST;

            return View::exibe('cliente.form', compact('cliente'));
        }

        $_SESSION['sucesso'] = 'Cliente cadastrado com sucesso!';

        return $this->listar();
    }

    /**
     * Exibe o cliente.
     */
    public function exibir()
    {
        $cliente   = ClienteModel::primeiro('id=' . $_GET['id']);
        $contratos = ContratoModel::busca('cliente_id=' . $cliente['id']);

        return View::exibe('cliente.show', compact('cliente', 'contratos'));
    }

    /**
     * Exibe formulario de edicao do cliente.
     */
    public function editar()
    {
        $cliente = ClienteModel::primeiro('id=' . $_GET['id']);

        return View::exibe('cliente.form', compact('cliente'));
    }

    /**
     * Atualiza o cliente armazenado.
     */
    public function atualizar()
    {
        $resultado = ClienteModel::salva($_POST);

        if (!$resultado) {
            $cliente = $_POST;

            return View::exibe('cliente.form', compact('cliente'));
        }

        $_SESSION['sucesso'] = 'Cliente editado com sucesso!';

        return $this->listar();
    }

    /**
     * Remove o cliente do armazenamento.
     */
    public function excluir()
    {
        $resultado = ClienteModel::exclui('id=' . $_GET['id']);

        if (!$resultado) {
            $_SESSION['erro'] = 'Falha ao excluir cliente!';
        } else {
            $_SESSION['sucesso'] = 'Cliente excluido com sucesso!';
        }

        return $this->listar();
    }

}

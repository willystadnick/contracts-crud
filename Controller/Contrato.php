<?php

namespace App\Controller;

use App\Model\Cliente as ClienteModel;
use App\Model\Contrato as ContratoModel;
use App\View\View;

class Contrato
{
    /**
     * Construtor do controlador.
     */
    public function __construct()
    {
        ContratoModel::garante();
    }

    /**
     * Exibe a listagem de contratos.
     */
    public function listar()
    {
        $contratos = ContratoModel::lista();

        return View::exibe('contrato.index', compact('contratos'));
    }

    /**
     * Exibe formulario de criacao do contrato.
     */
    public function criar()
    {
        $contrato = ContratoModel::novo();
        $clientes = ClienteModel::lista();

        return View::exibe('contrato.form', compact('contrato', 'clientes'));
    }

    /**
     * Armazena o contrato criado.
     */
    public function armazenar()
    {
        $resultado = ContratoModel::salva($_POST);

        if (!$resultado) {
            $contrato = $_POST;
            $clientes = ClienteModel::lista();

            return View::exibe('contrato.form', compact('contrato', 'clientes'));
        }

        $_SESSION['sucesso'] = 'Contrato cadastrado com sucesso!';

        return $this->listar();
    }

    /**
     * Exibe o contrato.
     */
    public function exibir()
    {
        $contrato = ContratoModel::primeiro('id=' . $_GET['id']);

        return View::exibe('contrato.show', compact('contrato'));
    }

    /**
     * Exibe formulario de edicao do contrato.
     */
    public function editar()
    {
        $contrato = ContratoModel::primeiro('id=' . $_GET['id']);
        $clientes = ClienteModel::lista();

        return View::exibe('contrato.form', compact('contrato', 'clientes'));
    }

    /**
     * Atualiza o contrato armazenado.
     */
    public function atualizar()
    {
        $resultado = ContratoModel::salva($_POST);

        if (!$resultado) {
            $contrato = $_POST;
            $clientes = ClienteModel::lista();

            return View::exibe('contrato.form', compact('contrato', 'clientes'));
        }

        $_SESSION['sucesso'] = 'Contrato editado com sucesso!';

        return $this->listar();
    }

    /**
     * Remove o contrato do armazenamento.
     */
    public function excluir()
    {
        $resultado = ContratoModel::exclui('id=' . $_GET['id']);

        if (!$resultado) {
            $_SESSION['erro'] = 'Falha ao excluir contrato!';
        } else {
            $_SESSION['sucesso'] = 'Contrato excluido com sucesso!';
        }

        return $this->listar();
    }

}

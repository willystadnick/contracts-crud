<?php

/**
 * Inicializa a sessao.
 */
session_start();

/**
 * Define as constantes da aplicacao.
 */
define('__RAIZ__', __DIR__);
define('__CFG_DB_HOST__', 'localhost');
define('__CFG_DB_USER__', 'stormtech');
define('__CFG_DB_PASS__', 'stormtech');
define('__CFG_DB_BASE__', 'stormtech');

/**
 * Carrega os arquivos do projeto.
 */
spl_autoload_register(function ($class) {
    list($app, $recurso, $classe) = explode('\\', $class);

    $arquivo = __RAIZ__ . '/' . $recurso . '/' . $classe . '.php';

    if (!file_exists($arquivo)) {
        die('Classe nao encontrada: ' . $arquivo);
    }

    require_once $arquivo;
});

/**
 * Instancia o controlador principal.
 */
$app = new App\Controller\Controller();

/**
 * Executa a aplicacao.
 */
$app->executa();

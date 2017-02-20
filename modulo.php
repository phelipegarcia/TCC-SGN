<?php

/**
 * Carrega as classes automaticamente
 */
include_once 'autoload.php';

/**
 * Ativar a segurança do sistema
 */
new Secure();


/**
 * Limpar XSS e Injeção SQL / Verificar qual modulo e qual e qual menu é o escolhido
 */
$filter = new InputFilter();
$modulo = $filter->process($_GET["modulo"]);
$menu = $filter->process($_GET["menu"]);

switch ($modulo) {
    /**
     * Modulo Cliente
     */
    case 'cliente':
        switch ($menu) {
            /**
             * Menu consultar cliente
             */
            case 'consultar':
                include 'view/consultarCliente.php';
                break;
            /**
             * Menu inserir cliente
             */
            case 'inserir':
                include 'view/inserirCliente.php';
                break;
        }
        break;

//    case '<nome modulo>':
//        switch ($menu) {
//            #menu consultar
//            case 'consultar':
//                include '<nome da view>.php';
//                break;
//            #menu inserir
//            case 'inserir':
//                include '<nome da view>.php';
//                break;
//        }
//        break;

    default:
        /**
         * Menu principal
         */
        include 'view/principal.php';
        break;
}

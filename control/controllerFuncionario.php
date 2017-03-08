<?php

/**
 * Ativar a segurança do sistema
 */
new Secure();


/**
 * Cria o objeto de controle funcionario
 */
$objcf = new ControlFuncionario();


/**
 * CONSULTAR
 * Verficar o o botão 'consultar' foi acionado
 */
#
if (isset($_POST['consultar'])) {
    /**
     * Passar os parâmetros da consulta
     */
    $_SESSION['msg'] = '';
    $funcionarios = $objcf->consultarFuncionario($_POST["dados"]);
} else {
    /**
     * Mostrar todos os funcionarios
     */
    $funcionarios = $objcf->consultarFuncionario($_POST["dados"]);
}

/**
 * INSERIR
 * Verficar o o botão 'inserir' foi acionado
 */
if (isset($_POST["inserir"])) {
    /**
     * Apagar mensagens da variável de sessão
     */
    $_SESSION['msg'] = '';
    /**
     * Passar os parâmetros para inserir funcionario
     */
    $objcf->inserirFuncionario($_POST["dados"]);
}

/**
 * ALTERAR
 * Verficar o o botão 'alterar' foi acionado
 */
if (isset($_POST["alterar"])) {

    /**
     * Apagar mensagens da variável de sessão
     */
    $_SESSION['msg'] = '';
    /**
     * Passar os novos dados do funcionario para o controle realizar a alteração
     */
    $objcf->alterarFuncionario($_POST["dados"]);
    /**
     * Mostrar dados do funcionario selecionado depois de alterado
     */
    $funcionarios = $objcf->consultarFuncionario(null);
}

/**
 * EXCLUIR
 * Verficar o o botão 'excluir' foi acionado
 */
if (isset($_POST["excluir"])) {
    /**
     * Apagar mensagens da variável de sessão
     */
    $_SESSION['msg'] = '';
    /**
     * Passar o id do funcionario para o controle realizar a exclusão
     */
    $objcf->excluirFuncionario($_POST["dados"]);
}
?>



<?php
/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Criado em 01/01/2015
 * Classe de controle do funcionario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlFuncionario extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultarFuncionario($dados) {

        #extração de dados do funcionario
        $nome = $dados[nome][0];
        $id = $dados[id_funcionario][0];

        $objFuncionario = new modelFuncionario();
        return $listaFuncionario = $objFuncionario->consultarFuncionario($id, $nome);
    }

    /**
     * Método utilizado validar os dados dos funcionarios cadastrados e invocar o método inserirFuncionario no model
     * @access public 
     * @param Array $dados com os dados do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirFuncionario($dados) {

        #extração de dados do funcionario
        $nome = $dados[nome][0];
        $cpf = $dados[cpf][0];
        $dtNascimento = $dados[dtNascimento][0];
        $endereco = $dados[endereco][0];
        $telefone = $dados[telefone][0];
        $funcao = $dados [funcao][0];

        #invocar métódo  e passar parâmetros
        $objFuncionario = new modelFuncionario();

        #tratar a data de nascimento
        $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de inserir
        if ($objFuncionario->inserirFuncionario($nome, $cpf, $dtNascimento, $endereco, $telefone, $funcao) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";

            #redirecionar
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos funcionarios e invocar o método alterarFuncionario no model
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarFuncionario($dados) {

        #extração de dados do funcionario
        $id = $dados[id_funcionario][0];
        $nome = $dados[nome][0];
        $cpf = $dados[cpf][0];
        $dtNascimento = $dados[dtNascimento][0];
        $endereco = $dados[endereco][0];
        $telefone = $dados[telefone][0];
        $funcao = $dados [funcao][0];


        #invocar métódo  e passar parâmetros
        $objFuncionario = new modelFuncionario();

        if ($objFuncionario->alterarFuncionario($id, $nome, $cpf, $dtNascimento, $endereco, $telefone, $funcao) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";            
            #redirecionar
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            #redirecionar
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos funcionarios e invocar o método excluirFuncionario no model
     * @access public 
     * @param Int $id id do funcionario
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirFuncionario($dados) {

        #extração de dados do funcionario
        $id = $dados[id_funcionario][0];
        
        #invocar métódo  e passar parâmetros
        $objFuncionario = new modelFuncionario();

        #invocar métódo  e passar parâmetros
        if ($objFuncionario->excluirFuncionario($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: modulo.php?modulo=funcionario&menu=consultar");
        }
    }
}

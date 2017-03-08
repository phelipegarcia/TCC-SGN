<?php

/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter funcionario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ModelFuncionario extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $cpf;
    private $dtNascimento;
    private $endereço;
    private $telefone;
    private $funcao;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDtNascimento() {
        return $this->dtNascimento;
    }
    
    public function getEndereco() {
       return $this->endereço;
    }
    
    public function getTelefone() {
        return $this->telefone;
    }
    
    public function getFuncao() {
        return $this->funcao;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDtNascimento($dtNascimento) {
        $this->dtNascimento = $dtNascimento;
    }

    public function setEndereco($endereco) {
        $this->endereço = $endereco;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    
    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }
    /**
     * Método mágico para não permitir clonar a classe
     */
    public function __clone() {
        ;
    }

    /**
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    public function consultarFuncionario($id_funcionario, $nome) {

        #setar os valores
        $this->setId($id_funcionario);
        $this->setNome($nome);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_funcionario where true";

        #verificar se foi passado algum valor de $id_funcionario    
        if ($this->getId() != null) {
            $sql.= " and id=:id_funcionario";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_funcionario   
            if ($this->getId() != null) {
                $query->bindValue(':id_funcionario', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para inserir um funcionario
     * @access public 
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirFuncionario($nome, $cpf, $dtNascimento,$endereco, $telefone, $funcao) {
        #setar os dados
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDtNascimento($dtNascimento);
        $this->setEndereco($endereco);
        $this->setFuncao($funcao);
        $this->setTelefone($telefone);
        echo $this->getTelefone();

        #montar a consulta
        $sql = "INSERT INTO tb_funcionario (id,nome, cpf, dtNascimento,endereco, telefone, funcao) "
                . "VALUES (null,:nome,:cpf,:dtNascimento,:endereco,:telefone,:funcao)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':dtNascimento', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':funcao', $this->getFuncao(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para alterar um funcionario
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarFuncionario($id_funcionario, $nome, $cpf, $dtNascimento, $endereco, $telefone, $funcao) {

        #setar os dados
        $this->setId($id_funcionario);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDtNascimento($dtNascimento);
        $this->setEndereco($endereco);
        $this->setTelefone($telefone);
        $this->setFuncao($funcao);

        #montar a consulta
        $sql = "UPDATE tb_funcionario SET nome = :nome, cpf = :cpf, dtNascimento = :dtNascimento , endereco =:endereco, telefone =:telefone, funcao =:funcao WHERE id = :id_funcionario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_funcionario', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':dtNascimento', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':funcao', $this->getFuncao(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um funcionario cadastrado
     * @access public 
     * @param Int $id id do funcionario
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirFuncionario($id_funcionario) {

        #setar os dados
        $this->setId($id_funcionario);

        #montar a consulta
        $sql = "DELETE FROM tb_funcionario WHERE id=:id_funcionario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_funcionario', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}

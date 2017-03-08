CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cidade` (
  `id_cidade` INT NOT NULL,
  `nome_cidade` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_cidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`estado` (
  `id_estado` INT NOT NULL,
  `nome_estado` VARCHAR(45) NOT NULL,
  `cidade_nome_cidade` VARCHAR(45) NOT NULL,
  `cidade_id_cidade` INT NOT NULL,
  PRIMARY KEY (`id_estado`),
  INDEX `fk_estado_cidade1_idx` (`cidade_id_cidade` ASC),
  CONSTRAINT `fk_estado_cidade1`
    FOREIGN KEY (`cidade_id_cidade`)
    REFERENCES `mydb`.`cidade` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipo_pessoa` (
  `id_tipo_pessoa` INT NOT NULL,
  `tipo_pessoa_descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo_pessoa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pessoa` (
  `id_pessoa` INT NOT NULL,
  `cpf_pessoa` INT NOT NULL,
  `nome_pessoa` VARCHAR(80) NOT NULL,
  `email_pessoa` CHAR(1) NOT NULL,
  `telefone_pessoa` DECIMAL(10,0) NOT NULL,
  `data_de_nascimento_pessoa` VARCHAR(25) NOT NULL,
  `estado_id_estado_pessoa` INT NOT NULL,
  `cidade_id_cidade_pessoa` INT NOT NULL,
  `endereco_pessoa` VARCHAR(80) NOT NULL,
  `estado_civil_pessoa` VARCHAR(45) NOT NULL,
  `filhos_pessoa` VARCHAR(45) NULL,
  `tipo_pessoa_id_tipo_pessoa` INT NOT NULL,
  UNIQUE INDEX `id_pessoa_UNIQUE` (`id_pessoa` ASC),
  PRIMARY KEY (`id_pessoa`),
  INDEX `fk_pessoa_cidade1_idx` (`cidade_id_cidade_pessoa` ASC),
  INDEX `fk_pessoa_estado_1_idx` (`estado_id_estado_pessoa` ASC),
  INDEX `fk_pessoa_tipo_pessoa1_idx` (`tipo_pessoa_id_tipo_pessoa` ASC),
  CONSTRAINT `fk_pessoa_cidade1`
    FOREIGN KEY (`cidade_id_cidade_pessoa`)
    REFERENCES `mydb`.`cidade` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_estado_1`
    FOREIGN KEY (`estado_id_estado_pessoa`)
    REFERENCES `mydb`.`estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_tipo_pessoa1`
    FOREIGN KEY (`tipo_pessoa_id_tipo_pessoa`)
    REFERENCES `mydb`.`tipo_pessoa` (`id_tipo_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`notificacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`notificacao` (
  `id_notificacao` INT NOT NULL,
  `id_gestor` INT NULL,
  `id_administrador` INT NULL,
  `id_funcionario` INT NULL,
  `estatus_notificacao` VARCHAR(45) NOT NULL,
  `assunto_notificacao` VARCHAR(80) NOT NULL,
  `data_entrega_notificacao` DATETIME NOT NULL,
  `conteudo_notificacao` VARCHAR(200) NOT NULL,
  `tipo_pessoa_id_tipo_pessoa` INT NOT NULL,
  `pessoa_id_pessoa` INT NOT NULL,
  `estado_id_estado` INT NOT NULL,
  `cidade_id_cidade` INT NOT NULL,
  PRIMARY KEY (`id_notificacao`),
  INDEX `fk_notificacao_pessoa1_idx` (`pessoa_id_pessoa` ASC),
  INDEX `fk_notificacao_tipo_pessoa1_idx` (`tipo_pessoa_id_tipo_pessoa` ASC),
  INDEX `fk_notificacao_cidade1_idx` (`cidade_id_cidade` ASC),
  INDEX `fk_notificacao_estado1_idx` (`estado_id_estado` ASC),
  CONSTRAINT `fk_notificacao_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificacao_tipo_pessoa1`
    FOREIGN KEY (`tipo_pessoa_id_tipo_pessoa`)
    REFERENCES `mydb`.`tipo_pessoa` (`id_tipo_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificacao_cidade1`
    FOREIGN KEY (`cidade_id_cidade`)
    REFERENCES `mydb`.`cidade` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificacao_estado1`
    FOREIGN KEY (`estado_id_estado`)
    REFERENCES `mydb`.`estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

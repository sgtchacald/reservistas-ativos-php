CREATE TABLE LOGRADOUROS (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  cep varchar(60) NOT NULL,
  tipo varchar(60) NOT NULL,
  nome varchar(100) NOT NULL,
  nomesemnr varchar(100) NOT NULL,
  complemento varchar(100) NULL,
  idcidade int UNSIGNED NULL,
  ufcidade varchar(2) NULL,
  nomecidade varchar(100) NOT NULL,
  idibgecidade int UNSIGNED NOT NULL,
  nomebairrocidade varchar(100) NOT NULL,
  origemcadastro varchar(1),
  indstatus varchar(1) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

ALTER TABLE `LOGRADOUROS` ADD CONSTRAINT `FK_CIDADE` FOREIGN KEY (`idcidade`) REFERENCES `CIDADES` (`id`);

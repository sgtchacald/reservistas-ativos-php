CREATE TABLE CIDADES (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(120) NOT NULL,
  idestado int UNSIGNED NULL,
  uf varchar(2) NULL,
  idibge int UNSIGNED NULL,
  ddd varchar(50) NULL,
  indstatus varchar(1) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

ALTER TABLE `CIDADES` ADD CONSTRAINT `FK_ESTADO` FOREIGN KEY (`idestado`) REFERENCES `ESTADOS` (`id`);


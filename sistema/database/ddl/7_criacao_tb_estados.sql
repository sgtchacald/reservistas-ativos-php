CREATE TABLE ESTADOS (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  uf varchar(2) NULL,
  idibge int UNSIGNED NULL,
  idpais int UNSIGNED NULL,
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

ALTER TABLE `ESTADOS` ADD CONSTRAINT `FK_PAIS` FOREIGN KEY (`idpais`) REFERENCES `PAISES` (`id`);

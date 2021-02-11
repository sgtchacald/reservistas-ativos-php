CREATE TABLE PAISES (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  nomept varchar(100) NULL,
  sigla varchar(2) NULL,
  bacen int NULL,
  indstatus varchar(1) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

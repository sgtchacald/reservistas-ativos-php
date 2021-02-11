CREATE TABLE EMPRESAS (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  cnpj varchar(14) UNIQUE NOT NULL,
  email varchar(250) UNIQUE NOT NULL,
  urllogotipoanexo varchar(512)NOT NULL,
  urlsite varchar(512) NULL,
  indstatus varchar(100) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

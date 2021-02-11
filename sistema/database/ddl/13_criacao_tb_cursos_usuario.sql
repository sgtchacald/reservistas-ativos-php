CREATE TABLE CURSOS_USUARIO (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  idusuario int UNSIGNED NOT NULL,
  nome varchar(100) NOT NULL,
  nivel varchar(1) NOT NULL,
  instituicaoensino varchar(100) NOT NULL,
  urlcertificadoanexo varchar(2048) NOT NULL,
  tipocursoqualificacao varchar(1) NOT NULL,
  indstatus varchar(1) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

ALTER TABLE `CURSOS_USUARIO` ADD CONSTRAINT `FK_CURSO_USUARIO` FOREIGN KEY (`idusuario`) REFERENCES `USUARIOS` (`id`);

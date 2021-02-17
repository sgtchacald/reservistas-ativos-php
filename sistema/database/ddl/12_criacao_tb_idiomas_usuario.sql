CREATE TABLE IDIOMAS_USUARIO (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  idusuario int UNSIGNED NOT NULL,
  ididioma int UNSIGNED NOT NULL,
  nivelidioma varchar(1) NOT NULL,
  indstatus varchar(100) NOT NULL,
  dtcadastro TIMESTAMP NULL,
  dtedicao TIMESTAMP NULL,
  dtexclusao TIMESTAMP,
  usucriou int NULL,
  usueditou int NULL,
  usuexcluiu int NULL,
  PRIMARY KEY (id)
);

ALTER TABLE `IDIOMAS_USUARIO` ADD CONSTRAINT `FK_IDIOMA_USUARIO` FOREIGN KEY (`idusuario`) REFERENCES `USUARIOS` (`id`);
ALTER TABLE `IDIOMAS_USUARIO` ADD CONSTRAINT `FK_IDIOMA_IDIOMA`  FOREIGN KEY (`ididioma`)  REFERENCES `IDIOMAS`  (`id`);
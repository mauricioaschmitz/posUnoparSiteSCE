CREATE TABLE eventosInscricao(
id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
idEventos INT(11) UNSIGNED NOT NULL,
idInscricao INT(11) UNSIGNED NOT NULL,
KEY `fk_eventos` (`idEventos`),
KEY `fk_inscricao` (`idInscricao`),
CONSTRAINT `fk_eventos` FOREIGN KEY (`idEventos`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
CONSTRAINT `fk_inscricao` FOREIGN KEY (`idInscricao`) REFERENCES `inscricao` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);
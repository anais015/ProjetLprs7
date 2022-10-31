CREATE
DATABASE IF NOT EXISTS `projet_lprs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE
`projet_lprs`;

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur`
(
    `id_administrateur` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    `prenom` varchar
(
    50
) NOT NULL,
    `email` varchar
(
    50
) NOT NULL,
    `mot_de_passe` varchar
(
    255
) NOT NULL,
    PRIMARY KEY
(
    `id_administrateur`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise`
(
    `id_entreprise` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    `prenom` varchar
(
    50
) NOT NULL,
    `nom_entreprise` varchar
(
    50
) NOT NULL,
    `rue_entreprise` varchar
(
    255
) NOT NULL,
    `ville_entreprise` varchar
(
    255
) NOT NULL,
    `cp_entreprise` varchar
(
    50
) NOT NULL,
    `email` varchar
(
    50
) NOT NULL,
    `mot_de_passe` varchar
(
    255
) NOT NULL,
    `role_societe` varchar
(
    255
) NOT NULL,
    `valide` BOOLEAN NOT NULL,
    PRIMARY KEY
(
    `id_entreprise`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant`
(
    `id_etudiant` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    `prenom` varchar
(
    50
) NOT NULL,
    `domaine_etude` varchar
(
    255
) NOT NULL,
    `email` varchar
(
    50
) NOT NULL,
    `mot_de_passe` varchar
(
    255
) NOT NULL,
    `valide` BOOLEAN NOT NULL,
    PRIMARY KEY
(
    `id_etudiant`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement`
(
    `id_evenement` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    `description` varchar
(
    300
) NOT NULL,
    `date` date NOT NULL,
    `heure` time NOT NULL,
    `duree` time NOT NULL,
    `valide` BOOLEAN NOT NULL,
    `ref_salle` int
(
    11
) NOT NULL,
    `ref_entreprise` int
(
    11
) NOT NULL,
    `ref_etudiant` int
(
    11
) NOT NULL,
    `ref_administrateur` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id_evenement`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle`
(
    `id_salle` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    `nombre_place` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id_salle`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre`
(
    `id_offre` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `titre` varchar
(
    50
) NOT NULL,
    `description` varchar
(
    300
) NOT NULL,
    `domaine` varchar
(
    255
) NOT NULL,
    `accepte` BOOLEAN NOT NULL,
    `ref_type` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id_offre`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type`
(
    `id_type` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `nom` varchar
(
    50
) NOT NULL,
    PRIMARY KEY
(
    `id_type`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv`
(
    `id_rdv` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `heure` time NOT NULL,
    `lieux` varchar
(
    255
) NOT NULL,
    `accepte` BOOLEAN NOT NULL,
    `ref_etudiant` int
(
    11
) NOT NULL,
    `ref_offre` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id_rdv`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe`
(
    `ref_evenement` int
(
    11
) NOT NULL,
    `ref_etudiant` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `ref_evenement`,
    `ref_etudiant`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `creer_offre`;
CREATE TABLE IF NOT EXISTS `creer_offre`
(
    `ref_offre` int
(
    11
) NOT NULL,
    `ref_entreprise` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `ref_offre`,
    `ref_entreprise`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `postule`;
CREATE TABLE IF NOT EXISTS `postule`
(
    `ref_offre` int
(
    11
) NOT NULL,
    `ref_etudiant` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `ref_offre`,
    `ref_etudiant`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `organise`;
CREATE TABLE IF NOT EXISTS `organise`
(
    `ref_entreprise` int
(
    11
) NOT NULL,
    `ref_rdv` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `ref_rdv`,
    `ref_entreprise`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion`
(
    `id_connexion` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `heure` time NOT NULL,
    `ref_administrateur` int
(
    11
) NOT NULL,
    `ref_entreprise` int
(
    11
) NOT NULL,
    `ref_etudiant` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id_connexion`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `evenement`
    ADD CONSTRAINT `fk_evenement_salle` FOREIGN KEY (`ref_salle`) REFERENCES `salle` (`id_salle`),
ADD CONSTRAINT `fk_evenement_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`),
ADD CONSTRAINT `fk_evenement_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant`(`id_etudiant`);

ALTER TABLE `offre`
    ADD CONSTRAINT `fk_offre_type` FOREIGN KEY (`ref_type`) REFERENCES `type` (`id_type`);

ALTER TABLE `rdv`
    ADD CONSTRAINT `fk_rdv_offre` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`),
ADD CONSTRAINT `fk_rdv_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

ALTER TABLE `participe`
    ADD CONSTRAINT `fk_participe_evenement` FOREIGN KEY (`ref_evenement`) REFERENCES `evenement` (`id_evenement`),
ADD CONSTRAINT `fk_participe_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);


ALTER TABLE `creer_offre`
    ADD CONSTRAINT `fk_creer_offre_offre` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`),
ADD CONSTRAINT `fk_creer_offre_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`);

ALTER TABLE `postule`
    ADD CONSTRAINT `fk_postule_offre` FOREIGN KEY (`ref_offre`) REFERENCES `offre` (`id_offre`),
ADD CONSTRAINT `fk_postule_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

ALTER TABLE `organise`
    ADD CONSTRAINT `fk_organise_rdv` FOREIGN KEY (`ref_rdv`) REFERENCES `rdv` (`id_rdv`),
ADD CONSTRAINT `fk_organise_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`);

ALTER TABLE `connexion`
    ADD CONSTRAINT `fk_connexion_administrateur` FOREIGN KEY (`ref_administrateur`) REFERENCES `administrateur` (`id_administrateur`),
ADD CONSTRAINT `fk_connexion_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`),
ADD CONSTRAINT `fk_connexion_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant`(`id_etudiant`);

ALTER TABLE `etudiant` CHANGE `valide` `valide` BOOLEAN NOT NULL DEFAULT FALSE;
ALTER TABLE `entreprise` CHANGE `valide` `valide` BOOLEAN NOT NULL DEFAULT FALSE;

ALTER TABLE `rdv` CHANGE `ref_etudiant` `ref_etudiant` INT (11) NULL;
ALTER TABLE `rdv` CHANGE `accepte` `accepte` TINYINT(1) NULL;

ALTER TABLE `connexion` CHANGE `ref_administrateur` `ref_administrateur` INT (11) NULL;
ALTER TABLE `connexion` CHANGE `ref_entreprise` `ref_entreprise` INT (11) NULL;
ALTER TABLE `connexion` CHANGE `ref_etudiant` `ref_etudiant` INT (11) NULL;

ALTER TABLE `evenement` CHANGE `valide` `valide` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `evenement` CHANGE `ref_salle` `ref_salle` INT (11) NULL;
ALTER TABLE `evenement` CHANGE `ref_entreprise` `ref_entreprise` INT (11) NULL;
ALTER TABLE `evenement` CHANGE `ref_etudiant` `ref_etudiant` INT (11) NULL;
ALTER TABLE `evenement` CHANGE `ref_administrateur` `ref_administrateur` INT (11) NULL;

ALTER TABLE `participe` ADD `debut` DATETIME NOT NULL AFTER `ref_etudiant`, ADD `fin` DATETIME NOT NULL AFTER `debut`;

ALTER TABLE `evenement` CHANGE `date` `debut` DATETIME NOT NULL;
ALTER TABLE `evenement` CHANGE `heure` `fin` DATETIME NOT NULL;
ALTER TABLE `evenement` CHANGE `nom` `nom_event` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `evenement` DROP COLUMN duree;

DROP TRIGGER gestion_evenement_my;
DROP TRIGGER gestion_evenement_my2;
DROP TRIGGER prob_entreprise_etudiant;
DROP TRIGGER prob_entreprise_etudiant2;
DROP TRIGGER prob_participer_etudiant;


DELIMITER
&&
CREATE TRIGGER gestion_evenement_my
    BEFORE INSERT
    ON evenement
    FOR EACH ROW
BEGIN
    IF date(new.debut) <> date (new.fin) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '0';
END IF;

IF
new.debut >= new.fin THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '1';
END IF;

	IF
TIME(new.debut)<'18:00:00' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '2';
END IF;

	IF
TIME(new.debut)>'22:59:59' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '3';

END IF;

	IF
TIME(new.fin)>='23:00:00' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '4';
END IF;

	IF
WEEKDAY(new.fin)=5 or WEEKDAY(new.fin)=6 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '5';
END IF;

	IF
EXISTS (SELECT debut, fin FROM evenement WHERE debut <= NEW.debut AND fin >= NEW.fin AND ref_etudiant=NEW.ref_etudiant) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'An error occurred';
END IF;
END
&&

DELIMITER ;



DELIMITER
&&
CREATE TRIGGER gestion_evenement_my2
    BEFORE UPDATE
    ON evenement
    FOR EACH ROW
BEGIN

    IF old.valide THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = '6'; ELSE
		IF date(new.debut) <> date (new.fin) THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '0';
END IF;

IF
new.debut >= new.fin THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '1';
END IF;

		IF
TIME(new.debut)<'18:00:00' THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '2';
END IF;

		IF
TIME(new.debut)>'22:59:59' THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '3';

END IF;

		IF
TIME(new.fin)>='23:00:00' THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '4';
END IF;

		IF
WEEKDAY(new.fin)=5 or WEEKDAY(new.fin)=6 THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '5';
END IF;

		IF
EXISTS (SELECT debut, fin FROM evenement WHERE debut <= NEW.debut AND fin >= NEW.fin AND ref_etudiant=NEW.ref_etudiant) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'An error occurred';
END IF;

END IF;
END
&&

DELIMITER ;


DELIMITER
&&
CREATE TRIGGER prob_entreprise_etudiant
    BEFORE UPDATE
    ON evenement
    FOR EACH ROW
BEGIN
    IF old.ref_etudiant<>new.ref_etudiant then
		SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '7';
END IF;
IF
old.ref_entreprise<>new.ref_entreprise then
		SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '8';
END IF;

	IF
new.ref_etudiant is not null and new.ref_entreprise is not null then
		SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '9';
END IF;

	IF
new.ref_etudiant is  null and new.ref_entreprise is  null then
		SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '10';
END IF;
END
&&

DELIMITER ;




DELIMITER
&&
CREATE TRIGGER prob_entreprise_etudiant2
    BEFORE INSERT
    ON evenement
    FOR EACH ROW
BEGIN
    IF new.ref_etudiant is not null and new.ref_entreprise is not null then
		SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = '9';
END IF;

IF new.ref_etudiant is  null and new.ref_entreprise is  null then
		SIGNAL SQLSTATE '45000'
					SET MESSAGE_TEXT = '10';
END IF;

END
&&

DELIMITER ;


DELIMITER
&&
CREATE TRIGGER prob_participer_etudiant
    BEFORE INSERT
    ON participe
    FOR EACH ROW
BEGIN
    IF  EXISTS (SELECT debut, fin FROM participe WHERE debut <= NEW.debut AND fin >= NEW.fin AND ref_etudiant=NEW.ref_etudiant) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Conflict des horaires';
END IF;
END
&&

DELIMITER;

ALTER TABLE `type` ADD `ref_admin` INT NOT NULL AFTER `nom`;


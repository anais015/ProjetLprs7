CREATE DATABASE IF NOT EXISTS `projet_lprs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projet_lprs`;

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur`(
`id_administrateur` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
`prenom` varchar(50) NOT NULL,
`email` varchar(50) NOT NULL,
`mot_de_passe` varchar(255) NOT NULL,
PRIMARY KEY(`id_administrateur`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise`(
`id_entreprise` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
`prenom` varchar(50) NOT NULL,
`nom_entreprise` varchar(50) NOT NULL,
`rue_entreprise` varchar(255) NOT NULL,
`ville_entreprise` varchar(255) NOT NULL,
`cp_entreprise` varchar(50) NOT NULL,
`email` varchar(50) NOT NULL,
`mot_de_passe` varchar(255) NOT NULL,
`role_societe` varchar(255) NOT NULL,
`valide` BOOLEAN NOT NULL,
PRIMARY KEY(`id_entreprise`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant`(
`id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
`prenom` varchar(50) NOT NULL,
`domaine_etude` varchar(255) NOT NULL,
`email` varchar(50) NOT NULL,
`mot_de_passe` varchar(255) NOT NULL,
`valide` BOOLEAN NOT NULL,
PRIMARY KEY(`id_etudiant`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement`(
`id_evenement` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
`description` varchar(300) NOT NULL,
`date` date NOT NULL,
`heure` time NOT NULL,
`duree` time NOT NULL,
`valide` BOOLEAN NOT NULL,
`ref_salle` int(11) NOT NULL,
`ref_entreprise` int(11) NOT NULL,
`ref_etudiant` int(11) NOT NULL,
`ref_administrateur` int(11) NOT NULL,
PRIMARY KEY(`id_evenement`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle`(
`id_salle` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
`nombre_place` int(11) NOT NULL,
PRIMARY KEY(`id_salle`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre`(
`id_offre` int(11) NOT NULL AUTO_INCREMENT,
`titre` varchar(50) NOT NULL,
`description` varchar(300) NOT NULL,
`domaine` varchar(255) NOT NULL,
`accepte` BOOLEAN NOT NULL,
`ref_type` int(11) NOT NULL,
PRIMARY KEY(`id_offre`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type`(
`id_type` int(11) NOT NULL AUTO_INCREMENT,
`nom` varchar(50) NOT NULL,
PRIMARY KEY(`id_type`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv`(
`id_rdv` int(11) NOT NULL AUTO_INCREMENT,
`date` date NOT NULL,
`heure` time NOT NULL,
`lieux` varchar(255) NOT NULL,
`accepte` BOOLEAN NOT NULL,
`ref_etudiant` int(11) NOT NULL,
`ref_offre` int(11) NOT NULL,
PRIMARY KEY(`id_rdv`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe`(
`ref_evenement` int(11) NOT NULL,
`ref_etudiant` int(11) NOT NULL,
PRIMARY KEY(`ref_evenement`,`ref_etudiant`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `creer_offre`;
CREATE TABLE IF NOT EXISTS `creer_offre`(
`ref_offre` int(11) NOT NULL,
`ref_entreprise` int(11) NOT NULL,
PRIMARY KEY(`ref_offre`,`ref_entreprise`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `postule`;
CREATE TABLE IF NOT EXISTS `postule`(
`ref_offre` int(11) NOT NULL,
`ref_etudiant` int(11) NOT NULL,
PRIMARY KEY(`ref_offre`,`ref_etudiant`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `organise`;
CREATE TABLE IF NOT EXISTS `organise`(
`ref_entreprise` int(11) NOT NULL,
`ref_rdv` int(11) NOT NULL,
PRIMARY KEY(`ref_rdv`,`ref_entreprise`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion`(
`id_connexion` int(11) NOT NULL AUTO_INCREMENT,
`date` date NOT NULL,
`heure` time NOT NULL,
`ref_administrateur` int(11) NOT NULL,
`ref_entreprise` int(11) NOT NULL,
`ref_etudiant` int(11) NOT NULL,
PRIMARY KEY(`id_connexion`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `evenement` 
ADD CONSTRAINT `fk_evenement_salle` FOREIGN KEY(`ref_salle`) REFERENCES `salle`(`id_salle`),
ADD CONSTRAINT `fk_evenement_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`),
ADD CONSTRAINT `fk_evenement_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant`(`id_etudiant`);

ALTER TABLE `offre` 
ADD CONSTRAINT `fk_offre_type` FOREIGN KEY(`ref_type`) REFERENCES `type`(`id_type`);

ALTER TABLE `rdv` 
ADD CONSTRAINT `fk_rdv_offre` FOREIGN KEY(`ref_offre`) REFERENCES `offre`(`id_offre`),
ADD CONSTRAINT `fk_rdv_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

ALTER TABLE `participe` 
ADD CONSTRAINT `fk_participe_evenement` FOREIGN KEY(`ref_evenement`) REFERENCES `evenement` (`id_evenement`),
ADD CONSTRAINT `fk_participe_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);


ALTER TABLE `creer_offre` 
ADD CONSTRAINT `fk_creer_offre_offre` FOREIGN KEY(`ref_offre`) REFERENCES `offre`(`id_offre`),
ADD CONSTRAINT `fk_creer_offre_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`);

ALTER TABLE `postule` 
ADD CONSTRAINT `fk_postule_offre` FOREIGN KEY(`ref_offre`) REFERENCES `offre` (`id_offre`),
ADD CONSTRAINT `fk_postule_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

ALTER TABLE `organise` 
ADD CONSTRAINT `fk_organise_rdv` FOREIGN KEY(`ref_rdv`) REFERENCES `rdv` (`id_rdv`),
ADD CONSTRAINT `fk_organise_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`);

ALTER TABLE `connexion` 
ADD CONSTRAINT `fk_connexion_administrateur` FOREIGN KEY(`ref_administrateur`) REFERENCES `administrateur`(`id_administrateur`),
ADD CONSTRAINT `fk_connexion_entreprise` FOREIGN KEY(`ref_entreprise`) REFERENCES `entreprise`(`id_entreprise`),
ADD CONSTRAINT `fk_connexion_etudiant` FOREIGN KEY(`ref_etudiant`) REFERENCES `etudiant`(`id_etudiant`);

ALTER TABLE `etudiant` CHANGE `valide` `valide` BOOLEAN NOT NULL DEFAULT FALSE;
ALTER TABLE `entreprise` CHANGE `valide` `valide` BOOLEAN NOT NULL DEFAULT FALSE;







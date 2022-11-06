
-- -----------------------------------------------------
-- Schema librairie
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `librairie` DEFAULT CHARACTER SET utf8 ;
USE `librairie` ;

-- -----------------------------------------------------
-- Table `librairie`.`ville`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`ville` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `librairie`.`librairie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`librairie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(40) NOT NULL,
  `adresse` VARCHAR(50) NOT NULL,
  `code_postal` VARCHAR(15) NOT NULL,
  `ville_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_librairie_ville1_idx` (`ville_id` ASC),
  CONSTRAINT `fk_librairie_ville1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `librairie`.`ville` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `librairie`.`categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`categorie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `librairie`.`livre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`livre` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(50) NOT NULL,
  `auteur` VARCHAR(50) NOT NULL,
  `nombre_pages` DOUBLE NULL,
  `categorie_id` INT NOT NULL,
  `librairie_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livre_categorie1_idx` (`categorie_id` ASC),
  INDEX `fk_livre_librairie1_idx` (`librairie_id` ASC),
  CONSTRAINT `fk_livre_categorie1`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `librairie`.`categorie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livre_librairie1`
    FOREIGN KEY (`librairie_id`)
    REFERENCES `librairie`.`librairie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `librairie`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(25) NOT NULL,
  `prenom` VARCHAR(25) NOT NULL,
  `adresse` VARCHAR(50) NOT NULL,
  `code_postal` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `ville_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_ville1_idx` (`ville_id` ASC),
  CONSTRAINT `fk_client_ville1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `librairie`.`ville` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `librairie`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`location` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `datedebut` DATE NOT NULL,
  `datefin` DATE NOT NULL,
  `client_id` INT NOT NULL,
  `livre_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_commande_client1_idx` (`client_id` ASC),
  INDEX `fk_commande_livre1_idx` (`livre_id` ASC),
  CONSTRAINT `fk_commande_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `librairie`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commande_livre1`
    FOREIGN KEY (`livre_id`)
    REFERENCES `librairie`.`livre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Requêtes pour l'insertion des données de base
-- -----------------------------------------------------

INSERT INTO `ville` (`id`, `nom`) VALUES
(1, 'Montreal'),
(2, 'Laval'),
(3, 'Sherbrooke');

INSERT INTO `librairie` (`id`, `nom`, `adresse`, `code_postal`, `ville_id`) VALUES
(1, 'librairie Le Renard perché', '3731 Ontario St E', 'H1W 1S3', 1);

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Horreur'),
(2, 'Suspense'),
(3, 'Action'),
(4, 'Science fiction'),
(5, 'Fantaisie'),
(6, 'Fantastique'),
(7, 'Mystère');

INSERT INTO `livre` (`id`, `titre`, `auteur`, `nombre_pages`, `categorie_id`, `librairie_id`) VALUES
(1, 'Les montagnes hallucinées', 'Howard Phillips Lovecraft', 64, 1, 1),
(2, 'Cent ans de solitude', 'Gabriel Garcia Marquez', 437, 6, 1),
(3, 'L\'ombre du vent', 'Carlos Ruiz Zafón', 505, 7, 1),
(4, 'Le Comte de Monte Cristo', 'Alexandre Dumas', 800, 2, 1),
(5, 'Le Cycle de Fondation', 'Isaac Asimov', 392, 4, 1),
(6, 'Le Seigneur des Anneaux Intégral', 'J.R.R. Tolkien', 1600, 5, 1);

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `code_postal`, `phone`, `ville_id`) VALUES
(2, 'Steve', 'Bob', '323 3e Avenue', 'H7E 4D3', '(514) 423-3266', 1),
(3, 'Lana', 'Anna', '452 rue Montmorency', 'H4M 1K3', '(438) 302-4923', 2);


INSERT INTO `location` (`id`, `datedebut`, `datefin`, `client_id`, `livre_id`) VALUES
(2, '2022-11-06', '2022-11-20', 2, 3);
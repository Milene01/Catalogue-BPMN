-- MySQL Workbench Synchronization
-- Generated: 2016-08-08 19:46
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `mrrt`.`constructs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `concept` VARCHAR(255) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `type` ENUM('entity', 'relantioship') NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `publications_id` INT(11) NOT NULL,
  `example_image` VARCHAR(255) NULL DEFAULT NULL,
  `construct_conflit_id` INT(11) NOT NULL,
  `priorization` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_constructs_publications1_idx` (`publications_id` ASC),
  UNIQUE INDEX `example_image_UNIQUE` (`example_image` ASC),
  INDEX `fk_constructs_constructs1_idx` (`construct_conflit_id` ASC),
  CONSTRAINT `fk_constructs_publications1`
    FOREIGN KEY (`publications_id`)
    REFERENCES `mrrt`.`publications` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_constructs_constructs1`
    FOREIGN KEY (`construct_conflit_id`)
    REFERENCES `mrrt`.`constructs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mrrt`.`classification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(400) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mrrt`.`representation_forms` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `finalities_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_representation_forms_finalities1_idx` (`finalities_id` ASC),
  CONSTRAINT `fk_representation_forms_finalities1`
    FOREIGN KEY (`finalities_id`)
    REFERENCES `mrrt`.`classification` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mrrt`.`constructs_representation_forms` (
  `constructs_id` INT(11) NOT NULL,
  `representation_forms_id` INT(11) NOT NULL,
  PRIMARY KEY (`constructs_id`, `representation_forms_id`),
  INDEX `fk_constructs_has_representation_forms_representation_forms_idx` (`representation_forms_id` ASC),
  INDEX `fk_constructs_has_representation_forms_constructs1_idx` (`constructs_id` ASC),
  CONSTRAINT `fk_constructs_has_representation_forms_constructs1`
    FOREIGN KEY (`constructs_id`)
    REFERENCES `mrrt`.`constructs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_constructs_has_representation_forms_representation_forms1`
    FOREIGN KEY (`representation_forms_id`)
    REFERENCES `mrrt`.`representation_forms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

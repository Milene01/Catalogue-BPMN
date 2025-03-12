-- MySQL Workbench Synchronization
-- Generated: 2016-08-10 19:46
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`constructs` 
DROP FOREIGN KEY `fk_constructs_constructs1`;

ALTER TABLE `mrrt`.`constructs` 
DROP COLUMN `construct_conflict_id`,
ADD COLUMN `form` VARCHAR(255) NULL DEFAULT NULL AFTER `concept`,
DROP INDEX `fk_constructs_constructs1_idx` ;

CREATE TABLE IF NOT EXISTS `mrrt`.`conflicts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mrrt`.`conflicts_constructs` (
  `conflict_id` INT(11) NOT NULL,
  `constructs_id` INT(11) NOT NULL,
  PRIMARY KEY (`conflict_id`, `constructs_id`),
  INDEX `fk_conflict_has_constructs_constructs1_idx` (`constructs_id` ASC),
  INDEX `fk_conflict_has_constructs_conflict1_idx` (`conflict_id` ASC),
  CONSTRAINT `fk_conflict_has_constructs_conflict1`
    FOREIGN KEY (`conflict_id`)
    REFERENCES `mrrt`.`conflicts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conflict_has_constructs_constructs1`
    FOREIGN KEY (`constructs_id`)
    REFERENCES `mrrt`.`constructs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

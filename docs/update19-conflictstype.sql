-- MySQL Workbench Synchronization
-- Generated: 2016-10-10 18:54
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`conflicts` 
ADD COLUMN `conflict_category_id` INT(11) NOT NULL AFTER `description`,
ADD INDEX `fk_conflicts_conflict_category1_idx` (`conflict_category_id` ASC);

CREATE TABLE IF NOT EXISTS `mrrt`.`conflict_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(400) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE `mrrt`.`conflicts` 
ADD CONSTRAINT `fk_conflicts_conflict_category1`
  FOREIGN KEY (`conflict_category_id`)
  REFERENCES `mrrt`.`conflict_categories` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

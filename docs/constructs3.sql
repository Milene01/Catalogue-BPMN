-- MySQL Workbench Synchronization
-- Generated: 2016-08-08 21:19
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
CHANGE COLUMN `construct_conflit_id` `construct_conflict_id` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `mrrt`.`constructs` 
ADD CONSTRAINT `fk_constructs_constructs1`
  FOREIGN KEY (`construct_conflict_id`)
  REFERENCES `mrrt`.`constructs` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

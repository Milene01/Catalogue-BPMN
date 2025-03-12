-- MySQL Workbench Synchronization
-- Generated: 2016-10-10 13:53
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`descendants` 
DROP FOREIGN KEY `fk_publications_has_publications_publications1`;

ALTER TABLE `mrrt`.`descendants` 
CHANGE COLUMN `descentant_id` `descendant_id` INT(11) NOT NULL ;

ALTER TABLE `mrrt`.`descendants` 
ADD CONSTRAINT `fk_publications_has_publications_publications1`
  FOREIGN KEY (`descendant_id`)
  REFERENCES `mrrt`.`publications` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

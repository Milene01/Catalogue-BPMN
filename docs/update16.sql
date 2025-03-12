-- MySQL Workbench Synchronization
-- Generated: 2016-08-10 20:53
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`representation_forms` 
DROP FOREIGN KEY `fk_representation_forms_finalities1`;

ALTER TABLE `mrrt`.`representation_forms` 
CHANGE COLUMN `finalities_id` `classification_id` INT(11) NOT NULL ;

ALTER TABLE `mrrt`.`representation_forms` 
ADD CONSTRAINT `fk_representation_forms_finalities1`
  FOREIGN KEY (`classification_id`)
  REFERENCES `mrrt`.`classifications` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

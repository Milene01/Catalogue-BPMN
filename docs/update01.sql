-- MySQL Workbench Synchronization
-- Generated: 2016-07-07 20:27
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`publications` 
ADD COLUMN `publications_id` INT(11) NULL DEFAULT NULL AFTER `updated_at`,
ADD INDEX `fk_publications_publications1_idx` (`publications_id` ASC);

ALTER TABLE `mrrt`.`categories` 
CHANGE COLUMN `name` `name` VARCHAR(400) NOT NULL ,
CHANGE COLUMN `type` `type` ENUM('image', 'text', 'tag', 'quality') NOT NULL ;

DROP TABLE IF EXISTS `mrrt`.`tags_has_publications` ;

DROP TABLE IF EXISTS `mrrt`.`publications_authors` ;

DROP TABLE IF EXISTS `mrrt`.`authors` ;

ALTER TABLE `mrrt`.`publications` 
ADD CONSTRAINT `fk_publications_publications1`
  FOREIGN KEY (`publications_id`)
  REFERENCES `mrrt`.`publications` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

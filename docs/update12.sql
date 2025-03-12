-- MySQL Workbench Synchronization
-- Generated: 2016-07-13 10:35
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`publications_tags` 
ADD COLUMN `images_id` INT(11) NULL DEFAULT NULL AFTER `tag_id`,
ADD INDEX `fk_publications_tags_images1_idx` (`images_id` ASC);

ALTER TABLE `mrrt`.`text_fields` 
ADD COLUMN `images_id` INT(11) NULL DEFAULT NULL AFTER `category_id`,
ADD INDEX `fk_text_fields_images1_idx` (`images_id` ASC);

ALTER TABLE `mrrt`.`publications_tags` 
ADD CONSTRAINT `fk_publications_tags_images1`
  FOREIGN KEY (`images_id`)
  REFERENCES `mrrt`.`images` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `mrrt`.`text_fields` 
ADD CONSTRAINT `fk_text_fields_images1`
  FOREIGN KEY (`images_id`)
  REFERENCES `mrrt`.`images` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

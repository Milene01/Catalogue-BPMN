-- MySQL Workbench Synchronization
-- Generated: 2016-07-13 10:57
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`publications_tags` 
DROP FOREIGN KEY `fk_publications_tags_images1`;

ALTER TABLE `mrrt`.`publications_tags` 
DROP COLUMN `images_id`,
DROP INDEX `fk_publications_tags_images1_idx` ;

CREATE TABLE IF NOT EXISTS `mrrt`.`images_tags` (
  `images_id` INT(11) NOT NULL,
  `tags_id` INT(11) NOT NULL,
  PRIMARY KEY (`images_id`, `tags_id`),
  INDEX `fk_images_has_tags_tags1_idx` (`tags_id` ASC),
  INDEX `fk_images_has_tags_images1_idx` (`images_id` ASC),
  CONSTRAINT `fk_images_has_tags_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `mrrt`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_images_has_tags_tags1`
    FOREIGN KEY (`tags_id`)
    REFERENCES `mrrt`.`tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

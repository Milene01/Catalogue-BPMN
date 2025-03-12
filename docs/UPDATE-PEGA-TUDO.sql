-- MySQL Workbench Synchronization
-- Generated: 2016-07-13 11:25
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mrrt`.`publications_quality_questions` 
DROP FOREIGN KEY `fk_quality_question_has_publications_quality_question5`,
DROP FOREIGN KEY `fk_quality_question_has_publications_publications5`;

ALTER TABLE `mrrt`.`publications` 
ADD COLUMN `short_title` VARCHAR(100) NULL DEFAULT NULL AFTER `type`;

ALTER TABLE `mrrt`.`categories` 
ADD COLUMN `image_category` TINYINT(1) NOT NULL DEFAULT 0 AFTER `total_allowed`;

ALTER TABLE `mrrt`.`text_fields` 
ADD COLUMN `images_id` INT(11) NULL DEFAULT NULL AFTER `category_id`,
ADD INDEX `fk_text_fields_images1_idx` (`images_id` ASC);

ALTER TABLE `mrrt`.`publications_quality_questions` 
ADD INDEX `fk_quality_question_has_publications_publications6_idx` (`publication_id` ASC),
ADD INDEX `fk_quality_question_has_publications_quality_question6_idx` (`quality_question_id` ASC),
DROP INDEX `fk_quality_question_has_publications_quality_question5_idx` ,
DROP INDEX `fk_quality_question_has_publications_publications5_idx` ;

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

DROP TABLE IF EXISTS `mrrt`.`quality_question` ;

DROP TABLE IF EXISTS `mrrt`.`publications_quality_question` ;

ALTER TABLE `mrrt`.`text_fields` 
ADD CONSTRAINT `fk_text_fields_images1`
  FOREIGN KEY (`images_id`)
  REFERENCES `mrrt`.`images` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `mrrt`.`publications_quality_questions` 
ADD CONSTRAINT `fk_quality_question_has_publications_quality_question6`
  FOREIGN KEY (`quality_question_id`)
  REFERENCES `mrrt`.`quality_questions` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_quality_question_has_publications_publications6`
  FOREIGN KEY (`publication_id`)
  REFERENCES `mrrt`.`publications` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

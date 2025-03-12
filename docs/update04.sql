-- MySQL Workbench Synchronization
-- Generated: 2016-07-07 20:50
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `mrrt`.`quality_questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `question` TEXT NOT NULL,
  `intermediary_value` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mrrt`.`publications_quality_questions` (
  `quality_questions_id` INT(11) NOT NULL,
  `publication_id` INT(11) NOT NULL,
  `value` FLOAT(11) NOT NULL,
  PRIMARY KEY (`quality_questions_id`, `publication_id`),
  INDEX `fk_quality_question_has_publications_publications1_idx` (`publication_id` ASC),
  INDEX `fk_quality_question_has_publications_quality_question1_idx` (`quality_questions_id` ASC),
  CONSTRAINT `fk_quality_question_has_publications_quality_question1`
    FOREIGN KEY (`quality_questions_id`)
    REFERENCES `mrrt`.`quality_questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quality_question_has_publications_publications1`
    FOREIGN KEY (`publication_id`)
    REFERENCES `mrrt`.`publications` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `mrrt`.`quality_questions` ;

DROP TABLE IF EXISTS `mrrt`.`publications_quality_questions` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

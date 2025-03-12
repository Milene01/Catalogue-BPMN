-- MySQL Workbench Synchronization
-- Generated: 2016-10-10 12:28
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tiago Heineck

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `mrrt`.`descendants` (
  `descentant_id` INT(11) NOT NULL,
  `root_id` INT(11) NOT NULL,
  PRIMARY KEY (`descentant_id`, `root_id`),
  INDEX `fk_publications_has_publications_publications2_idx` (`root_id` ASC),
  INDEX `fk_publications_has_publications_publications1_idx` (`descentant_id` ASC),
  CONSTRAINT `fk_publications_has_publications_publications1`
    FOREIGN KEY (`descentant_id`)
    REFERENCES `mrrt`.`publications` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_publications_has_publications_publications2`
    FOREIGN KEY (`root_id`)
    REFERENCES `mrrt`.`publications` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

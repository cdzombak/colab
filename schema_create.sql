SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `cdz_colab`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`users` (
  `facebook_id` BIGINT UNSIGNED NOT NULL ,
  `name` VARCHAR(128) NULL ,
  PRIMARY KEY (`facebook_id`) ,
  UNIQUE INDEX `facebook_id_UNIQUE` (`facebook_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`songs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`songs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `owner` BIGINT UNSIGNED NOT NULL COMMENT 'user ID of owner' ,
  `name` VARCHAR(128) NOT NULL ,
  `deleted_time` DATETIME NULL ,
  `created_time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `song_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_songs_users1` (`owner` ASC) ,
  CONSTRAINT `fk_songs_users1`
    FOREIGN KEY (`owner` )
    REFERENCES `cdz_colab`.`users` (`facebook_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`track_versions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`track_versions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `message` VARCHAR(2048) NULL ,
  `filename` VARCHAR(40) NOT NULL ,
  `track_id` INT UNSIGNED NOT NULL ,
  `author` BIGINT UNSIGNED NOT NULL ,
  `created_time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `track_version_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_track_versions_tracks` (`track_id` ASC) ,
  INDEX `fk_track_versions_users1` (`author` ASC) ,
  UNIQUE INDEX `filename_UNIQUE` (`filename` ASC) ,
  CONSTRAINT `fk_track_versions_tracks`
    FOREIGN KEY (`track_id` )
    REFERENCES `cdz_colab`.`tracks` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_track_versions_users1`
    FOREIGN KEY (`author` )
    REFERENCES `cdz_colab`.`users` (`facebook_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`tracks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`tracks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `song_id` INT UNSIGNED NOT NULL ,
  `current_version` INT UNSIGNED NOT NULL ,
  `deleted_time` DATETIME NULL ,
  `name` VARCHAR(128) NOT NULL ,
  `created_time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `track_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tracks_songs1` (`song_id` ASC) ,
  INDEX `fk_tracks_track_versions1` (`current_version` ASC) ,
  CONSTRAINT `fk_tracks_songs1`
    FOREIGN KEY (`song_id` )
    REFERENCES `cdz_colab`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tracks_track_versions1`
    FOREIGN KEY (`current_version` )
    REFERENCES `cdz_colab`.`track_versions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`discussion_messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`discussion_messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `message` VARCHAR(2048) NOT NULL ,
  `created_time` DATETIME NOT NULL ,
  `associated_entity_type` VARCHAR(32) NOT NULL COMMENT 'Cake model name representing track, track version, or song.' ,
  `associated_entity_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`timebased_comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`timebased_comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `message` VARCHAR(1024) NOT NULL ,
  `timestamp` INT NOT NULL COMMENT 'time into the track, in seconds' ,
  `created_time` DATETIME NOT NULL ,
  `track_version_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `comment_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_timebased_comments_track_versions1` (`track_version_id` ASC) ,
  CONSTRAINT `fk_timebased_comments_track_versions1`
    FOREIGN KEY (`track_version_id` )
    REFERENCES `cdz_colab`.`track_versions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`version_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`version_tags` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(45) NOT NULL ,
  `track_version_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_version_tags_track_versions1` (`track_version_id` ASC) ,
  CONSTRAINT `fk_version_tags_track_versions1`
    FOREIGN KEY (`track_version_id` )
    REFERENCES `cdz_colab`.`track_versions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cdz_colab`.`songs_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cdz_colab`.`songs_users` (
  `facebook_id` BIGINT UNSIGNED NOT NULL ,
  `song_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`facebook_id`, `song_id`) ,
  INDEX `fk_users_has_songs_songs1` (`song_id` ASC) ,
  INDEX `fk_users_has_songs_users1` (`facebook_id` ASC) ,
  CONSTRAINT `fk_users_has_songs_users1`
    FOREIGN KEY (`facebook_id` )
    REFERENCES `cdz_colab`.`users` (`facebook_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_songs_songs1`
    FOREIGN KEY (`song_id` )
    REFERENCES `cdz_colab`.`songs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

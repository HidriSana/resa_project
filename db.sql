-- MySQL Script generated by MySQL Workbench
-- Thu Nov 16 12:58:16 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema donkey_hotel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema donkey_hotel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `donkey_hotel` DEFAULT CHARACTER SET utf8 ;
USE `donkey_hotel` ;

-- -----------------------------------------------------
-- Table `donkey_hotel`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donkey_hotel`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lastname` VARCHAR(255) NOT NULL,
  `firstname` VARCHAR(255) NOT NULL,
  `phone` INT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `isAdmin` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donkey_hotel`.`room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donkey_hotel`.`room` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `roomNumber` INT NOT NULL,
  `roomType` VARCHAR(255) NOT NULL,
  `pricePerNight` DECIMAL(10,2) NOT NULL,
  `isAvailable` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donkey_hotel`.`reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donkey_hotel`.`reservation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `startDate` DATE NOT NULL,
  `endDate` DATE NOT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
  `numberOfAdults` INT NOT NULL,
  `numberOfChildren` INT NOT NULL,
  `room_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reservation_room_idx` (`room_id` ASC) VISIBLE,
  INDEX `fk_reservation_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_reservation_room`
    FOREIGN KEY (`room_id`)
    REFERENCES `donkey_hotel`.`room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservation_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `donkey_hotel`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donkey_hotel`.`reservationOption`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donkey_hotel`.`reservationOption` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `optionName` VARCHAR(255) NOT NULL,
  `optionPrice` DECIMAL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donkey_hotel`.`reservationOption_has_reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `donkey_hotel`.`reservationOption_has_reservation` (
  `reservationOption_id` INT NOT NULL,
  `reservation_id` INT NOT NULL,
  PRIMARY KEY (`reservationOption_id`, `reservation_id`),
  INDEX `fk_reservationOption_has_reservation_reservation1_idx` (`reservation_id` ASC) VISIBLE,
  INDEX `fk_reservationOption_has_reservation_reservationOption1_idx` (`reservationOption_id` ASC) VISIBLE,
  CONSTRAINT `fk_reservationOption_has_reservation_reservationOption1`
    FOREIGN KEY (`reservationOption_id`)
    REFERENCES `donkey_hotel`.`reservationOption` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservationOption_has_reservation_reservation1`
    FOREIGN KEY (`reservation_id`)
    REFERENCES `donkey_hotel`.`reservation` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-------------------------------------------------------------------------------
--trigger
CREATE TRIGGER before_booking_insert_update
BEFORE INSERT OR UPDATE ON `donkey_hotel`.`booking`
FOR EACH ROW
BEGIN
    DECLARE roomIsReserved INT;

    SELECT `isReserved` INTO roomIsReserved
    FROM `donkey_hotel`.`room`
    WHERE `id` = NEW.`room_id`;

    IF roomIsReserved = 0 AND DATEDIFF(NEW.`checkoutDate`, NEW.`checkinDate`) > 0 THEN
        -- Everything is fine, do nothing
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid room availability or date range';
    END IF;
END;
---------------------------------
INSERT INTO room (roomType, description, pricePerNight) VALUES
('simple', 'Chambre simple confortable avec lit double et salle de bains privée.', 50.00),
('simple', 'Chambre simple avec vue sur le jardin, lit simple et salle de bains.', 45.00),
('simple', 'Chambre simple standard avec lit simple et commodités de base.', 40.00),
('simple', 'Chambre simple confortable avec lit double et salle de bains privée.', 50.00),
('simple', 'Chambre simple avec vue sur le jardin, lit simple et salle de bains.', 45.00),
('simple', 'Chambre simple standard avec lit simple et commodités de base.', 40.00),
('simple', 'Chambre simple confortable avec lit double et salle de bains privée.', 50.00),
('simple', 'Chambre simple avec vue sur le jardin, lit simple et salle de bains.', 45.00),
('simple', 'Chambre simple standard avec lit simple et commodités de base.', 40.00),


('double', 'Chambre double spacieuse avec lit queen-size et salle de bains privée.', 80.00),
('double', 'Chambre double élégante avec lit king-size et balcon privé.', 90.00),
('double', 'Chambre double avec deux lits simples et vue panoramique.', 75.00),
('double', 'Chambre double spacieuse avec lit queen-size et salle de bains privée.', 80.00),
('double', 'Chambre double élégante avec lit king-size et balcon privé.', 90.00),
('double', 'Chambre double avec deux lits simples et vue panoramique.', 75.00),

('Deluxe', 'Suite Deluxe luxueuse avec lit king-size, salon et baignoire spa.', 150.00),
('Deluxe', 'Suite Deluxe avec vue sur la mer, lit queen-size et coin salon.', 140.00),
('Deluxe', 'Suite Deluxe avec terrasse privée, lit king-size et vue imprenable.', 160.00),

('suite royale', 'Suite Royale somptueuse avec chambre à coucher, salon et jacuzzi.', 250.00),
('suite royale', 'Suite Royale avec vue panoramique, lit king-size et salle à manger privée.', 230.00),
('suite royale', 'Suite Royale avec terrasse privée, lit queen-size et piscine privée.', 270.00);
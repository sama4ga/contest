<?php
//$sql = "CREATE USER \'contest\'@\'localhost\' IDENTIFIED VIA mysql_native_password USING \'***\'GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON *.* TO \'contest\'@\'localhost\' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
//$sql = "GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON  `contest`.* TO \'contest\'@\'localhost\'";
// $con = new mysqli("localhost","contest","contest","contest");
// if ($con->connect_errno) {
//   die("Error: ".$con->connect_error);
// }



// $sql = "DROP DATABASE IF EXISTS `contest`; CREATE DATABASE `contest`;";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `contest`(
//   `contestId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `contestName` VARCHAR(40) NULL,  
//   `contestYear` YEAR NOT NULL,  
//   `contestDate` DATE NOT NULL,  
//   `contestLocation` TEXT NULL,  
//   `registrationStartDate` DATE NOT NULL,  
//   `registrationEndDate` DATE NOT NULL,  
//   `registrationStatus` ENUM('Open','Closed') NOT NULL DEFAULT 'Open',
//   `registrationFee` INT(6) NULL  DEFAULT 2000,  
//   `votingFee` INT(6) NULL  DEFAULT 100,  
//   `contestStatus` ENUM('Active','Ended') NOT NULL DEFAULT 'Active'  
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `admin`(
//   `adminId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,  
//   `email` VARCHAR(40) NOT NULL,  
//   `password` VARCHAR(255) NOT NULL  
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE `continent` (
//   `continentId` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `continent` varchar(20) DEFAULT NULL
// )";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `country`(
//   `countryId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `country` VARCHAR(40) NOT NULL,
//   `countryCapital` varchar(30) NOT NULL,
//   `continentId` int(11) NOT NULL,
//   FOREIGN KEY (`continentId`) REFERENCES `continent` (`continentId`)
//     ON DELETE CASCADE
//     ON UPDATE CASCADE 
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `state`(
//   `stateId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `state` VARCHAR(40) NOT NULL,  
//   `countryId` INT NOT NULL,
//   FOREIGN KEY (`countryId`) REFERENCES `country` (`countryId`)
//     ON DELETE CASCADE
//     ON UPDATE CASCADE 
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `contestant`(
//   `cId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `firstName` VARCHAR(40) NOT NULL,   
//   `surname` VARCHAR(40) NOT NULL,   
//   `email` VARCHAR(40) NOT NULL,   
//   `phoneNumber` VARCHAR(14) NOT NULL,   
//   `dob` date NOT NULL,   
//   `picture` VARCHAR(200) NULL,   
//   `category` VARCHAR(40) NOT NULL,   
//   `countryId` INT NOT NULL,   
//   `stateId` INT NOT NULL,   
//   `year` Year NOT NULL,
//   `status` VARCHAR(10) NULL DEFAULT 'Incomplete',
//   `tnxRef` VARCHAR(40) NULL,
//   `position` INT(4) NULL,
//   `registrationDate` DATETIME NOT NULL DEFAULT  CURRENT_TIMESTAMP,
//   FOREIGN KEY (`contestId`) REFERENCES `contest` (`contestId`)
//     ON DELETE RESTRICT
//     ON UPDATE RESTRICT,
//   FOREIGN KEY (`countryId`) REFERENCES `country` (`countryId`)
//     ON DELETE NO ACTION
//     ON UPDATE NO ACTION,  
//   FOREIGN KEY (`stateId`) REFERENCES `state` (`stateId`)
//     ON DELETE NO ACTION
//     ON UPDATE NO ACTION  
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `partner`(
//   `pId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(40) NOT NULL,   
//   `industry` VARCHAR(40) NOT NULL,   
//   `type` ENUM('Brand','Individual') NOT NULL,   
//   `email` VARCHAR(40) NULL UNIQUE,   
//   `phoneNumber` VARCHAR(14) NULL UNIQUE,   
//   `method` TEXT NOT NULL  
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `contestWinner`(
//   `winnerId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `cId` INT NOT NULL,
//   `position` INT(4) NOT NULL,
//   CONSTRAINT `fk_winner` FOREIGN KEY (`cId`) REFERENCES `contestant` (`cId`)
//     ON DELETE RESTRICT
//     ON UPDATE RESTRICT 
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `contactUs`(
//   `contactId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(100) NOT NULL,
//   `phoneNumber` VARCHAR(14) NOT NULL,
//   `email` VARCHAR(255) NOT NULL,
//   `message` TEXT NOT NULL
//   );";
// $con->query($sql);

// $sql = "CREATE TABLE IF NOT EXISTS `vote`(
//   `voteId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//   `cId` INT NOT NULL,
//   `vote` INT(4) NOT NULL DEFAULT 0,
//   `voterEmail` VARCHAR(200) NOT NULL,
//   `tnxRef` VARCHAR(200) NOT NULL DEFAULT '',
//   `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//   FOREIGN KEY (`cId`) REFERENCES `contestant` (`cId`)
//     ON DELETE RESTRICT
//     ON UPDATE RESTRICT 
//   );";
// $con->query($sql);
?>
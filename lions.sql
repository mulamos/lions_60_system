DROP DATABASE IF EXISTS lions;
CREATE DATABASE lions;
USE lions;
--
-- Table structure for table `applicants`
--
DROP TABLE IF EXISTS applicants;
CREATE TABLE `applicants`(
  `applicant_id` int NOT NULL auto_increment PRIMARY KEY,
  `first_name` char(35) NOT NULL default '',
  `middle_initial` char(1) NOT NULL default '',
  `last_name` char(20) NOT NULL default '',
  `gender` char(10) NOT NULL default '',
  `club` char(20) NOT NULL default '',
  `position` char(20) NOT NULL default '',
  `country` char(20) NOT NULL default '',
  `email` char(100) NOT NULL default '',
  `cell` char(20) NOT NULL default '',
  `tel` char(20) NOT NULL default '',
  `host` char(5) NOT NULL default '',
  `date_of_arrival` date,
  `time_of_arrival` varchar(8) NOT NULL default '',
  `arrival_airline` varchar(20) default 'NULL',
  `date_of_departure` date,
  `time_of_departure` char(8) NOT NULL default '',
  `depature_airline` char(20) default 'NULL',
  `rate` char(10) NOT NULL default ''
);

DROP TABLE IF EXISTS chairperson;
CREATE TABLE `chairperson` (
-- Login information
  `user_id` int(11) NOT NULL auto_increment PRIMARY KEY,
  `first_name` char(30) NOT NULL default '',
  `last_name` char(30) NOT NULL default '',
  `user_name` char(35) NOT NULL default '',
  `user_password` char(35) NOT NULL default '',
  `cposition` enum('Registration Chairperson', 'Accomadation Chairperson', 'Transportation Chairperson', 'Treasurer') NOT NULL
);
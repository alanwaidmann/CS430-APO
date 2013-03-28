/*
Milestone 3
 
Written By: 
Logan McCamon
Alan Waidmann
Mikey Hermann

*/

/*

*/
CREATE TABLE IF NOT EXISTS `Member` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(14),
  `schoolyear` int(1) NOT NULL,
  `gradsem` varchar(6) NOT NULL,
  `gradyear` int(4) NOT NULL,
  `pledgesem` varchar(6) NOT NULL,
  `pledgeyear` int(4) NOT NULL,
  `Flower_Id` int(2) NOT NULL, 
  `bigbro` varchar(100) NOT NULL DEFAULT '', 
  `littlebro` varchar(100),
  `Status_Id` int(2) NOT NULL DEFAULT '0',
  `position` int(2) NOT NULL DEFAULT '0',
  `birthday` date,
  `active_sem` text NOT NULL,
  `risk_management` date NOT NULL,
  `hide_info` varchar(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  FOREIGN KEY (Flower_Id) REFERENCES FamilyFlower(Flower_Id),
  FOREIGN KEY (Status_Id) REFERENCES Status(Status_Id)
);

/*

*/
CREATE TABLE Address(
M_Id int(6),
homeaddress varchar(30),
citystatezip varchar(30), 
localaddress varchar(30),
FOREIGN KEY (M_Id) REFERENCES Member(id));
/*

*/
CREATE TABLE Leader(
M_Id int(6),
E_Id int(6),
UNIQUE KEY `leader` (`M_Id`,`E_Id`),
FOREIGN KEY (M_Id) REFERENCES Member(id),
FOREIGN KEY (E_Id) REFERENCES Event(E_Id));

/*
An event is all shifts on a given day
*/
CREATE TABLE Event(
E_Id int(6) NOT NULL AUTO_INCREMENT,
Name varchar(64) NOT NULL,
DOW varchar(3),
Description varchar(320),
Type int(6) NOT NULL,
Location varchar(50) NOT NULL,
publicNotes varchar(320),
privateNotes varchar(320),
PRIMARY KEY (E_Id),
UNIQUE KEY `event` (`E_Id`,`DOW`),
FOREIGN KEY (Type) REFERENCES EventType(T_Id));


CREATE TABLE EventType(
T_Id int(6) NOT NULL AUTO_INCREMENT,
Name varchar(64) NOT NULL,
PRIMARY KEY (T_Id));
/*

*/
CREATE TABLE Shift(
S_Id int(6) NOT NULL AUTO_INCREMENT,
E_Id int(6),
startTime time,
endTime time,
Max int(3),
PRIMARY KEY(`S_Id`),
FOREIGN KEY (E_Id) REFERENCES Event(E_Id));

/*

*/
CREATE TABLE Occurrence(
O_Id		int(6) NOT NULL AUTO_INCREMENT,
E_Id 		int(6),
startTime	datetime NOT NULL,
endTime		datetime NOT NULL,
Max 		int(3),
PRIMARY KEY(`O_Id`),
FOREIGN KEY (E_Id) REFERENCES Event(E_Id));

/*

*/
CREATE TABLE Volunteer(
O_Id 		int(6),
M_Id  		int(6),
Processed 	int(1),
FOREIGN KEY (M_Id) REFERENCES Member(id),
FOREIGN KEY (O_Id) REFERENCES Occurrence(O_Id),
FOREIGN KEY (Processed) REFERENCES Processed(Proccessed_Id));

CREATE TABLE FamilyFlower(
Flower_Id int(2) NOT NULL AUTO_INCREMENT,
Name varchar(32),
PRIMARY KEY (Flower_Id),
UNIQUE KEY `FamilyFlower` (`Name`));

/* */
INSERT INTO FamilyFlower(Name)
VALUES
('Red Carnation'),
('Red Rose'),
('Yellow Rose'),
('Yellow Carnation'),
('White Rose'),
('White Carnation');

CREATE TABLE SchoolYear(
SchoolYear 	int(1) NOT NULL AUTO_INCREMENT,
Name		varchar(32),
PRIMARY KEY (SchoolYear),
UNIQUE KEY `SchoolYear` (`Name`));

INSERT INTO SchoolYear(Name)
VALUES
('Freshmen'),
('Sophomore'),
('Junior'),
('Senior'),
('Over-Achievers');

CREATE TABLE MajorRoster(
M_Id		int(6),
Major_Id		int(3),
UNIQUE KEY `MajorRoster` (`M_Id`,`Major_Id`),
FOREIGN KEY Major_Id REFERENCES Major(Major_Id));

CREATE TABLE Major(
Major_Id		int(3) NOT NULL AUTO_INCREMENT,
Name		varchar(32),
PRIMARY KEY (Major_Id),
UNIQUE KEY `Major` (`Major`));

CREATE TABLE MinorRoster(
M_Id		int(6),
Minor_Id		int(3),
UNIQUE KEY `MinorRoster` (`M_Id`,`Minor_Id`),
FOREIGN KEY Minor_Id REFERENCES Minor(Minor_Id));

CREATE TABLE Minor(
Minor_Id		int(3) NOT NULL AUTO_INCREMENT,
Name		varchar(32),
PRIMARY KEY (Minor_Id),
UNIQUE KEY `Minor` (`Minor`));

CREATE TABLE Status(
Status_Id	int(2) NOT NULL AUTO_INCREMENT,
Name varchar(24) NOT NULL,
ServiceContract float NOT NULL,
PRIMARY KEY(Status_Id),
UNIQUE KEY `Status` (`Status_Id`,`Name`));

INSERT INTO Status(Name, ServiceContract)
VALUES
('Active',25),
('Associate',12.5);

CREATE TABLE Processed(
Proccessed_Id 	int(1) NOT NULL AUTO_INCREMENT,
Name 		varchar(24) NOT NULL,
PRIMARY KEY Proccessed_Id));

CREATE TABLE IF NOT EXISTS `recorded_hours` (
  `index` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(4) NOT NULL,
  `date` date NOT NULL,
  `semester` text NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT '',
  `hours` float NOT NULL DEFAULT '0',
  `servicetype` varchar(10) NOT NULL DEFAULT '',
  `fundraising` varchar(10) NOT NULL,
  `event` varchar(22) NOT NULL,
  `O_Id`  int(6),
  UNIQUE KEY `index` (`index`),
  UNIQUE KEY `user_id` (`user_id`,`description`,`date`),
  FOREIGN KEY O_Id REFERENCES Occurrence(O_Id)
) 































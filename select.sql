/*
Milestone 3
 
Written By: 
Logan McCamon
Alan Waidmann
Mikey Hermann
*/

SELECT * FROM Address;
SELECT * FROM Event;
SELECT * FROM EventStatus;
SELECT * FROM EventType;
SELECT * FROM FamilyFlower;
SELECT * FROM Leader;
SELECT * FROM Major;
SELECT * FROM MajorRoster;
SELECT * FROM Minor;
SELECT * FROM MinorRoster;
SELECT * FROM Member;
SELECT * FROM NextWeek;
SELECT * FROM Occurrence;
SELECT * FROM Processed;
SELECT * FROM recorded_hours;
SELECT * FROM SchoolYear;
SELECT * FROM Shift;
SELECT * FROM Status;
SELECT * FROM Volunteer;

/*
 * Sample select statement returning Member table and 
 * related data from Address, FamilyFlower, & Status tables.
 */
SELECT M.id,M.firstname,M.lastname,S.Name,F.Name,
	   A.homeaddress,A.citystatezip FROM Member AS M
JOIN FamilyFlower AS F ON M.Flower_Id = F.Flower_Id
JOIN Status AS S ON M.Status_Id = S.Status_Id
JOIN Address AS A ON A.M_Id = M.id;

/*
 * Sample select statement from our Events/Shift/Occurrence
 * tables. The Shift and NextWeek tables are structured
 * similarily and additional queries are not shown.
 */
SELECT E.Name,E.DOW,ES.Name
FROM Occurrence AS O 
JOIN Event AS E ON E.E_Id = O.E_Id
JOIN EventStatus AS ES ON ES.ES_Id = O.EventStatus_Id
WHERE O.startTime >= NOW();

/*
 * Sample select statement displaying selecting Majors
 * and minors based on the member id number
 */
SELECT M.id,M.firstname,M.lastname,Major.Name AS Major,Minor.Name AS Minor
FROM Member AS M
JOIN MajorRoster AS MR ON MR.M_Id=M.id
JOIN Major ON Major.Major_Id = MR.Major_Id
JOIN MinorRoster AS MiR ON MiR.M_Id=M.id
JOIN Minor ON Minor.Minor_Id = MiR.Minor_Id;

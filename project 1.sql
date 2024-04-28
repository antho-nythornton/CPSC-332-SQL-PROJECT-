DROP DATABASE IF EXISTS UNIVERSITY_REGISTRY;
CREATE DATABASE UNIVERSITY_REGISTRY;
USE UNIVERSITY_REGISTRY;

CREATE TABLE STUDENT (
    STUDENTID INT NOT NULL PRIMARY KEY,
    FIRSTNAME VARCHAR(50),
    MIDDLEINITIAL CHAR(1),
    LASTNAME VARCHAR(50),
    BIRTHDATE DATE,
    ADDRESS VARCHAR(255),
    SEX ENUM('Male', 'Female', 'Other'),
    GRADYEAR YEAR,
    SFIELDOFSTUDY VARCHAR(100),
    PHOTO BLOB
);

CREATE TABLE DEPARTMENT (
    DEPARTMENTID INT NOT NULL PRIMARY KEY,
    FIELDOFSTUDY VARCHAR(100),
    DIRECTORID INT,
    FIRSTNAME VARCHAR(50) NOT NULL,
    MIDDLEINITIAL CHAR(1),
    LASTNAME VARCHAR(50) NOT NULL
);

CREATE TABLE TEACHER (
    TEACHERID INT NOT NULL PRIMARY KEY,
    FIRSTNAME VARCHAR(50) NOT NULL,
    MIDDLEINITIAL CHAR(1),
    LASTNAME VARCHAR(50) NOT NULL,
    TDEPARTMENTID INT NOT NULL,
    DIRECTOR BOOLEAN,
    FOREIGN KEY (TDEPARTMENTID) REFERENCES DEPARTMENT(DEPARTMENTID)
);

CREATE TABLE COURSE (
    COURSEID INT NOT NULL PRIMARY KEY,
    SUBJECT VARCHAR(100) NOT NULL,
    COST DECIMAL(10, 2),
    TIME VARCHAR(100),
    COURSEINFO TEXT,
    CTEACHERID INT,
    DEPARTMENTID INT,
    FOREIGN KEY (CTEACHERID) REFERENCES TEACHER (TEACHERID)
);

CREATE TABLE ENLISTEDCLASSES (
    ESTUDENTID INT,
    ECOURSEID INT,
    FOREIGN KEY (ESTUDENTID) REFERENCES STUDENT (STUDENTID),
	FOREIGN KEY (ECOURSEID) REFERENCES COURSE (COURSEID)
     );

CREATE TABLE AVAILABLECLASSES(
COURSEID INT
);

-- Sample entries for STUDENT
INSERT INTO STUDENT (STUDENTID, FIRSTNAME, MIDDLEINITIAL, LASTNAME, BIRTHDATE, ADDRESS, SEX, GRADYEAR, SFIELDOFSTUDY, PHOTO) VALUES
(1, 'Emma', 'L', 'Brown', '2000-05-15', '123 Main St, Anytown, USA', 'Female', 2022, 'Computer Science', NULL),
(2, 'Noah', 'W', 'Miller', '2001-09-20', '456 Elm St, Othertown, USA', 'Male', 2023, 'Mathematics', NULL),
(3, 'Olivia', 'A', 'Davis', '1999-12-10', '789 Oak St, Somewhere, USA', 'Female', 2024, 'History', NULL),
(4, 'Liam', 'J', 'Wilson', '2002-03-25', '101 Pine St, Anotherplace, USA', 'Male', 2022, 'Biology', NULL);

-- Sample entries for TEACHER
INSERT INTO TEACHER (TEACHERID, FIRSTNAME, MIDDLEINITIAL, LASTNAME, TDEPARTMENTID, DIRECTOR) VALUES
(1, 'John', 'D', 'Doe', 1, true),
(2, 'Alice', 'M', 'Smith', 2, false),
(3, 'Michael', 'J', 'Johnson', 3, true),
(4, 'Emily', 'R', 'Roberts', 4, false); -- Corrected TDEPARTMENTID for Emily

-- Sample entries for COURSE
INSERT INTO COURSE (COURSEID, SUBJECT, COST, TIME, COURSEINFO, CTEACHERID, DEPARTMENTID) VALUES
(1, 'Database Management', 150.00, 'Mon/Wed 10:00-11:30', 'Learn about relational databases and SQL', 1, 1),
(2, 'Algebra', 120.00, 'Tue/Thu 13:00-14:30', 'Study of algebraic structures and equations', 2, 2),
(3, 'Ancient Civilizations', 80.00, 'Mon/Wed/Fri 09:00-10:30', 'Exploration of ancient cultures and societies', 3, 3),
(4, 'Biology Basics', 100.00, 'Tue/Thu 10:00-11:30', 'Introduction to fundamental concepts in biology', 4, 1);

-- Sample entries for DEPARTMENT
INSERT INTO DEPARTMENT (DEPARTMENTID, FIELDOFSTUDY, DIRECTORID, FIRSTNAME, MIDDLEINITIAL, LASTNAME) VALUES
(1, 'Computer Science', 1, 'John', 'D', 'Doe'),
(2, 'Mathematics', 2, 'Alice', 'M', 'Smith'),
(3, 'History', 3, 'Michael', 'J', 'Johnson'),
(4, 'Biology', 4, 'Emily', 'R', 'Roberts');

-- Sample entries for ENLISTEDCLASSES
INSERT INTO ENLISTEDCLASSES (ESTUDENTID, ECOURSEID) VALUES
(1, 1), -- Emma enrolls in Database Management
(2, 2), -- Noah enrolls in Algebra
(3, 3), -- Olivia enrolls in Ancient Civilizations
(4, 4); -- Liam enrolls in Biology Basics

-- Sample entries for AVAILABLECLASSES
INSERT INTO AVAILABLECLASSES (COURSEID) VALUES
(1), -- Database Management
(2), -- Algebra
(3), -- Ancient Civilizations
(4); -- Biology Basics

    
    -- View DEPARTMENT table
SELECT * FROM DEPARTMENT;

-- View TEACHER table
SELECT * FROM TEACHER;

-- View COURSE table
SELECT * FROM COURSE;

-- View STUDENT table
SELECT * FROM STUDENT;

-- View ENROLLMENT table
SELECT * FROM ENLISTEDCLASSES;


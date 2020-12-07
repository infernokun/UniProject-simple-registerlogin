DROP DATABASE IF EXISTS aum_db;
CREATE DATABASE aum_db;
use aum_db;

drop user IF EXISTS aum_admin@localhost;
flush privileges;
CREATE USER aum_admin@localhost IDENTIFIED BY 'aum_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON * TO aum_admin@localhost;

CREATE TABLE student(
	studentID int NOT NULL unique auto_increment,
    firstName varchar(25) not null,
    lastName varchar(25) not null,
    email varchar(50) not null unique,
    pass varchar(25) not null,
    gender varchar(20),
    birthday date,
    PRIMARY KEY(studentID));

INSERT INTO student
                 (studentID, firstName, lastName, email, pass, gender)
              VALUES
                 (1, "Eivor", "Raven", "eivor@gmail.com", "password123", "Female"),
                 (2, "Kassandra", "Great", "kass@gmail.com", "password123", "Female");
    
CREATE TABLE instructor(
	instructorID int NOT NULL auto_increment unique,
    firstName varchar(25) not null,
    lastName varchar(25) not null,
    email varchar(50) not null unique,
    pass varchar(25) not null,
    gender varchar(20),
    birthday date,
    PRIMARY KEY(instructorID));
    
insert into instructor 
		(instructorID, firstName, lastName, email, pass, gender)
		values 
		(1, "Dokkaebi", "Nam", "dokkaebi@gmail.com", "password123", "Female"),
        (2, "Hibana", "Yukiko", "hibana@gmail.com", "password123", "Female"),
        (3, "Harry", "Potter", "harry@gmail.com", "password123", "Male"),
        (4, "Rey", "Skywalker", "rey@gmail.com", "password123", "Female"),
        (5, "Valkyrie", "Durk", "valk@gmail.com", "password123", "Female"),
        (6, "Sasha", "Kenny", "sasha@gmail.com", "password123", "Female"),
        (7, "Luke", "Fenton", "luke@gmail.com", "password123", "Male"),
        (8, "Jake", "Long", "jake@gmail.com", "password123", "Male"),
        (9, "Drake", "Bell", "drake@gmail.com", "password123", "Female"),
        (10, "Simon", "Baz", "simon@gmail.com", "password123", "Male");
    
create table courseInfo(
	courseID varchar(10),
    courseName varchar(50),
    instructorID int,
    foreign key (instructorID) references instructor(instructorID),
    classRoom varchar(20),
    startTime time,
    endTime time,
    days varchar(2),
    semester varchar(10), 
    enrolled int,
    seats int,
    primary key(courseID));
    
insert into courseInfo values ("CSCI 1020", "Introduction to Computer Science", 4, "Room 2", "08:00:00", "09:25:00", "MW", "Fall 2020", 0,  1),
("COMM 2000", "Aspects of Communications", 7, "Room 7", "09:30:00", "11:00:00", "MW", "Fall 2020", 0, 3),
("CSCI 3000", "Advanced Computer Science", 6, "Room 3", "19:00:00", "20:30:00", "MW", "Fall 2020", 0, 5),
("HIST 4040", "The American Revolution", 8, "Room 1", "15:35:00", "16:50:00", "F", "Fall 2020", 0, 8),
("MILS 1000", "Military Fitness", 1, "Room 6", "08:00:00", "09:25:00", "F", "Fall 2020", 0, 3),
("ENGL 2200", "Fine English", 2, "Room 2", "09:30:00", "11:00:00", "TR", "Fall 2020", 0, 1),
("MILS 3010", "Leadership Management", 1, "Room 1", "17:00:00", "18:25:00", "F", "Fall 2020", 0, 7),
("BIOL 4000", "Advanced Biology", 2, "Room 3", "08:00:00", "09:25:00", "TR", "Fall 2020", 0, 5),
("MATH 1000", "Basic Math", 1, "Room 5", "12:45:00", "14:00:00", "F", "Fall 2020", 0, 7),
("POLS 2010", "American Politics", 3, "Room 7", "12:45:00", "14:00:00", "TR", "Fall 2020", 0, 8),
("MATH 3000", "Calculus 3", 7, "Room 4", "17:00:00", "18:25:00", "TR", "Fall 2020", 0, 8),
("PHED 4900", "Varsity Soccer", 5, "Room 3", "15:35:00", "16:50:00", "TR", "Fall 2020", 0, 2),
("PHYS 1020", "Basic Physics", 3, "Room 7", "09:30:00", "11:00:00", "F", "Fall 2020", 0, 4),
("BUSN 2000", "Business Administration", 4, "Room 2", "17:00:00", "18:25:00", "MW", "Fall 2020", 0, 2),
("PHYS 3000", "Chemical Physics", 5, "Room 6", "15:35:00", "16:50:00", "MW", "Fall 2020", 0, 1),
("VISU 4060", "Advanced Visual Arts", 6 , "Room 1", "12:45:00", "14:00:00", "MW", "Fall 2020", 0, 7);

create table enrolledCourses(
				courseID varchar(10),
                studentID int,
                foreign key(courseID) references courseInfo(courseID),
                foreign key(studentID) references student(studentID),
                grade varchar(2));
                
INSERT into enrolledCourses values("BIOL 4000", 1, "A"),
								  ("BUSN 2000", 1, "C"),
                                  ("CSCI 1020", 1, "F"),
                                  ("HIST 4040", 2, "B"),
                                  ("BIOL 4000", 2, "F"),
                                  ("BUSN 2000", 2, "D");
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "BIOL 4000";
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "BUSN 2000";
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "CSCI 1020";
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "HIST 4040";
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "BIOL 4000";
UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = "BUSN 2000";
    

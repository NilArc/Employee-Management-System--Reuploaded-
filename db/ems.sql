CREATE TABLE DEPARTMENT(
    DEP_ID INT NOT NULL AUTO_INCREMENT,
    DEP_NAME VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY (DEP_ID)
);
 
CREATE TABLE POSITIONS(
    POS_ID INT AUTO_INCREMENT NOT NULL,
    POS_TITLE VARCHAR(30) NOT NULL UNIQUE,
    DEP_ID INT NOT NULL,
    PRIMARY KEY (POS_ID),
    FOREIGN KEY (DEP_ID) REFERENCES DEPARTMENT(DEP_ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PROJECTS(
    PROJ_ID INT AUTO_INCREMENT NOT NULL,
    PROJ_NAME VARCHAR(30) NOT NULL UNIQUE,
    PROJ_END_DATE DATE NOT NULL,
    PROJ_SUBMIT_DATE DATE,
    PROJ_FILE VARCHAR(255) UNIQUE,
    PROJ_MARK INT DEFAULT NULL,
    DEP_ID INT NOT NULL,
    PRIMARY KEY (PROJ_ID),
    FOREIGN KEY (DEP_ID) REFERENCES DEPARTMENT(DEP_ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE EMPLOYEES(
    EMP_ID INT AUTO_INCREMENT NOT NULL,
    EMP_FNAME VARCHAR(20) NOT NULL,
    EMP_LNAME VARCHAR(30) NOT NULL,
    EMP_EMAIL VARCHAR(30) NOT NULL UNIQUE,
    EMP_PASSWORD VARCHAR(30) NOT NULL UNIQUE,
    EMP_MNG_DISCRIM BOOLEAN DEFAULT 0,
    EMP_BDAY DATE NOT NULL,
    EMP_GENDER VARCHAR(10) NOT NULL,
    EMP_CONTACT_NUM VARCHAR(11) NOT NULL UNIQUE,
    EMP_NID INT(20) UNSIGNED NOT NULL UNIQUE,
    EMP_ADDRESS VARCHAR(50) NOT NULL,
    EMP_DEGREE VARCHAR(20) NOT NULL,
    EMP_PROFILE_PIC VARCHAR(255) UNIQUE,
    EMP_POINTS INT UNSIGNED DEFAULT 0 NOT NULL,
    PROJ_ID INT,
    POS_ID INT NOT NULL,
    PRIMARY KEY (EMP_ID),
    FOREIGN KEY (PROJ_ID) REFERENCES PROJECTS(PROJ_ID) ON UPDATE CASCADE,
    FOREIGN KEY (POS_ID) REFERENCES POSITIONS(POS_ID) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE LEAVES(
    LEAVE_ID INT AUTO_INCREMENT NOT NULL,
    LEAVE_TOKEN INT UNSIGNED NOT NULL,
    LEAVE_START_DATE DATE NOT NULL,
    LEAVE_END_DATE DATE NOT NULL,
    LEAVE_REASON VARCHAR(255) NOT NULL ,
    LEAVE_ACCEPT BOOLEAN DEFAULT NULL,
    EMP_ID INT NOT NULL,
    PRIMARY KEY (LEAVE_ID),
    FOREIGN KEY (EMP_ID) REFERENCES EMPLOYEES(EMP_ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE SALARY(
    SALARY_ID INT AUTO_INCREMENT NOT NULL,
    SALARY_BASE NUMERIC(9,2) NOT NULL,
    SALARY_BONUS INT(3) DEFAULT 0,
    SALARY_TOTAL NUMERIC(9,2) NOT NULL,
    EMP_ID INT NOT NULL UNIQUE,
    PRIMARY KEY (SALARY_ID),
    FOREIGN KEY (EMP_ID) REFERENCES EMPLOYEES(EMP_ID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO DEPARTMENT
VALUES(DEP_ID,'Accounting'),
(DEP_ID, 'Marketing');

INSERT INTO POSITIONS VALUES
(POS_ID, 'Accounting Manager', 1),
(POS_ID, 'Accounting Assistant', 1),
(POS_ID, 'Marketing Manager', 2),
(POS_ID, 'Marketing Assitant', 2),
(POS_ID, 'Project staff', 1),
(POS_ID, 'Project Accountant 1', 1),
(POS_ID, 'Project Accountant', 1),
(POS_ID, 'CPA', 1),
(POS_ID, 'Staff accountant', 1),
(POS_ID, 'Business Analyst', 1),
(POS_ID, 'Business Analyst 1', 1),
(POS_ID, 'Staff Accountant 2', 1),
(POS_ID, 'Project Accountant 2', 1),
(POS_ID, 'CPA 2', 1),
(POS_ID, 'Project Staff 1', 1),
(POS_ID, 'Business Analyst 2', 1),
(POS_ID, 'Project Accountant 3', 1),
(POS_ID, 'Marketing Assistant 1', 2),
(POS_ID, 'Marketing Specialist', 2),
(POS_ID, 'Marketing Specialist 1', 2),
(POS_ID, 'Marketing Specialist 2', 2),
(POS_ID, 'Promotion Specialist', 2),
(POS_ID, 'Promotion Specialist 1', 2),
(POS_ID, 'Promotion Specialist 2', 2),
(POS_ID, 'Business Analyst 3', 2);


INSERT INTO PROJECTS
VALUES(PROJ_ID,'Inventory','2022-07-10','2022-07-13','project files/sample.txt',NULL,1),
(PROJ_ID,'Data Analysis','2022-07-14',NULL,NULL,NULL,1),
(PROJ_ID,'Market Analysis','2022-07-10',NULL,NULL,NULL,2),
(PROJ_ID,'Strategy Forming','2022-07-19',NULL,NULL,NULL,2);

INSERT INTO EMPLOYEES VALUES
(EMP_ID, 'John', 'Doe', 'john.doe@gmail.com', '1', 1, '1999-08-10', 'Male', '09999999999', 0, 'Unkonwn St.', 'BS Accounting', NULL, 0, NULL, 1),
(EMP_ID, 'Henri', 'Tranvert', 'henri.travert@gmail.com', '2', 0, '1999-10-10', 'Male', '09199999999', 11, 'Unknown St.', 'BS Accounting', NULL, 80, NULL, 2),
(EMP_ID, 'Amelia', 'Smithy', 'amelia.smithy@gmail.com', 'amelia', 0, '1999-11-11', 'Female', '09199976547', 19, 'Unknown St.', 'BS Accounting', NULL, 79, 2, 2),
(EMP_ID, 'Eveline', 'Lamar', 'eveline.lamar@gmail.com', '3', 1, '1998-12-01', 'Female', '09487532897', 122, 'This St.', 'BS Marketing', '1.jpg', 0, NULL, 3),
(EMP_ID, 'Emmy', 'Segal', 'emmy.segal@gmail.com', '4', 0, '1999-09-09', 'Female', '09857462378', 133, 'That St.', 'BS Marketing', '2.jpg', 0, 3, 4),
(EMP_ID, 'Emile', 'Young', 'emile.young@gmail.com', 'emile', 0, '1999-04-08', 'Male', '09878756789', 137, 'That St.', 'BS Marketing', NULL, 0, 4, 4),
(EMP_ID, 'Eddie', 'Munson', 'eddiemunson@gmail.com', 'EddieMunson', 0, '1999-08-16', 'Male', '09763465780', 14, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa09feac6235.02271178.jpeg', 0, NULL, 5),
(EMP_ID, 'Will', 'Byers', 'willbyers@gmail.com', 'WillByers', 0, '1999-03-22', 'Male', '09123456787', 3, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa0a45b9da46.86516854.jpeg', 0, NULL, 6),
(EMP_ID, 'Mike', 'Wheeler', 'mikewheeler@gmail.com', 'MikeWheeler', 0, '1999-04-21', 'Male', '09123465780', 4, 'Pavia, Iloilo', 'PhD in Accounting', '62aa0abc5462d0.05351894.jpeg', 0, NULL, 7),
(EMP_ID, 'Jane', 'Hopper', 'janehopper@gmail.com', 'JaneHopper', 0, '1998-03-12', 'Female', '09123469780', 5, 'Passi, Iloilo', 'PhD in Accounting', '62aa0b61c26074.85201432.jpeg', 0, NULL, 8),
(EMP_ID, 'Chrissy ', 'Cunningham', 'chrissycunningham@gmail.com', 'Chrissy Cunningham', 0, '2001-03-10', 'Female', '09197999898', 6, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa0bb1871597.61286322.jpeg', 0, NULL, 9),
(EMP_ID, 'Jim', 'Hopper', 'jimhopper@gmail.com', 'JimHopper', 0, '1998-07-08', 'Male', '09623856990', 7, 'Jaro, Iloilo', 'PhD in Accounting', '62aa0c26178428.56179266.jpeg', 0, NULL, 10),
(EMP_ID, 'Lucas', 'Sinclair', 'lumax@gmail.com', 'LucasSinclair', 0, '2001-04-13', 'Male', '09133456789', 8, 'Pavia, Iloilo', 'PhD in Accounting', '62aa0cae29d460.39837633.jpeg', 0, NULL, 11),
(EMP_ID, 'Steve', 'Harrington', 'steveee@gmail.com', 'SteveHarrington', 0, '1995-02-14', 'Male', '09123469990', 9, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa0d603f74d9.20543053.jpeg', 0, NULL, 12),
(EMP_ID, 'Dustin', 'Henderson', 'dustinnnn@gmail.com', 'DustinHenderson', 0, '1999-06-09', 'Male', '09123456432', 10, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa0ea96dd718.21089628.jpeg', 0, NULL, 13),
(EMP_ID, 'Nancy', 'Wheeler', 'nanceee@gmail.com', 'NancyWheeler', 0, '1999-02-20', 'Female', '09154356789', 12, 'Miagao, Iloilo', 'PhD in Accounting', '62aa0fecf0e4c4.74055626.jpeg', 0, NULL, 14),
(EMP_ID, 'Jonathan', 'Byers', 'jonathan@gmail.com', 'JonathanByers', 0, '1997-02-12', 'Male', '09128866789', 13, 'Miagao, Iloilo', 'PhD in Accounting', '62aa1084b497d9.56786099.jpeg', 0, NULL, 15),
(EMP_ID, 'Billy', 'Hagrove', 'billyj@gmail.com', 'BillyHagrove', 0, '1998-08-08', 'Male', '09123465760', 15, 'Pavia, Iloilo', 'PhD in Accounting', '62aa119a7c0b10.23003583.jpeg', 0, NULL, 16),
(EMP_ID, 'Murray', 'Bauman', 'murraykarate@gmail.com', 'MurrayBauman', 0, '1980-05-04', 'Male', '09123454321', 16, 'Lapaz, Iloilo', 'PhD in Accounting', '62aa12655adfe0.09765900.jpeg', 0, NULL, 17),
(EMP_ID, 'Jisoo', 'Kim', 'kimjisoo@gmail.com', 'JisooKim', 0, '1999-01-03', 'Female', '09136456789', 18, 'Miagao, Iloilo', 'BS Marketing', '62aa14e2bc4a94.92070226.jpeg', 0, NULL, 18),
(EMP_ID, 'Jennie', 'Kim', 'kimjennie@gmail.com', 'JennieKim', 0, '1997-01-16', 'Female', '09123856970', 20, 'Jaro, Iloilo', 'BS Marketing', '62aa1589ab0458.04675717.jpeg', 0, NULL, 19),
(EMP_ID, 'Roseanne', 'Park', 'roseeee@gmail.com', 'RoseannePark', 0, '1997-11-12', 'Female', '09123465899', 21, 'Miagao, Iloilo', 'BS Marketing', '62aa161e8a95f4.70859815.jpeg', 0, NULL, 20),
(EMP_ID, 'Liza', 'Manoban', 'lizamanoban@gmail.com', 'LizaManoban', 0, '1999-12-12', 'Female', '09123856960', 22, 'Jaro, Iloilo', 'BS Marketing', '62aa17c806c415.76864154.jpeg', 0, NULL, 21),
(EMP_ID, 'Mark', 'Zuckerberg', 'markfb@gmail.com', 'MarkZuckerberg', 0, '1970-01-01', 'Male', '09123456698', 23, 'Jaro, Iloilo', 'BS Marketing', '62aa185cbd2ea1.46407125.jpeg', 0, NULL, 22),
(EMP_ID, 'Steve', 'Jobs', 'steeeve@gmail.com', 'SteveJobs', 0, '1990-02-12', 'Male', '09123459999', 24, 'Miagao, Iloilo', 'BS Marketing', '62aa18cbe1a1d0.83020602.jpeg', 0, NULL, 23),
(EMP_ID, 'Bill', 'Gates', 'billgates@gmail.com', 'BillGates', 0, '1987-04-14', 'Male', '09123456666', 25, 'Pavia, Iloilo', 'BS Marketing', '62aa196de26a25.13143526.jpeg', 0, NULL, 24),
(EMP_ID, 'Manny', 'Pacquiao', 'anglabannato@gmail.com', 'MannyPacquiao', 0, '1975-10-10', 'Male', '09543856780', 26, 'Pavia, Iloilo', 'BS Marketing', '62aa19d21bfef0.49588305.jpeg', 0, NULL, 25);

INSERT INTO LEAVES
VALUES(LEAVE_ID,1,'2022-05-15','2022-05-20',"Sick",1,1),
(LEAVE_ID,2,'2022-07-01','2022-07-02',"Vacation",0,1),
(LEAVE_ID,1,'2022-05-05','2022-05-07',"Sick",1,2),
(LEAVE_ID,1,'2022-07-07','2022-07-08',"Business Trip",NULL,3);

INSERT INTO SALARY
VALUES(SALARY_ID,30000.00,0,30000.00,1),
(SALARY_ID,25000.00,0,25000.00,2),
(SALARY_ID,30000.00,0,30000.50,3),
(SALARY_ID,23000.00,0,23000.00,4),
(SALARY_ID,25000.00,0,25000.00,5),
(SALARY_ID,30000.00,0,30000.50,6);
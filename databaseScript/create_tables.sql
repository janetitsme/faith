drop table faith_appointment;
drop table faith_staffSkills;
drop table faith_treatment;
drop table faith_staff;
drop table faith_customer;


CREATE TABLE faith_customer (
customer_Id INT(10) NOT NULL AUTO_INCREMENT,
cust_FName varchar(25) NOT NULL,
cust_MName varchar(25),
cust_LName varchar(50) NOT NULL,
cust_DOB Date,
cust_Email varchar(50) NOT NULL,
cust_Address1 varchar(50) NOT NULL,
cust_Address2 varchar(50),
cust_Town varchar(25) NOT NULL,
cust_Postcode varchar(15) NOT NULL,
cust_Homephone varchar(15),
cust_Mobilephone varchar(15),
cust_Personal_Info varchar(250),
cust_Password varchar(50) NOT NULL,
CONSTRAINT customer_ID_PK PRIMARY KEY (customer_Id),
CONSTRAINT cust_Email_UQ UNIQUE (cust_Email)
);

CREATE TABLE faith_staff (
staff_Id int(10) AUTO_INCREMENT,
staff_FName varchar(25) NOT NULL,
staff_MName varchar(25),
staff_LName varchar(25) NOT NULL,
staff_JobRole varchar(25) NOT NULL,
staff_Homephone varchar(15) ,
staff_Mobilephone varchar(15),
staff_Email varchar(50) NOT NULL,
staff_Password varchar(50) NOT NULL,
CONSTRAINT staff_ID_PK PRIMARY KEY (staff_Id),
CONSTRAINT staff_Email_UQ UNIQUE (staff_Email)
);

CREATE TABLE faith_treatment(
treatment_Id int(10) AUTO_INCREMENT,
treatment_Name varchar(50) NOT NULL,
treatment_Duration time(6) NOT NULL,
treatment_Cost float(10) NOT NULL,
CONSTRAINT treatment_ID_PK PRIMARY KEY (treatment_Id),
CONSTRAINT treatment_name__UQ UNIQUE (treatment_Name)
);


CREATE TABLE faith_staffskills (
staff_Id INT(10) NOT NULL,
treatment_Id INT(10) NOT NULL,
skills varchar(50) NOT NULL,
CONSTRAINT staffID_FK FOREIGN KEY (staff_Id) REFERENCES faith_staff (staff_Id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT treatmentID_FK FOREIGN KEY (treatment_Id) REFERENCES faith_treatment (treatment_Id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT StaffSkillsIDs_PK PRIMARY KEY (staff_Id, treatment_Id)
);

CREATE TABLE faith_appointment (
customer_Id INT(10) NOT NULL,
treatment_Id INT(10) NOT NULL,
appointment_date DATE NOT NULL,
appointment_startTime Time(6) NOT NULL,
appointment_endTime Time(6) NOT NULL,
staff_Id INT(10) NOT NULL,
CONSTRAINT faith_appointment_PK PRIMARY KEY (customer_Id,treatment_Id,appointment_date),
CONSTRAINT customerId_FK FOREIGN KEY (customer_Id) REFERENCES faith_customer(customer_Id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT treatment_Id_FK FOREIGN KEY (treatment_Id) REFERENCES faith_treatment(treatment_Id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT staff_Id_FK FOREIGN KEY (staff_Id) REFERENCES faith_staff(staff_Id) ON DELETE CASCADE ON UPDATE CASCADE, 
CONSTRAINT appointmentDt_GTE_curDt CHECK (appointment_date >= currDate())
);


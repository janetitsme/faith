INSERT INTO faith_customer
	(cust_FName,cust_LName,cust_DOB, cust_Email,cust_Address1,cust_Address2, cust_Town, cust_Postcode, cust_Homephone,cust_Mobilephone, cust_Password)
VALUES
	('Sylvester','Cat','1991-05-23','cust1@email.com','901 Stockport Road','Levenshulme','Manchester','M19 3PG','01616249700','07719701038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Tom','Jerry','1980-05-23','cust2@email.com','70 Delemere Street','Levenshulme','Manchester','M19 3WR','01615281225','07818701068','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Spike','Butch','1993-05-23','cust3@email.com','3 Wellington Road','Rusholme','Manchester','M16 3PG','01616289540','07718701043','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Cowardy','Dog','1971-05-01','cust4@email.com','116 Oxford Street','Longsight', 'Manchester','M1 3LA','0161528623','07718987038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Daffy','Duck','1991-05-23','cust5@email.com','1 Machester Road','Cheadle','Manchester','SK9 3NG','01616240840','07718703338','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Colonel','Hathi','1991-05-03','cust6@email.com','54 Edwinstowe Drive','Sherwood','Nottingham','NG5 3EP','01158408234','07710981038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Pink','Panther','1991-05-23','cust7@email.com','14 Perry Road', 'Woodsworth','Nottingham','NG3 7WR','01157543297','07888801038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Bugs','Bunny','1991-05-23','cust8@email.com','56 Oxford Crecent','Rise Park','Northampton','NH4 2AA','01188760054','07618783238','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Felix','The Cat','1991-05-02','cust9@email.com','68 Rock Avenue', 'Burry Park','Burry','BG1 6ED', '01108745333', '07718707698','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Samurai','Jack','1991-05-09','cust10@email.com','117 Edward Street','Central Road','London','LL2 8AS', '01519800231','07709876038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Cheshire','Cat','1991-05-23','cust11@email.com','2 Recepton Avenue','Manchester Road','Burry','BG2 1AA','01102343323','07718701000','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Powerpuff','Girls','1990-05-23','cust12@email.com','1 Disney Road','Cartoon Land','Manchester','M16 0LW','01615624852','07718799938','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Mojo','Jojo','1997-05-20','cust13@email.com','4 Merton Avenue', 'Hollins','Oldham','OL8 3AZ','01616359700','07718111138','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Betty','Boop','1981-05-13','cust14@email.com','118 Oxford Street','Airport Road','Cheadle','SK8 2HW','01614545455','07904701038','8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Jane','Dsa','1987-06-13','reo_dsa@yahoo.com','3 Harrow Avenue','Hollins','Oldham','OL8 4HZ','01616286598','07718701038','8be3c943b1609fffbfc51aad666d0a04adf83c9d');

INSERT INTO faith_treatment 
	(treatment_Name, treatment_Duration, treatment_Cost)
VALUES 
	('Eyebrows thread', '15:00', 3.50),
	('Upper lip thread', '15:00', 2.00),
	('Full face thread', '30:00', 12.00),
	('Full face wax', '30:00', 14.00),
	('Deep cleansing Facial', '1:00:00', 30.00),
	('Dry cut', '30:00', 12.00),
	('Wash cut blow', '45:00', 18.00);


INSERT INTO faith_staff 
	(staff_FName, staff_LName, staff_JobRole, staff_Homephone, staff_Mobilephone, staff_Email, staff_Password)
VALUES 
	('Sarah', 'Macefield', 'Hair Dresser', '01614960342', '07700900874','sarah.macey@faith.co.uk', '8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Gol', 'Fareen', 'admin',  '01614960066','07700900074', 'gol.fareen@faith.co.uk', '8be3c943b1609fffbfc51aad666d0a04adf83c9d'),
	('Janet', 'DSouza', 'Beauty Therapist', '01614061166', '07700900741', 'janet.dsouza@faith.co.uk', '8be3c943b1609fffbfc51aad666d0a04adf83c9d');
	
INSERT INTO faith_staffskills 
	(staff_Id, treatment_Id, skills)
VALUES 
	(1,6,'Dry cut'),
	(1,7,'Wash cut blow'),
	(2,6,'Dry cut'),
	(2,7,'Wash cut blow'),
	(2,1,'Eyebrows thread'),
	(2,2,'Upper lip threading'),
	(2,3,'Full face thread'),
	(2,4,'Full face wax'),
	(2,5,'Deep cleansing Facial'),
	(3,1,'Eyebrows thread'),
	(3,2,'Upper lip threading'),
	(3,3,'Full face thread'),
	(3,4,'Full face wax'),
	(3,5,'Deep cleansing Facial');
	
	
INSERT INTO faith_appointment
	(customer_Id,treatment_Id,appointment_date,appointment_startTime, appointment_endTime,staff_Id)
VALUES 
	(1,1,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'11:00','11:15',2),
	(2,1,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'11:00','11:15',3),
	(3,5,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'11:30','12:30',3),
	(3,1,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'12:30','12:45',3),
	(5,1,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'2:00','2:15',2),
	(6,1,STR_TO_DATE('07-05-2017', '%d-%m-%Y'),'3:30','3:45',2),
	(4,6,STR_TO_DATE('07-05-2017', '%d-%m-%Y'),'4:00','4:30',3 ),
	(1,7,STR_TO_DATE('05-05-2017', '%d-%m-%Y'),'12:15','12:45',1),
	(15,7,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'2:00','2:45',1),
	(14,5,STR_TO_DATE('03-04-2017', '%d-%m-%Y'),'4:00','5:00',2),
	(12,2,STR_TO_DATE('03-05-2017', '%d-%m-%Y'),'5:45','6:00',3),
	(2,2,STR_TO_DATE('28-03-2017', '%d-%m-%Y'),'1:00','1:15',2),
	(4,7,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'5:00','5:45',2),
	(6,4,STR_TO_DATE('28-04-2017', '%d-%m-%Y'),'1:00','1:30',3);


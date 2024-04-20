create database Healthcare;

use Healthcare;

-- Create Tables

create table INSURANCE (
	Inumber				VARCHAR(12) NOT NULL,
    Iname				VARCHAR(30),
    CoverageStart		DATE,
    CoverageEnd			Date,
    PolicyNumber		VARCHAR(15),
    primary key(Inumber)
);

create table PROCEDURES (
	Pname				VARCHAR(32) NOT NULL,
    Pcode				VARCHAR(8) NOT NULL,
    Plocation			VARCHAR(15),
    Pdate				DATE,
    PDescription		TEXT,
    primary key(Pcode)
);

create table PATIENT (
	Fname				VARCHAR(15) NOT NULL,
    Minit				CHAR,
    Lname				VARCHAR(15) NOT NULL,
    Ssn					VARCHAR(9),
    BDate				DATE,
    Email				VARCHAR(30),
    Address				VARCHAR(30),
    City				VARCHAR(30),
    State				VARCHAR(30),
    ZipCode				VARCHAR(5),
    Sex					CHAR NOT NULL,
    InsuranceID			VARCHAR(8),
    PhysicianName		VARCHAR(30),
    primary key(Ssn),
    foreign key(InsuranceID) references INSURANCE(Inumber)
);

create table BILLING (
	BillingID				VARCHAR(8) NOT NULL,
    BilledAmount			DECIMAL(12, 3),
    BillingDescription		TEXT,
    InsurancePayment		DECIMAL(12, 3),
    PatientPayment			DECIMAL(12, 3),
    BillDate				DATE,
    ProcedureCode			VARCHAR(8),
    PatientSsn				VARCHAR(9),
    InsuranceNo				VARCHAR(12),
    primary key(BillingID),
    foreign key(ProcedureCode) references PROCEDURES(Pcode),
    foreign key(PatientSsn) references PATIENT(Ssn)
);

create table PATIENTLOGIN (
	Username			VARCHAR(32) NOT NULL,
	Password			VARCHAR(32) NOT NULL,
	Ssn					VARCHAR(9) NOT NULL,
	primary key(Username),
	foreign key(Ssn) references Patient(Ssn)
);

create table STAFFLOGIN (
	Username			VARCHAR(32) NOT NULL,
	Password			VARCHAR(32) NOT NULL,
	primary key(Username)
);


-- Insert data into tables


-- Insert test rows into INSURANCE table
INSERT INTO INSURANCE (Inumber, Iname, CoverageStart, CoverageEnd, PolicyNumber) 
VALUES 
    ('INS001', 'Health Insurance', '2024-01-01', '2024-12-31', 'POL001'),
    ('INS002', 'Dental Insurance', '2024-03-15', '2024-12-31', 'POL002'),
    ('INS003', 'Life Insurance', '2024-02-01', '2025-02-01', 'POL003');

-- Insert test rows into PROCEDURES table
INSERT INTO PROCEDURES (Pname, Pcode, Plocation, Pdate, PDescription) 
VALUES 
    ('Check-up', 'PROC001', 'Clinic A', '2024-04-10', 'Routine check-up'),
    ('X-ray', 'PROC002', 'Hospital B', '2024-04-12', 'Diagnostic imaging'),
    ('Blood Test', 'PROC003', 'Lab C', '2024-04-15', 'Blood analysis');

-- Insert test rows into PATIENT table
INSERT INTO PATIENT (Fname, Minit, Lname, Ssn, BDate, Email, Address, City, State, ZipCode, Sex, InsuranceID, PhysicianName) 
VALUES 
    ('John', 'D', 'Smith', '123456789', '1980-05-15', 'john@example.com', '123 Main St', 'Anytown', 'CA', '12345', 'M', 'INS001', 'Dr. Johnson'),
    ('Jane', 'M', 'Doe', '987654321', '1975-08-20', 'jane@example.com', '456 Elm St', 'Othertown', 'NY', '54321', 'F', 'INS002', 'Dr. Martinez'),
    ('Michael', NULL, 'Brown', '456789123', '1990-01-10', 'michael@example.com', '789 Oak St', 'Smalltown', 'TX', '67890', 'M', 'INS003', 'Dr. Lee');

-- Insert test rows into BILLING table
INSERT INTO BILLING (BillingID, BilledAmount, BillingDescription, InsurancePayment, PatientPayment, BillDate, ProcedureCode, PatientSsn, InsuranceNo) 
VALUES 
    ('BILL001', 200.00, 'Routine check-up', 150.00, 50.00, '2024-04-20', 'PROC001', '123456789', 'INS001'),
    ('BILL002', 300.00, 'X-ray and blood test', 200.00, 100.00, '2024-04-22', 'PROC002', '987654321', 'INS002'),
    ('BILL003', 150.00, 'Blood test', 100.00, 50.00, '2024-04-25', 'PROC003', '456789123', 'INS003');

-- Insert test rows into PATIENTLOGIN table
INSERT INTO PATIENTLOGIN (Username, Password, Ssn) 
VALUES 
    ('john_smith', 'password123', '123456789'),
    ('jane_doe', 'securepass', '987654321'),
    ('michael_brown', 'mypass123', '456789123');

-- Insert test rows into STAFFLOGIN table
INSERT INTO STAFFLOGIN (Username, Password) 
VALUES 
    ('admin', 'adminpass'),
    ('nurse', 'nursepass'),
    ('receptionist', 'receptionpass');


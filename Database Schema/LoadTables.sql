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

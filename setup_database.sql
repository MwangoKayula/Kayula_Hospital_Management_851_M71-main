-- Run this in pgAdmin or psql to set up your database

-- Create database
CREATE DATABASE hospital_db;

-- Connect to database
\c hospital_db;

-- Create users table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('patient', 'doctor', 'admin')),
    full_name VARCHAR(100),
    phone VARCHAR(20),
    remember_token VARCHAR(255),
    reset_token VARCHAR(255),
    reset_expiry TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create patients table
CREATE TABLE patients (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    full_name VARCHAR(100),
    date_of_birth DATE,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    blood_group VARCHAR(5),
    allergies TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create doctors table
CREATE TABLE doctors (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    full_name VARCHAR(100),
    specialization VARCHAR(100),
    license_number VARCHAR(50),
    phone VARCHAR(20),
    email VARCHAR(100),
    qualification TEXT,
    experience INTEGER,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create appointments table (optional)
CREATE TABLE appointments (
    id SERIAL PRIMARY KEY,
    patient_id INTEGER REFERENCES patients(id) ON DELETE CASCADE,
    doctor_id INTEGER REFERENCES doctors(id) ON DELETE CASCADE,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status VARCHAR(20) DEFAULT 'scheduled' CHECK (status IN ('scheduled', 'completed', 'cancelled')),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create indexes for better performance
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_patients_user_id ON patients(user_id);
CREATE INDEX idx_doctors_user_id ON doctors(user_id);
CREATE INDEX idx_appointments_patient_id ON appointments(patient_id);
CREATE INDEX idx_appointments_doctor_id ON appointments(doctor_id);
CREATE INDEX idx_appointments_date ON appointments(appointment_date);

-- Insert a test doctor (password: doctor123)
INSERT INTO users (username, password_hash, email, role, full_name, phone) 
VALUES (
    'dr_smith', 
    '$2y$10$YourHashedPasswordHere', -- Replace with actual hash
    'dr.smith@hospital.com', 
    'doctor', 
    'Dr. John Smith', 
    '+1234567890'
);

-- Insert a test patient (password: patient123)
INSERT INTO users (username, password_hash, email, role, full_name, phone) 
VALUES (
    'john_doe', 
    '$2y$10$YourHashedPasswordHere', -- Replace with actual hash
    'john.doe@email.com', 
    'patient', 
    'John Doe', 
    '+0987654321'
);

-- Create view for active appointments
CREATE VIEW active_appointments AS
SELECT 
    a.id,
    p.full_name as patient_name,
    d.full_name as doctor_name,
    a.appointment_date,
    a.appointment_time,
    a.status
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
WHERE a.status = 'scheduled';
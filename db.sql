CREATE DATABASE IF NOT EXISTS vet_clinic;
USE vet_clinic;

CREATE TABLE pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    species VARCHAR(50) NOT NULL,
    breed VARCHAR(50),
    birth_date DATE,
    owner_name VARCHAR(100) NOT NULL,
    owner_phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE procedures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    procedure_name VARCHAR(100) NOT NULL,
    procedure_date DATE NOT NULL,
    description TEXT,
    veterinarian VARCHAR(100) NOT NULL,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    appointment_day DATETIME NOT NULL,
    reason VARCHAR(255) NOT NULL,
    veterinarian VARCHAR(200) NOT NULL,
    status VARCHAR(50) DEFAULT 'Agendado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP OR CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES (pet_id) ON DELETE CASCADE,
)

CREATE TABLE consulation_records(
    id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT,
    pet_id INT NOT NULL,
    consulation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    veterinarian VARCHAR(100) NOT NULL,
    anamesis TEXT,
    physical_exam TEXT,
    diagnosis TEXT,
    treatment TEXT,
    prescription TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES (pet_id) ON DELETE CASCADE,
    FOREIGN KEY (appointment_id) REFERENCES (appointment_id) ON DELETE SET NULL,
)

CREATE TABLE vaccinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    vaccine_name VARCHAR(100) NOT NULL,
    vaccination_date DATE NOT NULL,
    batch_number VARCHAR(50),
    veterinarian VARCHAR(100),
    notes VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);
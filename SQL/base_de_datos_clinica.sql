
-- Crear la base de datos si no la tenemos creada
CREATE DATABASE clinica;
USE CLINICA;
CREATE TABLE especialidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE medicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    especialidad_id INT,
    activo BOOLEAN DEFAULT 1,
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(id)
);

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT,
    medico_id INT,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medicos(id)
);

CREATE TABLE secretarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO especialidades (nombre) VALUES
('Cardiología'),
('Dermatología'),
('Pediatría'),
('Ginecología'),
('Neurología'),
('Oftalmología'),
('Odontología');

-- Insertar médicos con sus especialidades
INSERT INTO medicos (nombre, especialidad_id) VALUES
('Dr. Juan Pérez', 1),  -- Cardiología
('Dra. Laura Gómez', 2),  -- Dermatología
('Dr. Carlos Sánchez', 3),  -- Pediatría
('Dra. María Fernández', 4),  -- Ginecología
('Dr. Andrés López', 5),  -- Neurología
('Dra. Carmen Martínez', 6),  -- Oftalmología
('Dr. Luis García', 7);  -- Odontología

INSERT INTO secretarios (id, nombre, email) VALUES
(1, 'Pablo', 'pablo@pablo.com');

-- Contraseña en la web (123456)
UPDATE secretarios SET password = '$2y$10$eLodvd6ESgdGh3NDhAL7VuSYFSXZ0S5g6F3zzqYfC3zQy/gz45Jyy' WHERE id = 1;

SELECT * FROM secretarios;

SELECT * FROM citas;

SELECT * FROM pacientes;

SELECT * FROM medicos;
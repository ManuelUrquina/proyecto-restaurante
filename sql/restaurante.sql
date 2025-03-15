CREATE DATABASE restaurante;

USE restaurante;

CREATE TABLE usuarios
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nombre   VARCHAR(100) NOT NULL,
    correo   VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE reservas
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nombre   VARCHAR(255) NOT NULL,
    correo   VARCHAR(255) NOT NULL,
    telefono VARCHAR(20)  NOT NULL,
    fecha    DATE         NOT NULL,
    hora     TIME         NOT NULL,
    personas INT          NOT NULL
);
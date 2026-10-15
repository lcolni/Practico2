CREATE DATABASE IF NOT EXISTS biblioteca_db;
USE biblioteca_db;

DROP TABLE IF EXISTS prestamos;
DROP TABLE IF EXISTS libros;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS autores;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre_autor VARCHAR(100) NOT NULL,
    biografia TEXT,
    foto VARCHAR(255)
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    portada VARCHAR(255),
    id_autor INT,
    id_categoria INT,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

CREATE TABLE prestamos (
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_libro INT,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion DATE,
    estado VARCHAR(30) DEFAULT 'Activo',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

INSERT INTO roles (id_rol, nombre_rol, descripcion) VALUES 
(1, 'Administrador', 'Control total de gestión y sistema'),
(2, 'Lector', 'Usuario estándar de consulta');

INSERT INTO usuarios (nombre, apellido, email, `password`, id_rol) VALUES 
('Administrador', 'General', 'admin@biblioteca.com', '$2y$10$wT4c1A90y5AAnQyU4wPme.gL7Lsm.9cM2vU932Z6m5P6A2y1Y2y2', 1),
('Usuario', 'Lector', 'usuario@biblioteca.com', '$2y$10$wT4c1A90y5AAnQyU4wPme.gL7Lsm.9cM2vU932Z6m5P6A2y1Y2y2', 2);

INSERT INTO autores (id_autor, nombre_autor, biografia) VALUES 
(1, 'George R.R. Martin', 'Escritor de fantasia'),
(2, 'Flor M. Salvador', 'Escritora juvenil'),
(3, 'Nicolás Maquiavelo', 'Filosofo italiano');

INSERT INTO categorias (id_categoria, nombre_categoria) VALUES 
(1, 'Fantasía'),
(2, 'Juvenil'),
(3, 'Clásicos');

INSERT INTO libros (titulo, precio, stock, portada, id_autor, id_categoria) VALUES 
('Juego de Tronos', 1500.00, 10, 'Juego de Tronos.jpg', 1, 1),
('Boulevard', 990.00, 15, 'Boulevard.jpg', 2, 2),
('El Príncipe', 850.00, 12, 'El príncipe.jpg', 3, 3);
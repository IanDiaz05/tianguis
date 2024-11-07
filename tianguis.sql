CREATE DATABASE IF NOT EXISTS tianguis CHARACTER SET utf8;

USE tianguis;

# vendedores que tienen puestos
CREATE TABLE vendedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

# informacion de los puestos de los vendedores
CREATE TABLE puesto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion_corta VARCHAR(300),
    descripcion_larga TEXT,
    vendedor_id INT NOT NULL,
    FOREIGN KEY (vendedor_id) REFERENCES vendedor(id)
);

# informacion de contacto de los puestos
CREATE TABLE contacto_puesto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('facebook', 'instagram', 'whatsapp', 'telefono', 'email', 'pagina web') NOT NULL,
    url VARCHAR(255) NOT NULL,
    puesto_id INT NOT NULL,
    FOREIGN KEY (puesto_id) REFERENCES puesto(id)
);

CREATE TABLE horario_puesto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dia ENUM('lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo') NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    puesto_id INT NOT NULL,
    FOREIGN KEY (puesto_id) REFERENCES puesto(id)
);

# almacenar las urls de las imagenes de los puestos
CREATE TABLE imagenes_puesto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    puesto_id INT NOT NULL,
    FOREIGN KEY (puesto_id) REFERENCES puesto(id)
);

# informacion sobre los productos de los puestos
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(300) NOT NULL,
    img VARCHAR(255) NOT null,
    precio DECIMAL(10, 2),
    puesto_id INT NOT NULL,
    FOREIGN KEY (puesto_id) REFERENCES puesto(id)
);


CREATE DATABASE IF NOT EXISTS prueba_tecnica;
USE prueba_tecnica;

CREATE TABLE IF NOT EXISTS clientes(
    id int(255) auto_increment not null,
    nombre varchar(255) not null,
    apellidos varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    CONSTRAINT clientes_pk PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS peliculas(
    id int(255) auto_increment not null,
    nombre varchar(255) not null,
    sipnosis text,
    precioUnitario float(100, 2),
    tipo varchar(100) not null,
    genero varchar(100) not null,
    fechaEstreno date not null,
    CONSTRAINT peliculas_pk PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS alquileres(
    id int(255) auto_increment not null,
    cliente_id int(255) not null,
    valorTotal float(100, 2) not null,
    fechaInicio time not null,
    fechaFin time not null,
    CONSTRAINT alquileres_pk PRIMARY KEY(id),
    CONSTRAINT alquiler_cliente_fk FOREIGN KEY(cliente_id) REFERENCES clientes(id)
 )ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS alquiler_peliculas(
    id int(255) auto_increment not null,
    pelicula_id int(255) not null,
    alquiler_id int(255) not null,
    CONSTRAINT alquiler_peliculas_pk PRIMARY KEY(id),
    CONSTRAINT alquiler_pelicula_fk FOREIGN KEY(pelicula_id) REFERENCES peliculas(id),
    CONSTRAINT alquiler_alquiler_fk FOREIGN KEY(alquiler_id) REFERENCES alquileres(id)
)ENGINE=InnoDb;
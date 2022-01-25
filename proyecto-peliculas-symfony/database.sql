CREATE DATABASE IF NOT EXISTS peliculas_symfony;
USE peliculas_symfony;

CREATE TABLE IF NOT EXISTS cliente
(
    id       int(255) auto_increment not null,
    nombre   varchar(100)            not null,
    apellido varchar(200)            not null,
    edad     int(255)                not null,
    telefono varchar(255)            not null,
    correo   varchar(255)            not null,
    CONSTRAINT pk_cliente PRIMARY KEY (id)
) ENGINE = InnoDb;


CREATE TABLE IF NOT EXISTS pelicula
(
    id              int(255) auto_increment not null,
    nombre          varchar(100)            not null,
    sinopsis        varchar(255)            not null,
    precio_unitario float(200, 2)           not null,
    tipo            varchar(255)            not null,
    genero          varchar(255)            not null,
    fecha_estreno   date                    not null,
    CONSTRAINT pk_pelicula PRIMARY KEY (id)
) ENGINE = InnoDb;

CREATE TABLE IF NOT EXISTS alquiler
(
    id           int(255) auto_increment not null,
    cliente_id   int(255)                not null,
    pelicula_id  int(255)                not null,
    valor_total  float(200, 2)           not null,
    fecha_inicio date                    not null,
    fecha_fin    date                    not null,
    CONSTRAINT pk_alquiler PRIMARY KEY (id),
    CONSTRAINT fk_alquiler_cliente FOREIGN KEY (cliente_id) REFERENCES cliente (id),
    CONSTRAINT fk_alquiler_pelicula FOREIGN KEY (pelicula_id) REFERENCES pelicula(id)
) ENGINE = InnoDb;

CREATE TABLE IF NOT EXISTS alquiler
(
    id           int(255) auto_increment not null,
    cliente_id   int(255)                not null,
    valor_total  float(200, 2)           not null,
    fecha_inicio date                    not null,
    fecha_fin    date                    not null,
    CONSTRAINT pk_alquiler PRIMARY KEY (id),
    CONSTRAINT fk_alquiler_cliente FOREIGN KEY (cliente_id) REFERENCES cliente (id)
) ENGINE = InnoDb;

CREATE TABLE IF NOT EXISTS puente_alquiler_pelicula
(
    id          int(255) auto_increment not null,
    pelicula_id int(255)                not null,
    alquiler_id int(255)                not null,
    unidades    int(255)                not null,
    CONSTRAINT pk_puente PRIMARY KEY (id),
    CONSTRAINT fk_puente_pelicula FOREIGN KEY (pelicula_id) REFERENCES pelicula (id),
    CONSTRAINT fk_puente_alquiler FOREIGN KEY (alquiler_id) REFERENCES alquiler (id)
) ENGINE = InnoDb;






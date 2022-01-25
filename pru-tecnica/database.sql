CREATE TABLE IF NOT EXISTS clientes(
                                       id              int(255)auto_increment not null,
                                       nombre          varchar(255),
                                       CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS alquileres(
    id              int(255)auto_increment not null,
    id_cliente      int(255) not null,
    valor_total     float,
    fecha_inicio    date,
    fecha_fin       date,

CONSTRAINT pk_alquiler PRIMARY KEY(id),
CONSTRAINT fk_alquiler_cliente FOREIGN KEY (id_cliente) REFERENCES clientes(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS alquiler_pelicula(
    id              int(255)auto_increment not null,
    id_pelicula     int(255),
    id_alquiler     int(255),
    CONSTRAINT pk_alquiler_pelicula PRIMARY KEY(id),
    CONSTRAINT fk_alquiler_pelicula_pelicula FOREIGN KEY (id_pelicula) REFERENCES peliculas(id),
    CONSTRAINT fk_alquiler_pelicula_alquiler FOREIGN KEY (id_alquiler) REFERENCES alquileres(id)

)ENGINE=InnoDb;
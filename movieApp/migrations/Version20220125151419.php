<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125151419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquileres (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, valorTotal DOUBLE PRECISION NOT NULL, fechaInicio DATE NOT NULL, fechaFin DATE NOT NULL, INDEX alquiler_cliente_fk (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alquiler_pelicula (alquiler_id INT NOT NULL, pelicula_id INT NOT NULL, INDEX IDX_BED050685A921E97 (alquiler_id), INDEX IDX_BED0506870713909 (pelicula_id), PRIMARY KEY(alquiler_id, pelicula_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peliculas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, sipnosis TEXT DEFAULT NULL, precioUnitario DOUBLE PRECISION DEFAULT NULL, tipo VARCHAR(100) NOT NULL, genero VARCHAR(100) NOT NULL, fechaEstreno DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alquileres ADD CONSTRAINT FK_4060DBBFDE734E51 FOREIGN KEY (cliente_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED050685A921E97 FOREIGN KEY (alquiler_id) REFERENCES alquileres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED0506870713909 FOREIGN KEY (pelicula_id) REFERENCES peliculas (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alquiler_pelicula DROP FOREIGN KEY FK_BED050685A921E97');
        $this->addSql('ALTER TABLE alquileres DROP FOREIGN KEY FK_4060DBBFDE734E51');
        $this->addSql('ALTER TABLE alquiler_pelicula DROP FOREIGN KEY FK_BED0506870713909');
        $this->addSql('DROP TABLE alquileres');
        $this->addSql('DROP TABLE alquiler_pelicula');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE peliculas');
    }
}

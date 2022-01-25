<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121171949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquiler (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, valor_total DOUBLE PRECISION NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, INDEX fk_alquiler_cliente (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alquiler_pelicula (alquiler_id INT NOT NULL, pelicula_id INT NOT NULL, INDEX IDX_BED050685A921E97 (alquiler_id), INDEX IDX_BED0506870713909 (pelicula_id), PRIMARY KEY(alquiler_id, pelicula_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(200) NOT NULL, edad INT NOT NULL, telefono VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pelicula (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, sinopsis VARCHAR(255) NOT NULL, precio_unitario DOUBLE PRECISION NOT NULL, tipo VARCHAR(255) NOT NULL, genero VARCHAR(255) NOT NULL, fecha_estreno DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alquiler ADD CONSTRAINT FK_655BED39DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED050685A921E97 FOREIGN KEY (alquiler_id) REFERENCES alquiler (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED0506870713909 FOREIGN KEY (pelicula_id) REFERENCES pelicula (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alquiler_pelicula DROP FOREIGN KEY FK_BED050685A921E97');
        $this->addSql('ALTER TABLE alquiler DROP FOREIGN KEY FK_655BED39DE734E51');
        $this->addSql('ALTER TABLE alquiler_pelicula DROP FOREIGN KEY FK_BED0506870713909');
        $this->addSql('DROP TABLE alquiler');
        $this->addSql('DROP TABLE alquiler_pelicula');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE pelicula');
    }
}

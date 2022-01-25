<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120195051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alquiler_pelicula');
        $this->addSql('ALTER TABLE alquileres CHANGE id_cliente id_cliente INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquiler_pelicula (id INT AUTO_INCREMENT NOT NULL, id_pelicula INT DEFAULT NULL, id_alquiler INT DEFAULT NULL, INDEX fk_alquiler_pelicula_alquiler (id_alquiler), INDEX fk_alquiler_pelicula_pelicula (id_pelicula), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT fk_alquiler_pelicula_alquiler FOREIGN KEY (id_alquiler) REFERENCES alquileres (id)');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT fk_alquiler_pelicula_pelicula FOREIGN KEY (id_pelicula) REFERENCES peliculas (id)');
        $this->addSql('ALTER TABLE alquileres CHANGE id_cliente id_cliente INT NOT NULL');
    }
}

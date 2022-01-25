<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124140934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquiler_pelicula (alquiler_id INT NOT NULL, pelicula_id INT NOT NULL, INDEX IDX_BED050685A921E97 (alquiler_id), INDEX IDX_BED0506870713909 (pelicula_id), PRIMARY KEY(alquiler_id, pelicula_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED050685A921E97 FOREIGN KEY (alquiler_id) REFERENCES alquileres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alquiler_pelicula ADD CONSTRAINT FK_BED0506870713909 FOREIGN KEY (pelicula_id) REFERENCES peliculas (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE alquiler_peliculas');
        $this->addSql('ALTER TABLE alquileres CHANGE cliente_id cliente_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquiler_peliculas (id INT AUTO_INCREMENT NOT NULL, pelicula_id INT NOT NULL, alquiler_id INT NOT NULL, INDEX alquiler_alquiler_fk (alquiler_id), INDEX alquiler_pelicula_fk (pelicula_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alquiler_peliculas ADD CONSTRAINT alquiler_alquiler_fk FOREIGN KEY (alquiler_id) REFERENCES alquileres (id)');
        $this->addSql('ALTER TABLE alquiler_peliculas ADD CONSTRAINT alquiler_pelicula_fk FOREIGN KEY (pelicula_id) REFERENCES peliculas (id)');
        $this->addSql('DROP TABLE alquiler_pelicula');
        $this->addSql('ALTER TABLE alquileres CHANGE cliente_id cliente_id INT NOT NULL');
    }
}

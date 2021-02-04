<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203152857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE grape (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grape_region (grape_id INT NOT NULL, region_id INT NOT NULL, INDEX IDX_BCE163156B7990EA (grape_id), INDEX IDX_BCE1631598260155 (region_id), PRIMARY KEY(grape_id, region_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grape_wine (grape_id INT NOT NULL, wine_id INT NOT NULL, INDEX IDX_6BFF91A56B7990EA (grape_id), INDEX IDX_6BFF91A528A2BD76 (wine_id), PRIMARY KEY(grape_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vignoble (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FE46F1E198260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wine (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, vignoble_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, year DATE NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_560C646898260155 (region_id), INDEX IDX_560C64685C794B00 (vignoble_id), INDEX IDX_560C64689D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grape_region ADD CONSTRAINT FK_BCE163156B7990EA FOREIGN KEY (grape_id) REFERENCES grape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grape_region ADD CONSTRAINT FK_BCE1631598260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grape_wine ADD CONSTRAINT FK_6BFF91A56B7990EA FOREIGN KEY (grape_id) REFERENCES grape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grape_wine ADD CONSTRAINT FK_6BFF91A528A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vignoble ADD CONSTRAINT FK_FE46F1E198260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C646898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C64685C794B00 FOREIGN KEY (vignoble_id) REFERENCES vignoble (id)');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C64689D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grape_region DROP FOREIGN KEY FK_BCE163156B7990EA');
        $this->addSql('ALTER TABLE grape_wine DROP FOREIGN KEY FK_6BFF91A56B7990EA');
        $this->addSql('ALTER TABLE grape_region DROP FOREIGN KEY FK_BCE1631598260155');
        $this->addSql('ALTER TABLE vignoble DROP FOREIGN KEY FK_FE46F1E198260155');
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C646898260155');
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C64689D86650F');
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C64685C794B00');
        $this->addSql('ALTER TABLE grape_wine DROP FOREIGN KEY FK_6BFF91A528A2BD76');
        $this->addSql('DROP TABLE grape');
        $this->addSql('DROP TABLE grape_region');
        $this->addSql('DROP TABLE grape_wine');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vignoble');
        $this->addSql('DROP TABLE wine');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318094251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activiteit (id INT AUTO_INCREMENT NOT NULL, soort_id INT DEFAULT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, INDEX IDX_8E3A8C2E3DEE50DF (soort_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soortactiviteit (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, min_leeftijd INT NOT NULL, tijdsduur INT NOT NULL, prijs NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, voorletters VARCHAR(10) NOT NULL, tussenvoegsel VARCHAR(10) DEFAULT NULL, achternaam VARCHAR(25) NOT NULL, adres VARCHAR(7) NOT NULL, postcode VARCHAR(7) NOT NULL, woonplaats VARCHAR(20) NOT NULL, telefoon VARCHAR(15) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activiteit ADD CONSTRAINT FK_8E3A8C2E3DEE50DF FOREIGN KEY (soort_id) REFERENCES soortactiviteit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activiteit DROP FOREIGN KEY FK_8E3A8C2E3DEE50DF');
        $this->addSql('DROP TABLE activiteit');
        $this->addSql('DROP TABLE soortactiviteit');
        $this->addSql('DROP TABLE user');
    }
}

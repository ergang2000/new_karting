<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318114255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deelnames (user_id INT NOT NULL, activiteit_id INT NOT NULL, INDEX IDX_ED2478E7A76ED395 (user_id), INDEX IDX_ED2478E75A8A0A1 (activiteit_id), PRIMARY KEY(user_id, activiteit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deelnames ADD CONSTRAINT FK_ED2478E7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deelnames ADD CONSTRAINT FK_ED2478E75A8A0A1 FOREIGN KEY (activiteit_id) REFERENCES activiteit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activiteit CHANGE soort_id soort_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE tussenvoegsel tussenvoegsel VARCHAR(10) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE deelnames');
        $this->addSql('ALTER TABLE activiteit CHANGE soort_id soort_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE tussenvoegsel tussenvoegsel VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404135148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_clinique_reponses (id INT AUTO_INCREMENT NOT NULL, depot_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_93FCCFE08510D4DE (depot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD CONSTRAINT FK_93FCCFE08510D4DE FOREIGN KEY (depot_id) REFERENCES demande_clinique_depots (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP FOREIGN KEY FK_93FCCFE08510D4DE');
        $this->addSql('DROP TABLE demande_clinique_reponses');
    }
}

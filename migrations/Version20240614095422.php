<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240614095422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add validate and validation_reason columns to demande_clinique_reponses table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD validate TINYINT(1) DEFAULT 0 NOT NULL, ADD validation_reason LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP validate, DROP validation_reason');
    }
}

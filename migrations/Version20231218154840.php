<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218154840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD color_back_card VARCHAR(7) DEFAULT NULL, ADD color_back_text VARCHAR(7) DEFAULT NULL, DROP color_backcard, DROP color_backtext');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD color_backcard VARCHAR(7) DEFAULT NULL, ADD color_backtext VARCHAR(7) DEFAULT NULL, DROP color_back_card, DROP color_back_text');
    }
}

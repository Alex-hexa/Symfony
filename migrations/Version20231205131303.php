<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205131303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE4771D69D61D');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP INDEX IDX_5E3DE4771D69D61D ON skill');
        $this->addSql('ALTER TABLE skill DROP is_completed, CHANGE barre_de_talent_id rate INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pourcentage DOUBLE PRECISION DEFAULT NULL, color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_16D902F52B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE skill ADD is_completed TINYINT(1) NOT NULL, CHANGE rate barre_de_talent_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE4771D69D61D FOREIGN KEY (barre_de_talent_id) REFERENCES talent (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE4771D69D61D ON skill (barre_de_talent_id)');
    }
}

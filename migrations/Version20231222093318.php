<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222093318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidater (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(70) NOT NULL, description LONGTEXT NOT NULL, brochure_filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(70) NOT NULL, description LONGTEXT NOT NULL, image LONGTEXT NOT NULL, color_back_card VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(70) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0E8A7DCFA');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP INDEX IDX_5E3DE4771D69D61D ON skill');
        $this->addSql('ALTER TABLE skill ADD color VARCHAR(7) DEFAULT NULL, DROP is_completed, CHANGE barre_de_talent_id rate INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, UNIQUE INDEX UNIQ_44C8F8185E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, todo_list_id INT NOT NULL, name VARCHAR(70) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_completed TINYINT(1) NOT NULL, INDEX IDX_5A0EB6A0E8A7DCFA (todo_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0E8A7DCFA FOREIGN KEY (todo_list_id) REFERENCES talent (id)');
        $this->addSql('DROP TABLE candidater');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE skill ADD is_completed TINYINT(1) NOT NULL, DROP color, CHANGE rate barre_de_talent_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_5E3DE4771D69D61D ON skill (barre_de_talent_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319103221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cooking_history (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, name VARCHAR(255) NOT NULL, star INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(2048) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD cooking_history_id INT DEFAULT NULL, ADD evaluation_id INT DEFAULT NULL, ADD source_id INT DEFAULT NULL, ADD course_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13768CD51C2 FOREIGN KEY (cooking_history_id) REFERENCES cooking_history (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137CD8F897F FOREIGN KEY (course_type_id) REFERENCES course_type (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13768CD51C2 ON recipe (cooking_history_id)');
        $this->addSql('CREATE INDEX IDX_DA88B137456C5646 ON recipe (evaluation_id)');
        $this->addSql('CREATE INDEX IDX_DA88B137953C1C61 ON recipe (source_id)');
        $this->addSql('CREATE INDEX IDX_DA88B137CD8F897F ON recipe (course_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13768CD51C2');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137CD8F897F');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137456C5646');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137953C1C61');
        $this->addSql('DROP TABLE cooking_history');
        $this->addSql('DROP TABLE course_type');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP INDEX IDX_DA88B13768CD51C2 ON recipe');
        $this->addSql('DROP INDEX IDX_DA88B137456C5646 ON recipe');
        $this->addSql('DROP INDEX IDX_DA88B137953C1C61 ON recipe');
        $this->addSql('DROP INDEX IDX_DA88B137CD8F897F ON recipe');
        $this->addSql('ALTER TABLE recipe DROP cooking_history_id, DROP evaluation_id, DROP source_id, DROP course_type_id');
    }
}

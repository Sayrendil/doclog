<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012071650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, to_user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, from_user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_D8698A7629F6EE60 (to_user_id), INDEX IDX_D8698A7612469DE2 (category_id), UNIQUE INDEX UNIQ_D8698A762130303A (from_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7629F6EE60 FOREIGN KEY (to_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A762130303A FOREIGN KEY (from_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7629F6EE60');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7612469DE2');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A762130303A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE document');
    }
}

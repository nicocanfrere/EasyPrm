<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004165514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE phone_number_books (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN phone_number_books.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_number_books.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE phone_numbers (identifier UUID NOT NULL, phone_number_book_id UUID DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL, owner_first_name VARCHAR(255) DEFAULT NULL, owner_last_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_E7DC46CBA8CD0D41 ON phone_numbers (phone_number_book_id)');
        $this->addSql('COMMENT ON COLUMN phone_numbers.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_numbers.phone_number_book_id IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_numbers.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT FK_E7DC46CBA8CD0D41 FOREIGN KEY (phone_number_book_id) REFERENCES phone_number_books (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE phone_numbers DROP CONSTRAINT FK_E7DC46CBA8CD0D41');
        $this->addSql('DROP TABLE phone_number_books');
        $this->addSql('DROP TABLE phone_numbers');
    }
}

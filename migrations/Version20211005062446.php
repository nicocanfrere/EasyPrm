<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005062446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_book_addresses (identifier UUID NOT NULL, address_book_id UUID DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL, owner_first_name VARCHAR(255) DEFAULT NULL, owner_last_name VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, complement_one TEXT DEFAULT NULL, complement_two TEXT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(20) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, country_code VARCHAR(3) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_55ECB2A64D474419 ON address_book_addresses (address_book_id)');
        $this->addSql('COMMENT ON COLUMN address_book_addresses.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN address_book_addresses.address_book_id IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN address_book_addresses.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE address_books (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN address_books.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN address_books.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE phone_number_book_phone_numbers (identifier UUID NOT NULL, phone_number_book_id UUID DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL, owner_first_name VARCHAR(255) DEFAULT NULL, owner_last_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_F30563DDA8CD0D41 ON phone_number_book_phone_numbers (phone_number_book_id)');
        $this->addSql('COMMENT ON COLUMN phone_number_book_phone_numbers.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_number_book_phone_numbers.phone_number_book_id IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_number_book_phone_numbers.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE address_book_addresses ADD CONSTRAINT FK_55ECB2A64D474419 FOREIGN KEY (address_book_id) REFERENCES address_books (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE phone_number_book_phone_numbers ADD CONSTRAINT FK_F30563DDA8CD0D41 FOREIGN KEY (phone_number_book_id) REFERENCES phone_number_books (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE phone_numbers');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE address_book_addresses DROP CONSTRAINT FK_55ECB2A64D474419');
        $this->addSql('CREATE TABLE phone_numbers (identifier UUID NOT NULL, phone_number_book_id UUID DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL, owner_first_name VARCHAR(255) DEFAULT NULL, owner_last_name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX idx_e7dc46cba8cd0d41 ON phone_numbers (phone_number_book_id)');
        $this->addSql('COMMENT ON COLUMN phone_numbers.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_numbers.phone_number_book_id IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN phone_numbers.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT fk_e7dc46cba8cd0d41 FOREIGN KEY (phone_number_book_id) REFERENCES phone_number_books (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE address_book_addresses');
        $this->addSql('DROP TABLE address_books');
        $this->addSql('DROP TABLE phone_number_book_phone_numbers');
    }
}

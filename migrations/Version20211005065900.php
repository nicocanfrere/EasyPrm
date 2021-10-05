<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005065900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner_partner_account (identifier UUID NOT NULL, address_book_identifier UUID DEFAULT NULL, phone_book_identifier UUID DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, company_number VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD64B14BC751621 ON partner_partner_account (address_book_identifier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD64B14F34B9128 ON partner_partner_account (phone_book_identifier)');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.address_book_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.phone_book_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE partner_partner_user (identifier UUID NOT NULL, address_book_identifier UUID DEFAULT NULL, phone_book_identifier UUID DEFAULT NULL, partner_account_identifier UUID DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C8AFA70BC751621 ON partner_partner_user (address_book_identifier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C8AFA70F34B9128 ON partner_partner_user (phone_book_identifier)');
        $this->addSql('CREATE INDEX IDX_4C8AFA70B7C022A ON partner_partner_user (partner_account_identifier)');
        $this->addSql('COMMENT ON COLUMN partner_partner_user.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_user.address_book_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_user.phone_book_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_user.partner_account_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN partner_partner_user.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE partner_partner_account ADD CONSTRAINT FK_BD64B14BC751621 FOREIGN KEY (address_book_identifier) REFERENCES address_books (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_partner_account ADD CONSTRAINT FK_BD64B14F34B9128 FOREIGN KEY (phone_book_identifier) REFERENCES phone_number_books (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_partner_user ADD CONSTRAINT FK_4C8AFA70BC751621 FOREIGN KEY (address_book_identifier) REFERENCES address_books (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_partner_user ADD CONSTRAINT FK_4C8AFA70F34B9128 FOREIGN KEY (phone_book_identifier) REFERENCES phone_number_books (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_partner_user ADD CONSTRAINT FK_4C8AFA70B7C022A FOREIGN KEY (partner_account_identifier) REFERENCES partner_partner_account (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE partner_partner_user DROP CONSTRAINT FK_4C8AFA70B7C022A');
        $this->addSql('DROP TABLE partner_partner_account');
        $this->addSql('DROP TABLE partner_partner_user');
    }
}

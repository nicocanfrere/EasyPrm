<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005163227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partner_partner_account ALTER account_number TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE partner_partner_account ALTER account_number DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.account_number IS \'(DC2Type:partner_account_number)\'');
        $this->addSql('ALTER TABLE partner_partner_user ADD preferred_language VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE partner_partner_user ADD time_zone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE partner_partner_account ALTER account_number TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE partner_partner_account ALTER account_number DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN partner_partner_account.account_number IS NULL');
        $this->addSql('ALTER TABLE partner_partner_user DROP preferred_language');
        $this->addSql('ALTER TABLE partner_partner_user DROP time_zone');
    }
}

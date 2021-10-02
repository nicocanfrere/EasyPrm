<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001164022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_catalog_prices (identifier UUID NOT NULL, label VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, amount BIGINT DEFAULT NULL, currency VARCHAR(3) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN product_catalog_prices.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_prices.amount IS \'(DC2Type:amount)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_prices.currency IS \'(DC2Type:currency)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_prices.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_catalog_products (identifier UUID NOT NULL, label VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN product_catalog_products.identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_products.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE product_catalog_prices');
        $this->addSql('DROP TABLE product_catalog_products');
    }
}

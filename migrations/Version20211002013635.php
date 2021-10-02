<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211002013635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_catalog_products_to_prices (product_identifier UUID NOT NULL, price_identifier UUID NOT NULL, PRIMARY KEY(product_identifier, price_identifier))');
        $this->addSql('CREATE INDEX IDX_91A0DFE9E449DC41 ON product_catalog_products_to_prices (product_identifier)');
        $this->addSql('CREATE INDEX IDX_91A0DFE9C3A68C6E ON product_catalog_products_to_prices (price_identifier)');
        $this->addSql('COMMENT ON COLUMN product_catalog_products_to_prices.product_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('COMMENT ON COLUMN product_catalog_products_to_prices.price_identifier IS \'(DC2Type:identifier)\'');
        $this->addSql('ALTER TABLE product_catalog_products_to_prices ADD CONSTRAINT FK_91A0DFE9E449DC41 FOREIGN KEY (product_identifier) REFERENCES product_catalog_products (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_catalog_products_to_prices ADD CONSTRAINT FK_91A0DFE9C3A68C6E FOREIGN KEY (price_identifier) REFERENCES product_catalog_prices (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE product_catalog_products_to_prices');
    }
}

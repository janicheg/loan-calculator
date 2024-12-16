<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216095850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, snn INT NOT NULL, fico_rating INT NOT NULL, email VARCHAR(500) NOT NULL, phone_number INT NOT NULL, zip INT NOT NULL, state VARCHAR(2) NOT NULL, city VARCHAR(255) NOT NULL, address_line VARCHAR(500) NOT NULL, monthly_amount INT NOT NULL, birth_date DATE NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE TABLE client_product (uuid UUID NOT NULL, client_uuid UUID NOT NULL, parent_product_uuid UUID NOT NULL, rate DOUBLE PRECISION NOT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_applied BOOLEAN NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_817740D0E393C4 ON client_product (client_uuid)');
        $this->addSql('CREATE INDEX IDX_817740D0CF92F29 ON client_product (parent_product_uuid)');
        $this->addSql('CREATE TABLE product (uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, term INT NOT NULL, amount INT NOT NULL, rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('ALTER TABLE client_product ADD CONSTRAINT FK_817740D0E393C4 FOREIGN KEY (client_uuid) REFERENCES client (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_product ADD CONSTRAINT FK_817740D0CF92F29 FOREIGN KEY (parent_product_uuid) REFERENCES product (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client_product DROP CONSTRAINT FK_817740D0E393C4');
        $this->addSql('ALTER TABLE client_product DROP CONSTRAINT FK_817740D0CF92F29');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_product');
        $this->addSql('DROP TABLE product');
    }
}

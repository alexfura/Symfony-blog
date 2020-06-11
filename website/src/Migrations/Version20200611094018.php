<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611094018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT fk_950a97345670ea');
        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT fk_950a9731e45929d');
        $this->addSql('DROP INDEX idx_950a9731e45929d');
        $this->addSql('DROP INDEX idx_950a97345670ea');
        $this->addSql('ALTER TABLE contracts ADD contract_customer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts ADD contract_supplier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts DROP contractcustomer');
        $this->addSql('ALTER TABLE contracts DROP contractsupplier');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT FK_950A973148E95F6 FOREIGN KEY (contract_customer) REFERENCES customers (customer_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT FK_950A973E9D7781 FOREIGN KEY (contract_supplier) REFERENCES suppliers (supplier_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_950A973148E95F6 ON contracts (contract_customer)');
        $this->addSql('CREATE INDEX IDX_950A973E9D7781 ON contracts (contract_supplier)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT FK_950A973148E95F6');
        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT FK_950A973E9D7781');
        $this->addSql('DROP INDEX IDX_950A973148E95F6');
        $this->addSql('DROP INDEX IDX_950A973E9D7781');
        $this->addSql('ALTER TABLE contracts ADD contractcustomer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts ADD contractsupplier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts DROP contract_customer');
        $this->addSql('ALTER TABLE contracts DROP contract_supplier');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT fk_950a97345670ea FOREIGN KEY (contractcustomer) REFERENCES customers (customer_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT fk_950a9731e45929d FOREIGN KEY (contractsupplier) REFERENCES suppliers (supplier_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_950a9731e45929d ON contracts (contractsupplier)');
        $this->addSql('CREATE INDEX idx_950a97345670ea ON contracts (contractcustomer)');
    }
}

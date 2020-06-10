<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610145257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE customers DROP CONSTRAINT fk_62534e21c54a6b76');
        $this->addSql('ALTER TABLE customers DROP customer_contract');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT fk_ec2d5ce83cb04588');
        $this->addSql('ALTER TABLE supplies DROP supply_measure');
        $this->addSql('ALTER TABLE suppliers DROP CONSTRAINT fk_ac28b95c640640d8');
        $this->addSql('ALTER TABLE suppliers DROP supplier_contract');
        $this->addSql('ALTER TABLE contracts ADD contractCustomer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts ADD contractSupplier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT FK_950A97345670EA FOREIGN KEY (contractCustomer) REFERENCES customers (customer_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contracts ADD CONSTRAINT FK_950A9731E45929D FOREIGN KEY (contractSupplier) REFERENCES suppliers (supplier_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_950A97345670EA ON contracts (contractCustomer)');
        $this->addSql('CREATE INDEX IDX_950A9731E45929D ON contracts (contractSupplier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customers ADD customer_contract INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT fk_62534e21c54a6b76 FOREIGN KEY (customer_contract) REFERENCES contracts (contract_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62534E21C54A6B76 ON customers (customer_contract)');
        $this->addSql('ALTER TABLE supplies ADD supply_measure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT fk_ec2d5ce83cb04588 FOREIGN KEY (supply_measure) REFERENCES measure (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ec2d5ce83cb04588 ON supplies (supply_measure)');
        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT FK_950A97345670EA');
        $this->addSql('ALTER TABLE contracts DROP CONSTRAINT FK_950A9731E45929D');
        $this->addSql('DROP INDEX IDX_950A97345670EA');
        $this->addSql('DROP INDEX IDX_950A9731E45929D');
        $this->addSql('ALTER TABLE contracts DROP contractCustomer');
        $this->addSql('ALTER TABLE contracts DROP contractSupplier');
        $this->addSql('ALTER TABLE suppliers ADD supplier_contract INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suppliers ADD CONSTRAINT fk_ac28b95c640640d8 FOREIGN KEY (supplier_contract) REFERENCES contracts (contract_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AC28B95C640640D8 ON suppliers (supplier_contract)');
    }
}

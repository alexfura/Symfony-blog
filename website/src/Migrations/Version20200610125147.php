<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610125147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE supplies ADD supply_measure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT FK_EC2D5CE83CB04588 FOREIGN KEY (supply_measure) REFERENCES measure (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EC2D5CE83CB04588 ON supplies (supply_measure)');
        $this->addSql('ALTER TABLE contracts ALTER contract_status SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT FK_EC2D5CE83CB04588');
        $this->addSql('DROP INDEX IDX_EC2D5CE83CB04588');
        $this->addSql('ALTER TABLE supplies DROP supply_measure');
        $this->addSql('ALTER TABLE contracts ALTER contract_status DROP NOT NULL');
    }
}

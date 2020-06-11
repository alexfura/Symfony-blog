<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611143704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT FK_EC2D5CE86FFD5800');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT FK_EC2D5CE85DA37D00');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT FK_EC2D5CE86FFD5800 FOREIGN KEY (supply_product) REFERENCES products (product_id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT FK_EC2D5CE85DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT fk_ec2d5ce86ffd5800');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT fk_ec2d5ce85da37d00');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT fk_ec2d5ce86ffd5800 FOREIGN KEY (supply_product) REFERENCES products (product_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT fk_ec2d5ce85da37d00 FOREIGN KEY (measure_id) REFERENCES measure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}

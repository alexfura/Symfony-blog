<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611124850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE suppliers ALTER supplier_name TYPE VARCHAR(225)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_second_name TYPE VARCHAR(225)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_address TYPE VARCHAR(225)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_phone TYPE VARCHAR(225)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_name TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_second_name TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_address TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_phone TYPE VARCHAR(40)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190714155150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE custom_user DROP CONSTRAINT fk_8ce51eb42de89a2e');
        $this->addSql('DROP INDEX uniq_8ce51eb42de89a2e');
        $this->addSql('ALTER TABLE custom_user DROP reset_request_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE custom_user ADD reset_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE custom_user ADD CONSTRAINT fk_8ce51eb42de89a2e FOREIGN KEY (reset_request_id) REFERENCES password_reset_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_8ce51eb42de89a2e ON custom_user (reset_request_id)');
    }
}
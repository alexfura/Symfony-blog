<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712123650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE password_reset_request ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE password_reset_request ADD CONSTRAINT FK_C5D0A95A9D86650F FOREIGN KEY (user_id_id) REFERENCES custom_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C5D0A95A9D86650F ON password_reset_request (user_id_id)');
        $this->addSql('ALTER TABLE custom_user ADD reset_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE custom_user ADD CONSTRAINT FK_8CE51EB42DE89A2E FOREIGN KEY (reset_request_id) REFERENCES password_reset_request (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CE51EB42DE89A2E ON custom_user (reset_request_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE password_reset_request DROP CONSTRAINT FK_C5D0A95A9D86650F');
        $this->addSql('DROP INDEX UNIQ_C5D0A95A9D86650F');
        $this->addSql('ALTER TABLE password_reset_request DROP user_id_id');
        $this->addSql('ALTER TABLE custom_user DROP CONSTRAINT FK_8CE51EB42DE89A2E');
        $this->addSql('DROP INDEX UNIQ_8CE51EB42DE89A2E');
        $this->addSql('ALTER TABLE custom_user DROP reset_request_id');
    }
}

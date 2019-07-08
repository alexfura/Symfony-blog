<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708135548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE custom_user ADD headshot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE custom_user ADD CONSTRAINT FK_8CE51EB4F6FFBEF7 FOREIGN KEY (headshot_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CE51EB4F6FFBEF7 ON custom_user (headshot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE custom_user DROP CONSTRAINT FK_8CE51EB4F6FFBEF7');
        $this->addSql('DROP INDEX UNIQ_8CE51EB4F6FFBEF7');
        $this->addSql('ALTER TABLE custom_user DROP headshot_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708134726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE custom_user ALTER birth_date TYPE DATE');
        $this->addSql('ALTER TABLE custom_user ALTER birth_date DROP DEFAULT');
        $this->addSql('ALTER TABLE image ALTER file TYPE TEXT');
        $this->addSql('ALTER TABLE image ALTER file DROP DEFAULT');
        $this->addSql('ALTER TABLE image ALTER file TYPE TEXT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE custom_user ALTER birth_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE custom_user ALTER birth_date DROP DEFAULT');
        $this->addSql('ALTER TABLE image ALTER file TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE image ALTER file DROP DEFAULT');
    }
}

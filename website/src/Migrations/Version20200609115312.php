<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609115312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE log ALTER table_name DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER log_type DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER user_name DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER original_data DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER new_data DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER query DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE log ALTER log_type SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER table_name SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER user_name SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER original_data SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER new_data SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER query SET NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190621072827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE custom_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE custom_user ADD first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE custom_user ADD second_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE custom_user ADD birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE custom_user ADD headshot VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER INDEX uniq_8d93d649e7927c74 RENAME TO UNIQ_8CE51EB4E7927C74');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE custom_user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE custom_user DROP first_name');
        $this->addSql('ALTER TABLE custom_user DROP second_name');
        $this->addSql('ALTER TABLE custom_user DROP birth_date');
        $this->addSql('ALTER TABLE custom_user DROP headshot');
        $this->addSql('ALTER INDEX uniq_8ce51eb4e7927c74 RENAME TO uniq_8d93d649e7927c74');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190618121741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');


        $this->addSql('ALTER TABLE post DROP author');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D1F55203D');
        $this->addSql('ALTER TABLE post ADD author VARCHAR(122) DEFAULT NULL');
        $this->addSql('CREATE SEQUENCE post_id_seq');
        $this->addSql('SELECT setval(\'post_id_seq\', (SELECT MAX(id) FROM post))');
        $this->addSql('ALTER TABLE post ALTER id SET DEFAULT nextval(\'post_id_seq\')');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT post_topic_id_fkey FOREIGN KEY (topic_id) REFERENCES topic (id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE SEQUENCE topic_id_seq');
        $this->addSql('SELECT setval(\'topic_id_seq\', (SELECT MAX(id) FROM topic))');
        $this->addSql('ALTER TABLE topic ALTER id SET DEFAULT nextval(\'topic_id_seq\')');
    }
}

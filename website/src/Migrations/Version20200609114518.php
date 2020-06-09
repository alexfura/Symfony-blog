<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609114518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sup_user DROP CONSTRAINT fk_e41bea18f6ffbef7');
        $this->addSql('ALTER TABLE password_reset_request DROP CONSTRAINT fk_c5d0a95a9d86650f');
        $this->addSql('DROP SEQUENCE sup_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE password_reset_request_id_seq CASCADE');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE sup_user');
        $this->addSql('DROP TABLE password_reset_request');
        $this->addSql('ALTER TABLE log ADD user_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log ADD original_data VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log ADD new_data VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log ADD query VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log RENAME COLUMN log_info TO table_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE sup_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE password_reset_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, file TEXT NOT NULL, uploaded_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sup_user (id INT NOT NULL, headshot_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, username VARCHAR(255) NOT NULL, status BOOLEAN DEFAULT NULL, email_token VARCHAR(255) DEFAULT NULL, bio VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_e41bea18f85e0677 ON sup_user (username)');
        $this->addSql('CREATE UNIQUE INDEX uniq_e41bea18e7927c74 ON sup_user (email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_e41bea18f6ffbef7 ON sup_user (headshot_id)');
        $this->addSql('CREATE TABLE password_reset_request (id INT NOT NULL, user_id_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, expires TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_c5d0a95a5f37a13b ON password_reset_request (token)');
        $this->addSql('CREATE UNIQUE INDEX uniq_c5d0a95a9d86650f ON password_reset_request (user_id_id)');
        $this->addSql('ALTER TABLE sup_user ADD CONSTRAINT fk_e41bea18f6ffbef7 FOREIGN KEY (headshot_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE password_reset_request ADD CONSTRAINT fk_c5d0a95a9d86650f FOREIGN KEY (user_id_id) REFERENCES sup_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE log ADD log_info VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE log DROP table_name');
        $this->addSql('ALTER TABLE log DROP user_name');
        $this->addSql('ALTER TABLE log DROP original_data');
        $this->addSql('ALTER TABLE log DROP new_data');
        $this->addSql('ALTER TABLE log DROP query');
    }
}

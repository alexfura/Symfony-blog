<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123154405 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE sup_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE password_reset_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sup_user (id INT NOT NULL, headshot_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, username VARCHAR(255) NOT NULL, status BOOLEAN DEFAULT NULL, email_token VARCHAR(255) DEFAULT NULL, bio VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E41BEA18E7927C74 ON sup_user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E41BEA18F85E0677 ON sup_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E41BEA18F6FFBEF7 ON sup_user (headshot_id)');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, file TEXT NOT NULL, uploaded_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE password_reset_request (id INT NOT NULL, user_id_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, expires TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C5D0A95A5F37A13B ON password_reset_request (token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C5D0A95A9D86650F ON password_reset_request (user_id_id)');
        $this->addSql('ALTER TABLE sup_user ADD CONSTRAINT FK_E41BEA18F6FFBEF7 FOREIGN KEY (headshot_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE password_reset_request ADD CONSTRAINT FK_C5D0A95A9D86650F FOREIGN KEY (user_id_id) REFERENCES sup_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE customers DROP CONSTRAINT customers_customer_contract_fkey');
        $this->addSql('ALTER TABLE customers ALTER customer_id DROP DEFAULT');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E21C54A6B76 FOREIGN KEY (customer_contract) REFERENCES contracts (contract_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT supplies_supply_product_fkey');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT supplies_supply_contract_fkey');
        $this->addSql('ALTER TABLE supplies ALTER supply_id DROP DEFAULT');
        $this->addSql('ALTER TABLE supplies ALTER supply_quantity DROP DEFAULT');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT FK_EC2D5CE86FFD5800 FOREIGN KEY (supply_product) REFERENCES products (product_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT FK_EC2D5CE841544050 FOREIGN KEY (supply_contract) REFERENCES contracts (contract_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE log ALTER log_id DROP DEFAULT');
        $this->addSql('ALTER TABLE suppliers DROP CONSTRAINT suppliers_supplier_contract_fkey');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_id DROP DEFAULT');
        $this->addSql('ALTER TABLE suppliers ADD CONSTRAINT FK_AC28B95C640640D8 FOREIGN KEY (supplier_contract) REFERENCES contracts (contract_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT products_product_category_fkey');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT products_product_brand_fkey');
        $this->addSql('ALTER TABLE products ALTER product_id DROP DEFAULT');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ACDFC7356 FOREIGN KEY (product_category) REFERENCES categories (category_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ABD0E8204 FOREIGN KEY (product_brand) REFERENCES brands (brand_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories ALTER category_id DROP DEFAULT');
        $this->addSql('ALTER TABLE contracts ALTER contract_id DROP DEFAULT');
        $this->addSql('ALTER TABLE brands ALTER brand_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE password_reset_request DROP CONSTRAINT FK_C5D0A95A9D86650F');
        $this->addSql('ALTER TABLE sup_user DROP CONSTRAINT FK_E41BEA18F6FFBEF7');
        $this->addSql('DROP SEQUENCE sup_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE password_reset_request_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('DROP TABLE sup_user');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE password_reset_request');
        $this->addSql('CREATE SEQUENCE categories_category_id_seq');
        $this->addSql('SELECT setval(\'categories_category_id_seq\', (SELECT MAX(category_id) FROM categories))');
        $this->addSql('ALTER TABLE categories ALTER category_id SET DEFAULT nextval(\'categories_category_id_seq\')');
        $this->addSql('CREATE SEQUENCE brands_brand_id_seq');
        $this->addSql('SELECT setval(\'brands_brand_id_seq\', (SELECT MAX(brand_id) FROM brands))');
        $this->addSql('ALTER TABLE brands ALTER brand_id SET DEFAULT nextval(\'brands_brand_id_seq\')');
        $this->addSql('CREATE SEQUENCE contracts_contract_id_seq');
        $this->addSql('SELECT setval(\'contracts_contract_id_seq\', (SELECT MAX(contract_id) FROM contracts))');
        $this->addSql('ALTER TABLE contracts ALTER contract_id SET DEFAULT nextval(\'contracts_contract_id_seq\')');
        $this->addSql('ALTER TABLE suppliers DROP CONSTRAINT FK_AC28B95C640640D8');
        $this->addSql('CREATE SEQUENCE suppliers_supplier_id_seq');
        $this->addSql('SELECT setval(\'suppliers_supplier_id_seq\', (SELECT MAX(supplier_id) FROM suppliers))');
        $this->addSql('ALTER TABLE suppliers ALTER supplier_id SET DEFAULT nextval(\'suppliers_supplier_id_seq\')');
        $this->addSql('ALTER TABLE suppliers ADD CONSTRAINT suppliers_supplier_contract_fkey FOREIGN KEY (supplier_contract) REFERENCES contracts (contract_id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE SEQUENCE log_log_id_seq');
        $this->addSql('SELECT setval(\'log_log_id_seq\', (SELECT MAX(log_id) FROM log))');
        $this->addSql('ALTER TABLE log ALTER log_id SET DEFAULT nextval(\'log_log_id_seq\')');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT FK_EC2D5CE86FFD5800');
        $this->addSql('ALTER TABLE supplies DROP CONSTRAINT FK_EC2D5CE841544050');
        $this->addSql('CREATE SEQUENCE supplies_supply_id_seq');
        $this->addSql('SELECT setval(\'supplies_supply_id_seq\', (SELECT MAX(supply_id) FROM supplies))');
        $this->addSql('ALTER TABLE supplies ALTER supply_id SET DEFAULT nextval(\'supplies_supply_id_seq\')');
        $this->addSql('ALTER TABLE supplies ALTER supply_quantity SET DEFAULT 0');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT supplies_supply_product_fkey FOREIGN KEY (supply_product) REFERENCES products (product_id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE supplies ADD CONSTRAINT supplies_supply_contract_fkey FOREIGN KEY (supply_contract) REFERENCES contracts (contract_id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customers DROP CONSTRAINT FK_62534E21C54A6B76');
        $this->addSql('CREATE SEQUENCE customers_customer_id_seq');
        $this->addSql('SELECT setval(\'customers_customer_id_seq\', (SELECT MAX(customer_id) FROM customers))');
        $this->addSql('ALTER TABLE customers ALTER customer_id SET DEFAULT nextval(\'customers_customer_id_seq\')');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT customers_customer_contract_fkey FOREIGN KEY (customer_contract) REFERENCES contracts (contract_id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5ACDFC7356');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5ABD0E8204');
        $this->addSql('CREATE SEQUENCE products_product_id_seq');
        $this->addSql('SELECT setval(\'products_product_id_seq\', (SELECT MAX(product_id) FROM products))');
        $this->addSql('ALTER TABLE products ALTER product_id SET DEFAULT nextval(\'products_product_id_seq\')');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT products_product_category_fkey FOREIGN KEY (product_category) REFERENCES categories (category_id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT products_product_brand_fkey FOREIGN KEY (product_brand) REFERENCES brands (brand_id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}

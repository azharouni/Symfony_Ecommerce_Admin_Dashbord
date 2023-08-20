<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526215244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hello');
        $this->addSql('ALTER TABLE adresse CHANGE adresse1 adresse1 VARCHAR(100) NOT NULL, CHANGE adresse2 adresse2 VARCHAR(255) NOT NULL, CHANGE pay pay VARCHAR(100) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE code_p code_p INT NOT NULL');
        $this->addSql('ALTER TABLE commande CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE detail CHANGE lignecom_id lignecom_id INT NOT NULL, CHANGE panier_id panier_id INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE fname fname VARCHAR(100) NOT NULL, CHANGE lname lname VARCHAR(100) NOT NULL, CHANGE num_tel num_tel INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hello (id INT AUTO_INCREMENT NOT NULL, price NUMERIC(10, 0) NOT NULL, noo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, soi VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adresse CHANGE adresse1 adresse1 VARCHAR(100) DEFAULT NULL, CHANGE adresse2 adresse2 VARCHAR(255) DEFAULT NULL, CHANGE pay pay VARCHAR(100) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE code_p code_p INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE fname fname VARCHAR(100) DEFAULT NULL, CHANGE lname lname VARCHAR(100) DEFAULT NULL, CHANGE num_tel num_tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail CHANGE lignecom_id lignecom_id INT DEFAULT NULL, CHANGE panier_id panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE date date DATE DEFAULT NULL');
    }
}

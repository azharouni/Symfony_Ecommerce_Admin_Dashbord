<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526120813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail CHANGE size size LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL, CHANGE fname fname VARCHAR(100) NOT NULL, CHANGE lname lname VARCHAR(100) NOT NULL, CHANGE num_tel num_tel INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hello (id INT AUTO_INCREMENT NOT NULL, price NUMERIC(10, 0) NOT NULL, noo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, soi VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON DEFAULT NULL, CHANGE fname fname VARCHAR(100) DEFAULT NULL, CHANGE lname lname VARCHAR(100) DEFAULT NULL, CHANGE num_tel num_tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail CHANGE lignecom_id lignecom_id INT DEFAULT NULL, CHANGE panier_id panier_id INT DEFAULT NULL, CHANGE size size VARCHAR(255) NOT NULL');
    }
}
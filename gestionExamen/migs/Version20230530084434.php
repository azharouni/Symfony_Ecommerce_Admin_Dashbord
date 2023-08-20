<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530084434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail DROP size, DROP color, CHANGE lignecom_id lignecom_id INT NOT NULL, CHANGE panier_id panier_id INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE fname fname VARCHAR(100) NOT NULL, CHANGE lname lname VARCHAR(100) NOT NULL, CHANGE num_tel num_tel INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users CHANGE fname fname VARCHAR(100) DEFAULT NULL, CHANGE lname lname VARCHAR(100) DEFAULT NULL, CHANGE num_tel num_tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD size NUMERIC(10, 0) NOT NULL, ADD color LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE lignecom_id lignecom_id INT DEFAULT NULL, CHANGE panier_id panier_id INT DEFAULT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517141702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD souscategorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A27126E0 FOREIGN KEY (souscategorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27A27126E0 ON produit (souscategorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A27126E0');
        $this->addSql('DROP INDEX IDX_29A5EC27A27126E0 ON produit');
        $this->addSql('ALTER TABLE produit DROP souscategorie_id');
    }
}
